<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERajax {

    function __construct() {
        add_action("wp_ajax_jsvehiclemanager_ajax", array($this, "ajaxhandler")); // when user is login
        add_action("wp_ajax_nopriv_jsvehiclemanager_ajax", array($this, "ajaxhandler")); // when user is not login
    }

    function ajaxhandler() {
        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme');
        $task = JSVEHICLEMANAGERrequest::getVar('task');
        $result = JSVEHICLEMANAGERincluder::getJSModel($module)->$task();
        echo $result;
        die();
    }


}

$jsajax = new JSVEHICLEMANAGERajax();
?>
