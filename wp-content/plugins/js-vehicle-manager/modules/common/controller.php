<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERCommonController {

    private $_msgkey;

    function __construct() {
        $this->_msgkey = JSVEHICLEMANAGERincluder::getJSModel('systemerror')->getMessagekey();
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'newinjsvehiclemanager');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'newinjsvehiclemanager':
                    if(JSVEHICLEMANAGERincluder::getObjectClass('user')->isguest()){
                        $link = get_permalink();
                        $linktext = __('Login','js-vehicle-manager');
                        jsvehiclemanager::$_error_flag_message = JSVEHICLEMANAGERLayout::setMessageFor(1 , $link , $linktext,1);
                        jsvehiclemanager::$_error_flag = true;
                    }
                break;
                case 'admin_vehicleoffers':
                    JSVEHICLEMANAGERincluder::getJSModel('common')->getVehicleOffers();
                break;
                case 'admin_vehicletestdrives':
                    JSVEHICLEMANAGERincluder::getJSModel('common')->getVehicleTestDrives();
                break;
                case 'admin_sellermessages':
                    JSVEHICLEMANAGERincluder::getJSModel('common')->getSellerMessages();
                break;
            }
            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'common');
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

    function makedefault() {
        $id = JSVEHICLEMANAGERrequest::getVar('id');
        $for = JSVEHICLEMANAGERrequest::getVar('for'); // table name
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $result = JSVEHICLEMANAGERincluder::getJSModel('common')->setDefaultForDefaultTable($id, $for);
        $layout = JSVEHICLEMANAGERrequest::getVar('jsvmlt');
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, $for);
        $url = admin_url("admin.php?page=jsvm_" . $for . "&jsvmlt=" . $layout);
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        $msgkey = JSVEHICLEMANAGERincluder::getJSModel($for)->getMessagekey();
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'],$msgkey);
        wp_redirect($url);
        die();
    }

    function defaultorderingup() {
        $id = JSVEHICLEMANAGERrequest::getVar('id');
        $for = JSVEHICLEMANAGERrequest::getVar('for'); //table name
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $result = JSVEHICLEMANAGERincluder::getJSModel('common')->setOrderingUpForDefaultTable($id, $for);
        $layout = JSVEHICLEMANAGERrequest::getVar('jsvmlt');
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, $for);
        $url = admin_url("admin.php?page=jsvm_" . $for . "&jsvmlt=" . $layout);
        // for models layout
        $makeid = JSVEHICLEMANAGERrequest::getVar('makeid');
        if(is_numeric($makeid)){
            $url .= '&makeid='.$makeid;            
        }
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        $msgkey = JSVEHICLEMANAGERincluder::getJSModel($for)->getMessagekey();
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $msgkey);
        wp_redirect($url);
        die();
    }

    function defaultorderingdown() {
        $id = JSVEHICLEMANAGERrequest::getVar('id');
        $for = JSVEHICLEMANAGERrequest::getVar('for'); // table name
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $result = JSVEHICLEMANAGERincluder::getJSModel('common')->setOrderingDownForDefaultTable($id, $for);
        $layout = JSVEHICLEMANAGERrequest::getVar('jsvmlt');
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, $for);
        $url = admin_url("admin.php?page=jsvm_" . $for . "&jsvmlt=" . $layout);
        // for models layout
        $makeid = JSVEHICLEMANAGERrequest::getVar('makeid');
        if(is_numeric($makeid)){
            $url .= '&makeid='.$makeid;            
        }
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        $msgkey = JSVEHICLEMANAGERincluder::getJSModel($for)->getMessagekey();
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $msgkey);
        wp_redirect($url);
        die();
    }

    function savenewinjsvehiclemanager() {
        $data = JSVEHICLEMANAGERrequest::get('post');
        $result = JSVEHICLEMANAGERincluder::getJSModel('common')->saveNewInjsvehiclemanager($data);
        if ($data['desired_module'] == 'common' && $data['desired_layout'] == 'newinjsvehiclemanager') {
            if (JSVEHICLEMANAGERincluder::getObjectClass('jsvehiclemanageruser')->isjobseeker()) {
                $data['desired_module'] = 'job seeker';
            } else {
                $data['desired_module'] = 'employer';
            }
            $data['desired_layout'] = 'controlpanel';
        }
        $url = jsvehiclemanager::makeUrl(array('jsvmme'=>$data['desired_module'], 'jsvmlt'=>$data['desired_layout']));
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'userrole');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status']);
        wp_redirect($url);
        die();
    }

}

$commonController = new JSVEHICLEMANAGERcommonController;
?>