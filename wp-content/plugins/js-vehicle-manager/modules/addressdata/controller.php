<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERAddressdataController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'loadaddressdata');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_loadaddressdata':
                    $error = 0;
                    if (isset($_GET['er']))
                        $error = $_GET['er'];
                    break;
            }

            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'loadaddressdata');
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

    function loadaddressdata() {
        $result = JSVEHICLEMANAGERincluder::getJSModel('addressdata')->loadAddressData();
        //$msg = JSVEHICLEMANAGERmessages::getMessage($result, 'addressdata');
        $url = admin_url("admin.php?page=jsvm_addressdata&jsvmlt=loadaddressdata");
        if ($result == SAVED) {
            echo '<h1>'.__('Data has been uploaded successfully','js-vehicle-manager').'</h1>';
        } else {
            echo '<h1>'.__('Data has not been uploaded','js-vehicle-manager').'</h1>';
        }
        echo '<h1><a href="'.$url.'">'.__('Click here to continue','js-vehicle-manager').'</a></h1>';
        ob_flush();
        ob_clean();
        exit();
    }
}

$JSVEHICLEMANAGERAddressdata = new JSVEHICLEMANAGERAddressdataController();
?>
