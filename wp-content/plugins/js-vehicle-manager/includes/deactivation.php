<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERdeactivation {

    static function jsvehiclemanager_deactivate() {
        wp_clear_scheduled_hook('jsvehiclemanager_cronjobs_action');
        $id = jsvehiclemanager::getPageid();
        $db = new jsvehiclemanagerdb();
        $query = "UPDATE `#__posts` SET post_status = 'draft' WHERE ID = " . $id;
        $db->setQuery($query);
        $db->query();
    }

}

?>