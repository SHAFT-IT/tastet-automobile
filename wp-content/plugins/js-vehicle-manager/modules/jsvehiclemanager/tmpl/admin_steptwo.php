<?php if (!defined('ABSPATH')) die('Restricted Access'); ?>
<div id="jsvehiclemanageradmin-wrapper">
    <div id="jsvehiclemanageradmin-leftmenu">
        <?php JSVEHICLEMANAGERincluder::getClassesInclude('jsvehiclemanageradminsidemenu'); ?>
    </div>
    <div id="jsvehiclemanageradmin-data">
        <span class="jsvm_js-admin-title">
            <a href="<?php echo admin_url('admin.php?page=jsvehiclemanager&jsvmlt=stepone'); ?>"><img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/back-icon.png" /></a>
            <?php echo __('Update', 'js-vehicle-manager'); ?>
        </span>
        <style type="text/css">
            div.jsvm-update-main-wrap{width:100%;float:left;background:url('<?php echo CAR_MANAGER_IMAGE; ?>/bgimageprice.png') bottom left no-repeat; background-size:100% auto;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap{width:100%;float:left;background-color:rgba(2, 13, 12, 0.69);padding-top:40px;padding-bottom:80px;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-img-wrap{width:100%;float:left;text-align: center;padding:45px 0 15px;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap h1.jsvm-update-heading-wrap{display:inline-block;text-align: center;width:100%;color:#FFFFFF;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form{width: 100%;float: left;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap{width: 100%;float: left;text-align: center;color:#FFFFFF;margin:10px 0;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap select.jsvm-update-field-text{width: 55%;display:inline-block;height:40px;border:1px solid #CCC; }
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap input.jsvm-update-field-chk{display: inline-block;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap span.jsvm-update-field-txt{display: inline-block;padding:0 0 0 5px;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap input.jsvm-update-field-btn{display: inline-block;text-align:center; border: 1px solid #0098DA;background-color:#0098DA;color:#FFFFFF;width: 30%;padding:10px 0;font-weight: bold;}
            div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-text-wrap{width: 100%;float: left;text-align: center;color:#FFFFFF;margin:7px 0 50px 0;}
            div.jsvm-update-error{width: 100%;float: left;padding: 5px 10px;background-color:#FDEEEE; border:1px solid #E08080;margin: 0 0 10px;}
            div.jsvm-update-error img.jsvm-update-error{display: inline-block;float: left;}
            div.jsvm-update-error span.jsvm-update-error-text{display: inline-block;float: left;padding:5px 0 0 5px;color:#C72929;}
            div#jsvm_ajaxloaded_wait_overlay{bottom: 0; height: 100%; left: 0; position: fixed; right: 0; top: 0; width: 100%; z-index: 999998; background: rgba(0,0,0, 0.94);}
            img#jsvm_ajaxloaded_wait_image{z-index: 999999; position: fixed; top: calc(50% - 64px);  left: calc(50% - 64px);  }
            div#jsvm_ajaxloaded_wait_txt{z-index: 999999; position: fixed; top: calc(50% + 84px);text-align: center; font-size:15px;color:#FFF;left: calc(50% - 64px);}
            div.jsvm_errormsg{width:50%;margin:10px 25%;padding:10px;color:#FFFFFF;display: inline-block;text-align: center;font-size:16px;}
            div.jsvm_errormsg.first{background:rgba(255,0,0, 0.5);border:1px solid #ED3237;}
            div.jsvm_errormsg.second{background:rgba(255,153,51, 0.5);border:1px solid #F5874F;}
        </style>
        <?php
        $enable = true;
        $disabled = explode(', ', ini_get('disable_functions'));
        if ($disabled)
            if (in_array('set_time_limit', $disabled))
                $enable = false;

        if (!ini_get('safe_mode')) {
            if ($enable)
                set_time_limit(0);
        }
        if(!defined('CMCONSTV')){
            define('CMCONSTV', base64_decode('aHR0cDovL3NldHVwLmpvb21za3kuY29tL2pzdmVoaWNsZW1hbmFnZXIvcHJvL2luZGV4LnBocA=='));
        }

        if(isset($_POST['rememberkey']) && $_POST['rememberkey'] == 1){
            $value = $_POST['transactionkey'];
            $value = base64_encode($value);
            update_option( 'jsvm_primary', $value );
        }

        if(isset($_POST['sampledata']) && $_POST['sampledata'] == 1){
            //echo '//sample code here';
        }
        if(isset($_POST['transactionkey'])){
            $post_data['transactionkey'] = $_POST['transactionkey'];
            $post_data['serialnumber'] = $_POST['serialnumber'];
            $post_data['domain'] = $_POST['domain'];
            $post_data['producttype'] = $_POST['producttype'];
            $post_data['productcode'] = $_POST['productcode'];
            $post_data['productversion'] = $_POST['productversion'];
            $post_data['JVERSION'] = $_POST['JVERSION'];
            $post_data['installnew'] = FALSE;
            $post_data['count'] = 100;
            $post_data['image_path'] = CAR_MANAGER_IMAGE.'/update-icon.png';
            $post_data['form_action'] = 'admin.php?page=jsvehiclemanager&jsvmlt=stepthree';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, CMCONSTV);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            $response = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($response);
            if(isset($res[0]) && $res[0] == true){
                echo $res[1];
            }else{
                echo '<h1>Error you cannot install JS Vehicle Manager</h1>';
            }
        }else{
            echo '<h1>Error you cannot install JS Vehicle Manager</h1>';
        }
        ?>
    </div>
</div>

<div style="display:none;" id="jsvm_ajaxloaded_wait_overlay"></div>
<img style="display:none;" id="jsvm_ajaxloaded_wait_image" src="<?php echo CAR_MANAGER_IMAGE.'/loading.gif'; ?>">
<div style="display:none;" id="jsvm_ajaxloaded_wait_txt"><?php echo __('This may take few minutes', 'js-vehicle-manager'); ?></div>
<script type="text/javascript">
    (function($, document){
        "use strict";
        document.jsvm_showloading = function (){
            $('div#jsvm_ajaxloaded_wait_overlay').show();
            $('div#jsvm_ajaxloaded_wait_txt').show();
            $('img#jsvm_ajaxloaded_wait_image').show();
        }
    })(jQuery, document);
</script>