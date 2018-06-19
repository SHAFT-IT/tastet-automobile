<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERjsvehiclemanagerController {

    function __construct() {

        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'controlpanel');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_controlpanel':
                    JSVEHICLEMANAGERincluder::getJSModel('jsvehiclemanager')->getAdminControlPanelData();
                    break;
                case 'admin_jsvehiclemanagerstats':
                    JSVEHICLEMANAGERincluder::getJSModel('jsvehiclemanager')->getJSVehicleManagerStats();
                    break;
                case 'info':
                    $id = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerid');
                    JSVEHICLEMANAGERincluder::getJSModel('announcement')->getAnnouncementDetails($id);
                    break;
                case 'updates':
                    break;
                case 'login':
                    if(JSVEHICLEMANAGERincluder::getObjectClass('user')->isguest()){
                        $url = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerredirecturl', 'get');
                        if(isset($url)){
                            jsvehiclemanager::$_data[0]['redirect_url'] = base64_decode($url);
                        }else{
                            jsvehiclemanager::$_data[0]['redirect_url'] = home_url();
                        }
                    }
                    break;
                case 'admin_stepone': //Installation
                    $array = explode('.', phpversion());
                    $phpversion = $array[0] . '.' . $array[1];
                    $curlexist = function_exists('curl_version');
                    //$curlversion = curl_version()['version'];
                    if (extension_loaded('gd') && function_exists('gd_info')) {
                        $gd_lib = 1;
                    } else {
                        $gd_lib = 0;
                    }
                    $zip_lib = 0;
                    if (file_exists(jsvehiclemanager::$_path . 'includes/lib/pclzip.lib.php')) {
                        $zip_lib = 1;
                    }
                    jsvehiclemanager::$_data['phpversion'] = $phpversion;
                    // jsvehiclemanager::$_data[0]['curlversion'] = $curlversion;
                    jsvehiclemanager::$_data['gd_lib'] = $gd_lib;
                    jsvehiclemanager::$_data['zip_lib'] = $zip_lib;
                    jsvehiclemanager::$_data['curlexist'] = $curlexist;
                    JSVEHICLEMANAGERincluder::getJSModel('jsvehiclemanager')->getStepTwoValidate();
                break;
            }
            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'jsvehiclemanager');
            $module = str_replace('jsvm_', '', $module);
            JSVEHICLEMANAGERincluder::include_file($layout, $module);
        }
    }

    function canaddfile() {
        if (isset($_POST['form_request']) && $_POST['form_request'] == 'jsvehiclemanager')
            return false;
        elseif (isset($_GET['action']) && $_GET['action'] == 'jsvmtask')
            return false;
        else
            return true;
    }


    function startupdate() {
        $data = JSVEHICLEMANAGERincluder::getJSModel('jsvehiclemanager')->getConcurrentRequestData();
        $url = "https://setup.joomsky.com/jsvehiclemanager/pro/update.php";
        $post_data['serialnumber'] = $data['serialnumber'];
        $post_data['zvdk'] = $data['zvdk'];
        $post_data['hostdata'] = $data['hostdata'];
        $post_data['domain'] = site_url();
        $post_data['transactionkey'] = JSVEHICLEMANAGERrequest::getVar('transactionkey', false);
        $post_data['producttype'] = JSVEHICLEMANAGERrequest::getVar('producttype');
        $post_data['productcode'] = JSVEHICLEMANAGERrequest::getVar('productcode');
        $post_data['productversion'] = JSVEHICLEMANAGERrequest::getVar('productversion');
        $post_data['count'] = JSVEHICLEMANAGERrequest::getVar('count_config');
        $post_data['JVERSION'] = JVERSION;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($ch);
        if ($response === false)
            echo 'Curl error: ' . curl_error($ch);
        else
            eval($response);
        curl_close($ch);
    }

    function concurrentrequestdata() {
        $jsvehiclemanager_model = JSVEHICLEMANAGERincluder::getJSModel('Jsjobs', 'JSVEHICLEMANAGERModel');
        $data = $jsvehiclemanager_model->getConcurrentRequestData();
        $url = "https://setup.joomsky.com/jsvehiclemanager/pro/verifier.php";
        $post_data['serialnumber'] = $data['serialnumber'];
        $post_data['zvdk'] = $data['zvdk'];
        $post_data['hostdata'] = $data['hostdata'];
        $post_data['domain'] = site_url();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($ch);
        curl_close($ch);
        eval($response);
    }

}

$JSVEHICLEMANAGERjsvehiclemanagerController = new JSVEHICLEMANAGERjsvehiclemanagerController();
?>