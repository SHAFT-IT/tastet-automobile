<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERCurrencyController {

    private $_msgkey;

    function __construct() {
        $this->_msgkey = JSVEHICLEMANAGERincluder::getJSModel('currency')->getMessagekey();
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'currencies');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_currencies':
                    JSVEHICLEMANAGERincluder::getJSModel('currency')->getAllCurrencies();
                    break;
                case 'admin_formcurrency':
                    $id = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerid');
                    JSVEHICLEMANAGERincluder::getJSModel('currency')->getCurrencybyId($id);
                    break;
            }
            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'currency');
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

    function savecurrency() {

        $data = JSVEHICLEMANAGERrequest::get('post');
        $result = JSVEHICLEMANAGERincluder::getJSModel('currency')->storeCurrency($data);
        $url = admin_url("admin.php?page=jsvm_currency&jsvmlt=currencies");

        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'currency');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        wp_redirect($url);
        die();
    }

    function remove() {
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $result = JSVEHICLEMANAGERincluder::getJSModel('currency')->deleteCurrencies($ids);
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'currency');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_currency&jsvmlt=currencies");
        wp_redirect($url);
        die();
    }

    function publish() {
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $result = JSVEHICLEMANAGERincluder::getJSModel('currency')->publishUnpublish($ids, 1); //  for publish
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'record');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_currency&jsvmlt=currencies");
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        wp_redirect($url);
        die();
    }

    function unpublish() {
        $pagenum = JSVEHICLEMANAGERrequest::getVar('pagenum');
        $ids = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanager-cb');
        $result = JSVEHICLEMANAGERincluder::getJSModel('currency')->publishUnpublish($ids, 0); //  for unpublish
        $msg = JSVEHICLEMANAGERmessages::getMessage($result, 'record');
        JSVEHICLEMANAGERmessages::setLayoutMessage($msg['message'], $msg['status'], $this->_msgkey);
        $url = admin_url("admin.php?page=jsvm_currency&jsvmlt=currencies");
        if ($pagenum)
            $url .= "&pagenum=" . $pagenum;
        wp_redirect($url);
        die();
    }

}

$JSVEHICLEMANAGERCurrencyController = new JSVEHICLEMANAGERCurrencyController();
?>