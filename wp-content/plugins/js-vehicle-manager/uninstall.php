<?php

/**
 * JS AUTOZ Uninstall
 *
 * Uninstalling JS AUTOZ tables, and pages.
 *
 * @author 		Ahmed Bilal
 * @category 	Core
 * @package 	JS AUTOZ/Uninstaller
 * @version     1.0.2
 */
if (!defined('WP_UNINSTALL_PLUGIN'))
    exit();
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_activitylog");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_adexpiries");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_cities");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_conditions");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_config");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_countries");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_currencies");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_cylinders");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_emailtemplates");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_emailtemplates_config");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_fieldsordering");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_fueltypes");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_makes");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_mileages");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_models");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_modelyears");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_users");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_states");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_system_errors");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_transmissions");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_vehicleimages");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_vehicles");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_vehicletypes");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}js_vehiclemanager_zip");
