<?php if (!defined('ABSPATH')) die('Restricted Access'); ?>
<style type="text/css">
    div.jsvm-update-main-wrap{width:100%;float:left;background:url('<?php echo CAR_MANAGER_IMAGE; ?>/bgimageprice.png') bottom left no-repeat; background-size:100% auto;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap{width:100%;float:left;background-color:rgba(2, 13, 12, 0.69);padding-top:40px;padding-bottom:80px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-img-wrap{width:100%;float:left;text-align: center;padding:45px 0 15px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap h1.jsvm-update-heading-wrap{display:inline-block;text-align: center;width:100%;color:#FFFFFF;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form{width: 100%;float: left;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap{width: 100%;float: left;text-align: center;color:#FFFFFF;margin:10px 0;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap input.jsvm-update-field-text{width: 55%;display:inline-block;height:40px;border:1px solid #CCC; }
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap input.jsvm-update-field-chk{display: inline-block;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap span.jsvm-update-field-txt{display: inline-block;padding:0 0 0 5px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap form.jsvm-update-form div.jsvm-update-field-wrap input.jsvm-update-field-btn{display: inline-block;text-align:center; border: 1px solid #0098DA;background-color:#0098DA;color:#FFFFFF;width: 30%;padding:10px 0;font-weight: bold;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-text-wrap{width: 100%;float: left;text-align: center;color:#FFFFFF;margin:7px 0 50px 0;}
    div.jsvm-update-error{width: 100%;float: left;padding: 5px 10px;background-color:#FDEEEE; border:1px solid #E08080;margin: 0 0 10px;}
    div.jsvm-update-error img.jsvm-update-error{display: inline-block;float: left;}
    div.jsvm-update-error span.jsvm-update-error-text{display: inline-block;float: left;padding:5px 0 0 5px;color:#C72929;}
</style>
<div id="jsvehiclemanageradmin-wrapper">
    <div id="jsvehiclemanageradmin-leftmenu">
        <?php JSVEHICLEMANAGERincluder::getClassesInclude('jsvehiclemanageradminsidemenu'); ?>
    </div>
    <div id="jsvehiclemanageradmin-data">
    <span class="jsvm_js-admin-title">
        <a href="<?php echo admin_url('admin.php?page=jsvehiclemanager'); ?>"><img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/back-icon.png" /></a>
        <?php echo __('Update', 'js-vehicle-manager'); ?>
    </span>
    <?php $validate = true; ?>
    <?php if(jsvehiclemanager::$_data['dir'] < 755){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('Dir Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['tmp_dir'] < 755){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('Temp directory Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['create_table'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('Create table Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['insert_record'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('insert record Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['update_record'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('update record Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['delete_record'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('delete record Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['drop_table'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('drop table Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['file_downloaded'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('file downloaded Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['curlexist'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('CURL Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['gd_lib'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('GD lib Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <?php if(jsvehiclemanager::$_data['zip_lib'] != 1){ ?>
        <?php $validate = false; ?>
        <div class="jsvm-update-error">
            <img class="jsvm-update-error" src="images/unsuccessful.png" />
            <span class="jsvm-update-error-text"><?php echo __('ZIP lib Not Validate', 'js-vehicle-manager'); ?></span>
        </div>
    <?php } ?>
    <div class="jsvm-update-main-wrap">
        <div class="jsvm-update-wrap">
            <div class="jsvm-update-img-wrap">
                <img src="<?php echo CAR_MANAGER_IMAGE; ?>/update-icon.png" />
            </div>
            <h1 class="jsvm-update-heading-wrap"><?php echo __('Please Insert Activation Key And Press Start','js-vehicle-manager'); ?></h1>
            <form class="jsvm-update-form" action="<?php echo admin_url('admin.php?page=jsvehiclemanager&jsvmlt=steptwo'); ?>" method="post">
                <div class="jsvm-update-field-wrap">
                    <?php
                        $value = get_option('jsvm_primary');
                        if($value)
                            $value = base64_decode($value);
                    ?>                
                    <input class="jsvm-update-field-text" type="text" name="transactionkey" id="transactionkey" value="<?php echo ($value) ? $value : ''; ?>" placeholder="<?php echo __('Product Key','js-vehicle-manager')  ?>"  />
                </div>
                <?php if(!$value): ?>
                    <div class="jsvm-update-field-wrap">
                        <input class="jsvm-update-field-chk" type="checkbox" id="rememberkey" name="rememberkey" value="1" />
                        <span class="jsvm-update-field-txt"><?php echo __('Remember Key', 'js-vehicle-manager'); ?></span>
                    </div>
                <?php endif; ?>
                <div class="jsvm-update-field-wrap">
                    <input class="jsvm-update-field-btn" <?php echo ($validate == true) ? '' : 'disabled="true"'; ?> type="submit" id="" name="" value="<?php echo __('Submit', 'js-vehicle-manager'); ?>" />
                </div>
                <input type="hidden" name="serialnumber" id="serialnumber" value="" />
                <input type="hidden" name="domain" id="domain" value="<?php echo site_url(); ?>" />
                <input type="hidden" name="producttype" value="<?php echo jsvehiclemanager::$_config['producttype'];?>" />
                <input type="hidden" name="productcode" value="js-vehicle-manager" />
                <input type="hidden" name="productversion" value="<?php echo jsvehiclemanager::$_config['productversion'] != '' ? jsvehiclemanager::$_config['productversion'] : 100 ;?>" />
                <input type="hidden" name="JVERSION" value="<?php echo get_bloginfo('version'); ?>" />
                <input type="hidden" name="count" value="100" />
                <input type="hidden" name="installerversion" value="1.1" />
            </form>
            <div class="jsvm-update-text-wrap">
                <?php echo __('It may take few minutes','js-vehicle-manager'); ?>.....
            </div>
        </div>
    </div>
</div>
