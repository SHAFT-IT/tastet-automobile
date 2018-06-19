<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERReportsController {

    private $_msgkey;

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'overallreports');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_overallreports':
                    JSVEHICLEMANAGERincluder::getJSModel('reports')->overallReportsForGraph();
                    break;
            }
            $module = (is_admin()) ? 'page' : 'jsvmme';
            $module = JSVEHICLEMANAGERrequest::getVar($module, null, 'reports');
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

    function makevheicleexport(){

        $return_value = JSVEHICLEMANAGERincluder::getJSModel('reports')->getVehicleExport();
        if (!empty($return_value)) {
            // Push the report now!
            $msg = __('Vehicle Export', 'js-vehicle-manager');
            $name = 'vehicles-export';
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $name . ".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Lacation: excel.htm?id=yes");
            print $return_value;
            exit;
        }
        $url = admin_url("admin.php?page=jsvm_reports&jsvmlt=vehicleexport");
        wp_redirect($url);
        exit;
    }
}

$JSVEHICLEMANAGERReportsController = new JSVEHICLEMANAGERReportsController();
?>