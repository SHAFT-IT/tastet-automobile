<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERStateController {

    private $_msgkey;

    function __construct() {
        $this->_msgkey = JSVEHICLEMANAGERincluder::getJSModel('state')->getMessagekey();
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'states');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_states':
                    $countryid = JSVEHICLEMANAGERrequest::getVar('countryid');
                    if (!$countryid)
                        $countryid = $_SESSION["countryid"];
                    $_SESSION["countryid"] = $countryid;

                    JSVEHICLEMANAGERincluder::getJSModel('state')->getAllCountryStates($countryid);
                    break;
                case 'admin_formstate':
                    $id = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerid');
                    JSVEHICLEMANAGERincluder::getJSModel('state')->getStatebyId($id);
                    break;
            }
            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'states');
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

    function remove() {
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $countryid = $_SESSION["countryid"];

        $result = JSVEHICLEMANAGERincluder::getJSModel('state')->deleteStates($ids);
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'state');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_state&jsvmlt=states&countryid=" . $countryid);
        wp_redirect($url);
        die();
    }

    function publish() {
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $countryid = $_SESSION["countryid"];
        $result = JSVEHICLEMANAGERincluder::getJSModel('state')->publishUnpublish($ids, 1); //  for publish
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'record');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_state&jsvmlt=states&countryid=" . $countryid);
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        wp_redirect($url);
        die();
    }

    function unpublish() {
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $countryid = $_SESSION["countryid"];
        $result = JSVEHICLEMANAGERincluder::getJSModel('state')->publishUnpublish($ids, 0); //  for unpublish
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'record');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_state&jsvmlt=states&countryid=" . $countryid);
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        wp_redirect($url);
        die();
    }

    function savestate() {
        $data = JSVEHICLEMANAGERrequest::get('post');
        $countryid = $_SESSION["countryid"];
        $result = JSVEHICLEMANAGERincluder::getJSModel('state')->storeState($data, $countryid);
        $url = admin_url("admin.php?page=jsvm_state&jsvmlt=states&countryid=" . $countryid);
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'state');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        wp_redirect($url);
        die();
    }

}

$JSVEHICLEMANAGERStateController = new JSVEHICLEMANAGERStateController();
?>