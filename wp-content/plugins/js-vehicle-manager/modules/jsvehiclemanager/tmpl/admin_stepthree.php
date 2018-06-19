<style type="text/css">
    div.jsvm-update-main-wrap{width:100%;float:left;background:url('<?php echo CAR_MANAGER_IMAGE; ?>/bgimageprice.png');background-repeat:no-repeat;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap{width:100%;float:left;background-color:rgba(2, 13, 12, 0.69);padding:100px 78px 150px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-img-wrap{width:100%;float:left;text-align: center;padding:45px 0 15px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap h1.jsvm-update-heading-wrap{display:inline-block;text-align: center;width:100%;color:#FFFFFF;border-bottom:2px solid #57595B;padding: 0 0 20px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-button-wrap{width: 100%;float: left;text-align: center;margin-top: 15px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-button-wrap a.jsvm-update-button{display: inline-block;padding: 10px 19px;text-decoration: none;border: 1px solid #3F4347;color:#FFF;background-color: #272A2C;font-weight: bold; margin-right: 50px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm-update-button-wrap a.jsvm-update-button.buttonmargin{margin-right: 0px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm_sample-users-wrap {border: 1px solid #3F4347;color:#FFF;background-color: #272A2C;display: inline-block;padding: 15px 20px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm_sample-users-wrap  span{border: 1px solid #3F4347;color:#FFF;background-color: #272A2C;font-weight: bold;display: inline-block;padding: 5px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap div.jsvm_sample-users-wrap  div{display: inline-block;margin-left: 30px;}
    div.jsvm-update-main-wrap div.jsvm-update-wrap{text-align: center}
</style>
<?php
if(!defined('CMCONSTV')){
    define('CMCONSTV', base64_decode('aHR0cDovL3NldHVwLmpvb21za3kuY29tL2pzdmVoaWNsZW1hbmFnZXIvcHJvL2luZGV4LnBocA=='));
}

if(isset($_POST['productversioninstall']) && !empty($_POST['productversioninstall']) && $_POST['productversioninstall'] != 'Choose Version'){
    $post_data['transactionkey'] = $_POST['transactionkey'];
    $post_data['serialnumber'] = $_POST['serialnumber'];
    $post_data['domain'] = $_POST['domain'];
    $post_data['producttype'] = $_POST['producttype'];
    $post_data['productcode'] = $_POST['productcode'];
    $post_data['productversion'] = $_POST['productversion'];
    $post_data['JVERSION'] = $_POST['JVERSION'];
    $post_data['level'] = $_POST['level'];
    $post_data['installnew'] = FALSE;
    $post_data['productversioninstall'] = $_POST['productversioninstall'];
    $post_data['sampledatainsertion'] = $_POST['sampledatainsertion'];
    $post_data['count'] = 100;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, CMCONSTV);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0); //timeout in seconds
    $response = curl_exec($ch);
    curl_close($ch);
    eval($response);
    $url = 'admin.php?page=jsvehiclemanager';
    wp_redirect($url);
}else{
    echo '<h1>Sorry you cannot install JS Vehicle Manager</h1>';
    return;
}
?>
<div class="jsvm-update-main-wrap">
    <div class="jsvm-update-wrap">
        <div class="jsvm-update-img-wrap">
            <img src="<?php echo CAR_MANAGER_IMAGE; ?>/good-icon.png" />
        </div>
        <h1 class="jsvm-update-heading-wrap">Update was successful !...</h1>
        <div class="jsvm-update-button-wrap">
            <a class="jsvm-update-button" href="<?php echo esc_url(admin_url('admin.php?page=car_manager_options')); ?>">Car Manager</a>
            <a class="jsvm-update-button" href="<?php echo esc_url(admin_url('admin.php?page=jsvehiclemanager')); ?>">Vehicle Manager</a>
            <a class="jsvm-update-button buttonmargin" href="<?php echo esc_url(admin_url('admin.php?page=jsvm_postinstallation&jsvmlt=quickconfig')); ?>">Quick Configuration</a>
        </div>
    </div>
</div>
