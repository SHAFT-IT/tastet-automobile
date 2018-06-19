<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class jsvehiclemanageradmin {

    function __construct() {
        add_action('admin_menu', array($this, 'mainmenu'));
    }

    function mainmenu() {
        add_menu_page(__('Control Panel', 'js-vehicle-manager'), // Page title
                __('Vehicle Manager', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvehiclemanager', //menu slug
                array($this, 'showAdminPage'), // function name
                plugins_url('js-vehicle-manager/includes/images/admin_jsvehiclemanager1.png')
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Vehicles', 'js-vehicle-manager'), // Page title
                __('Vehicles', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_vehicle', //menu slug
                array($this, 'showAdminPage') // function name
        );

        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Fuel Types', 'js-vehicle-manager'), // Page title
                __('Fuel Types', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_fueltypes', //menu slug
                array($this, 'showAdminPage') // function name
        );
        
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Conditions', 'js-vehicle-manager'), // Page title
                __('Conditions', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_conditions', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Currency', 'js-vehicle-manager'), // Page title
                __('Currency', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_currency', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Cylinders', 'js-vehicle-manager'), // Page title
                __('Cylinders', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_cylinders', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Model years', 'js-vehicle-manager'), // Page title
                __('Model years', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_modelyears', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Transmissions', 'js-vehicle-manager'), // Page title
                __('Transmissions', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_transmissions', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Models', 'js-vehicle-manager'), // Page title
                __('Models', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_model', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Vehicle types', 'js-vehicle-manager'), // Page title
                __('Vehicle types', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_vehicletype', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Email templates', 'js-vehicle-manager'), // Page title
                __('Email templates', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_emailtemplate', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Email options', 'js-vehicle-manager'), // Page title
                __('Email options', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_emailtemplatestatus', //menu slug
                array($this, 'showAdminPage') // function name
        );

        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Field ordering Vehicle', 'js-vehicle-manager'), // Page title
                __('Field ordering Vehicle', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_fieldordering', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Configurations', 'js-vehicle-manager'), // Page title
                __('Configurations', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_configuration', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Makes', 'js-vehicle-manager'), // Page title
                __('Makes', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_make', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Mileages', 'js-vehicle-manager'), // Page title
                __('Mileages', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_mileages', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Countries', 'js-vehicle-manager'), // Page title
                __('Countries', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_country', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('States', 'js-vehicle-manager'), // Page title
                __('States', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_state', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Cities', 'js-vehicle-manager'), // Page title
                __('Cities', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_city', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Activity Log', 'js-vehicle-manager'), // Page title
                __('Activity Log', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_activitylog', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Users', 'js-vehicle-manager'), // Page title
                __('Users', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_user', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('System Error', 'js-vehicle-manager'), // Page title
                __('System Error', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_systemerror', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Common', 'js-vehicle-manager'), // Page title
                __('Common', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_common', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Post Installation', 'js-vehicle-manager'), // menu title
                __('Post Installation', 'js-vehicle-manager'), // Page title
                'jsvehiclemanager', // capability
                'jsvm_postinstallation', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Load ADdress Data', 'js-vehicle-manager'), // menu title
                __('Load ADdress Data', 'js-vehicle-manager'), // Page title
                'jsvehiclemanager', // capability
                'jsvm_addressdata', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager_hide', // parent slug
                __('Ad Expiry', 'js-vehicle-manager'), // menu title
                __('Ad Expiry', 'js-vehicle-manager'), // Page title
                'jsvehiclemanager', // capability
                'jsvm_adexpiry', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jsvehiclemanager', // parent slug
                __('Reports', 'js-vehicle-manager'), // Page title
                __('Reports', 'js-vehicle-manager'), // menu title
                'jsvehiclemanager', // capability
                'jsvm_reports', //menu slug
                array($this, 'showAdminPage') // function name
        );
    }

    function showAdminPage() {
        jsvehiclemanager::addStyleSheets();
        $page = JSVEHICLEMANAGERrequest::getVar('page');
        $page = str_replace('jsvm_', '', $page);
        JSVEHICLEMANAGERincluder::include_file($page);
    }

}

$jsvehiclemanagerAdmin = new jsvehiclemanageradmin();
?>
