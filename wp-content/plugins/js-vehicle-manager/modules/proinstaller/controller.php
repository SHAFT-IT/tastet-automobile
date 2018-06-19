<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERproinstallerController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $module = "proinstaller";
        if ($this->canAddLayout()) {
            $layout = JSVEHICLEMANAGERrequest::getVar('layout', null, 'stepone');
            switch ($layout) {
                case 'stepone':
                    JSVEHICLEMANAGERincluder::getJSModel('proinstaller')->getServerValidate();
                    break;
                case 'steptwo':
                    JSVEHICLEMANAGERincluder::getJSModel('proinstaller')->getStepTwoValidate();
                    break;
            }
            JSVEHICLEMANAGERincluder::include_file($layout, $module);
        }
    }

    function canAddLayout() {
        if (isset($_POST['form_request']) && $_POST['form_request'] == 'jsjobs')
            return false;
        elseif (isset($_GET['action']) && $_GET['action'] == 'jsvmtask')
            return false;
        else
            return true;
    }

    function startinstallation() {
        $enable = true;
        $disabled = explode(', ', ini_get('disable_functions'));
        if ($disabled)
            if (in_array('set_time_limit', $disabled))
                $enable = false;

        if (!ini_get('safe_mode')) {
            if ($enable)
                set_time_limit(0);
        }
        $post_data['transactionkey'] = JSVEHICLEMANAGERrequest::getVar('transactionkey');
        $post_data['serialnumber'] = JSVEHICLEMANAGERrequest::getVar('serialnumber');
        $post_data['domain'] = JSVEHICLEMANAGERrequest::getVar('domain');
        $post_data['producttype'] = JSVEHICLEMANAGERrequest::getVar('producttype');
        $post_data['productcode'] = JSVEHICLEMANAGERrequest::getVar('productcode');
        $post_data['productversion'] = JSVEHICLEMANAGERrequest::getVar('productversion');
        $post_data['JVERSION'] = JSVEHICLEMANAGERrequest::getVar('JVERSION');
        $post_data['level'] = JSVEHICLEMANAGERrequest::getVar('level');
        $post_data['installnew'] = JSVEHICLEMANAGERrequest::getVar('installnew');
        $post_data['productversioninstall'] = JSVEHICLEMANAGERrequest::getVar('productversioninstall');
        $post_data['count'] = JSVEHICLEMANAGERrequest::getVar('count_config');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, JCONSTV);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0); //timeout in seconds      
        $response = curl_exec($ch);
        curl_close($ch);
        eval($response);
    }

}

$JSVEHICLEMANAGERproinstallerController = new JSVEHICLEMANAGERproinstallerController();
?>
