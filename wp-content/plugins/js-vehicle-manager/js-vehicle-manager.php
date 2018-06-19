<?php

/**
 * @package Vehicle Manager
 * @version 1.0.3
 */
/*
  Plugin Name: Vehicle Manager
  Plugin URI: http://joomsky.com/products/js-vehicle-manager-pro-wp.html
  Description: Vehicle Manager is Word Press most comprehensive and easist show room plugin.
  Author: Ahmed Bilal
  Version: 1.0.3
  Author URI: http://www.joomsky.com
 */

if (!defined('ABSPATH'))
    die('Restricted Access');

class jsvehiclemanager {

    public static $_path;
    public static $_pluginpath;
    public static $_data; /* data[0] for list , data[1] for total paginition ,data[2] fieldsorderring */
    public static $_pageid;
    public static $_config;
    public static $_sorton;
    public static $_sortorder;
    public static $_ordering;
    public static $_msg;
    public static $_error_flag;
    public static $_error_flag_message;
    public static $_js_login_redirct_link;
    public static $_car_manager_theme;
    public static $_currentversion;

    function __construct() {
        self::includes();
        self::$_path = plugin_dir_path(__FILE__);
        self::$_pluginpath = plugins_url('/', __FILE__);
        self::$_data = array();
        self::$_msg = null;
        self::$_error_flag = null;
        self::$_error_flag_message = null;
        self::$_car_manager_theme = 0;
        self::$_currentversion = 103;
        JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfiguration();
        register_activation_hook(__FILE__, array($this, 'jsvehiclemanager_activate'));
        register_deactivation_hook(__FILE__, array($this, 'jsvehiclemanager_deactivate'));
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
        add_action('admin_init', array($this, 'jsvehiclemanager_activation_redirect'));//for post installation screens
        add_action('jsvehiclemanager_cronjobs_action', array($this,'jsvehiclemanager_cronjobs'));
        // current theme to handle vehicle manager calls to car manager
        $theme = wp_get_theme();
        if($theme == 'Car Manager'){
            self::$_car_manager_theme = 1;
        }else{
            define( 'CAR_MANAGER_IMAGE', self::$_pluginpath . 'includes/images' );
        }
    }

    function jsvehiclemanager_activation_redirect(){
        if (get_option('jsvehiclemanager_do_activation_redirect') == true) {
            update_option('jsvehiclemanager_do_activation_redirect',false);
            exit(wp_redirect(admin_url('admin.php?page=jsvm_postinstallation&jsvmlt=stepone')));
        }
    }


    function jsvehiclemanager_cronjobs(){
        // Send email for the expiry credits packs
        jsvehiclemanager::getDataForExpiredCreditPacks();
    }

    function jsvehiclemanager_activate() {
        include_once 'includes/activation.php';
        JSVEHICLEMANAGERactivation::jsvehiclemanager_activate();
        wp_schedule_event(time(), 'daily', 'jsvehiclemanager_cronjobs_action');
        add_option('jsvehiclemanager_do_activation_redirect', true);
    }

    function jsvehiclemanager_deactivate() {
        include_once 'includes/deactivation.php';
        JSVEHICLEMANAGERdeactivation::jsvehiclemanager_deactivate();
    }

    /*
     * Include the required files
     */

    function includes() {
        require_once 'includes/jsvehiclemanagerdb.php';
        require_once 'includes//classes/class.upload.php';
        if (is_admin()) {
            include_once 'includes/jsvehiclemanageradmin.php';
        }
        include_once 'includes/jsvehiclemanager-wc.php';
        include_once 'includes/jsvehiclemanager-hooks.php';
        include_once 'includes/captcha.php';
        include_once 'includes/recaptchalib.php';
        include_once 'includes/layout.php';
        include_once 'includes/pagination.php';
        include_once 'includes/includer.php';
        include_once 'includes/formfield.php';
        include_once 'includes/request.php';
        include_once 'includes/formhandler.php';
        include_once 'includes/ajax.php';
        require_once 'includes/constants.php';
        require_once 'includes/messages.php';
        include_once 'includes/shortcodes.php';
        include_once 'includes/paramregister.php';
        include_once 'includes/breadcrumbs.php';
        include_once 'includes/dashboardapi.php';
        // Widgets
    }

    /*
     * Localization
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain('js-vehicle-manager', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /*
     * function for the Style Sheets
     */
    static function addStyleSheets() {
        wp_enqueue_style('jsauto-tokeninput', jsvehiclemanager::$_pluginpath . 'includes/css/tokeninput.css');
        wp_enqueue_script('jsauto-commonjs', jsvehiclemanager::$_pluginpath . 'includes/js/common.js');
        wp_localize_script('jsauto-commonjs', 'common', array('ajaxurl' => admin_url('admin-ajax.php'),'insufficient_credits' => __('You have insufficient credits, you can not perform this action','js-vehicle-manager') , 'terms_conditions' => __('Please Accept Terms And Conditions So You Can Proceed','js-vehicle-manager'), 'required_fields_error_message' => __('You have not answered all required fields','js-vehicle-manager')));
        wp_enqueue_script('jsauto-formvalidator', jsvehiclemanager::$_pluginpath . 'includes/js/jquery.form-validator.js');
        wp_enqueue_script('jsauto-tokeninput', jsvehiclemanager::$_pluginpath . 'includes/js/jquery.tokeninput.js');
        // wp_enqueue_script('jsauto-chosen-js', jsvehiclemanager::$_pluginpath . 'includes/js/chosen/chosen.jquery.min.js');
    }

    /*
     * function to get the pageid from the wpoptions
     */
    public static function getPageid() {
        if(jsvehiclemanager::$_pageid != ''){
            return jsvehiclemanager::$_pageid;
        }else{
            $pageid = JSVEHICLEMANAGERrequest::getVar('page_id','GET');
            if($pageid){
                return $pageid;
            }else{ // in case of categories popup
                $module = JSVEHICLEMANAGERrequest::getVar('jsvmme');
                if($module == 'category'){
                    $pageid = JSVEHICLEMANAGERrequest::getVar('page_id','POST');
                    if($pageid)
                        return $pageid;
                }
            }
            $id = 0;
            $db = new jsvehiclemanagerdb();
            $query = "SELECT configvalue FROM `#__js_vehiclemanager_config` WHERE configname = 'default_pageid'";
            $db->setQuery($query);
            $pageid = $db->loadResult();
            if ($pageid)
                $id = $pageid;
            return $id;
        }
    }

    /*
     * function to get the pageid from the wpoptions
     */
    public static function getPageidModule() {
        $id = 0;
        $db = new jsvehiclemanagerdb();
        $query = "SELECT configvalue FROM `#__js_vehiclemanager_config` WHERE configname = 'default_pageid'";
        $db->setQuery($query);
        $pageid = $db->loadResult();
        if ($pageid)
            $id = $pageid;
        return $id;
    }

    public static function setPageID($id) {
        jsvehiclemanager::$_pageid = $id;
    }

    /*
     * function to parse the spaces in given string
     */

    public static function parseSpaces($string) {
        return str_replace('%20', ' ', $string);
    }

    public static function tagfillin($string) {
        return str_replace(' ', '_', $string);
    }

    public static function tagfillout($string) {
        return str_replace('_', ' ', $string);
    }

    static function makeUrl($args = array()){
        global $wp_rewrite;

        $pageid = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerpageid');
        if(is_numeric($pageid)){
            $permalink = get_the_permalink($pageid);
        }else{
            if(isset($args['jsvehiclemanagerpageid']) && is_numeric($args['jsvehiclemanagerpageid'])){
                $permalink = get_the_permalink($args['jsvehiclemanagerpageid']);
            }else{
                $permalink = get_the_permalink();
            }
        }

        if (!$wp_rewrite->using_permalinks()){
            if(!strstr($permalink, 'page_id') && !strstr($permalink, '?p=')){
                $page['page_id'] = get_option('page_on_front');
                $args = $page + $args;
            }
            $redirect_url = add_query_arg($args,$permalink);
            return $redirect_url;
        }

        if(isset($args['jsvmme']) && isset($args['jsvmlt'])){
            // Get the original query parts
            $redirect = @parse_url($permalink);
            if (!isset($redirect['query']))
                $redirect['query'] = '';

            if(strstr($permalink, '?')){ // if variable exist
                $redirect_array = explode('?', $permalink);
                $_redirect = $redirect_array[0];
            }else{
                $_redirect = $permalink;
            }

            if($_redirect[strlen($_redirect) - 1] == '/'){
                $_redirect = substr($_redirect, 0, strlen($_redirect) - 1);
            }
            // If is layout
            $changename = false;
            if(file_exists(WP_PLUGIN_DIR.'/js-jobs/js-jobs.php')){
                $changename = true;
            }
            if(file_exists(WP_PLUGIN_DIR.'/js-support-ticket/js-support-ticket.php')){
                $changename = true;
            }
            if (isset($args['jsvmlt'])) {
                $layout = '';
                switch ($args['jsvmlt']) {
                    case 'vehiclesbycity':
                        $layout = 'vehicle-by-cities';
                    break;
                    case 'vehiclesbycondition':
                        $layout = 'vehicle-by-conditions';
                    break;
                    case 'sellersbycity':
                        $layout = 'seller-by-cities';
                    break;
                    case 'ratelist':
                        $layout = 'pricing';
                    break;
                    case 'creditslog':
                        $layout = ($changename === true) ? 'vehicle-credit-logs' : 'credit-logs';
                    break;
                    case 'stats':
                        $layout = ($changename === true) ? 'vehicle-stats' : 'stats';
                    break;
                    case 'creditspack':
                        $layout = ($changename === true) ? 'vehicle-packages' : 'packages';
                    break;
                    case 'vehiclesbymake':
                        $layout = 'vehicle-by-makes';
                    break;
                    case 'dashboard':
                        $layout = ($changename === true) ? 'vehicle-my-profile' : 'my-profile';
                    break;
                    case 'profile':
                        $layout = ($changename === true) ? 'vehicle-edit-profile' : 'edit-profile';
                    break;
                    case 'sellerlist':
                        $layout = 'sellers';
                    break;
                    case 'viewsellerinfo':
                        $layout = 'seller';
                    break;
                    case 'purchasehistory':
                        $layout = ($changename === true) ? 'vehicle-purchase-history' : 'purchase-history';
                    break;
                    case 'userregister':
                        $layout = ($changename === true) ? 'vehicle-registration' : 'registration';
                    break;
                    case 'login':
                        $layout = ($changename === true) ? 'vehicle-login' : 'login';
                    break;
                    case 'comparevehicles':
                        $layout = 'compare';
                    break;
                    case 'formvehicle':
                        $layout = 'add-vehicle';
                    break;
                    case 'myvehicles':
                        $layout = 'my-vehicles';
                    break;
                    case 'printvehicle':
                        $layout = 'print-vehicle';
                    break;
                    case 'vehiclepdf':
                        $layout = 'vehicle-pdf';
                    break;
                    case 'shortlistvehicles':
                        $layout = 'shortlisted-vehicles';
                    break;
                    case 'vehicledetail':
                        $layout = 'vehicle-detail';
                    break;
                    case 'vehiclesearch':
                        $layout = 'vehicle-search';
                    break;
                    case 'vehiclealerts':
                        $layout = 'vehicle-alerts';
                    break;
                    case 'vehiclesbytype':
                        $layout = 'vehicle-by-types';
                    break;
                    case 'pdf':
                        $layout = 'vehicle-pdf';
                    break;
                    default:
                        $layout = $args['jsvmlt'];
                    break;
                }
                if(is_home() || is_front_page()){
                    if($_redirect == site_url()){
                        $layout = 'vm-'.$layout;
                    }
                }
                $_redirect .= '/' . $layout;                
            }
            // If is list
            if (isset($args['list'])) {
                $_redirect .= '/' . $args['list'];
            }
            // If is sortby
            if (isset($args['sortby'])) {
                $_redirect .= '/' . $args['sortby'];
            }
            // If is jsvehiclemanagerid
            if (isset($args['jsvehiclemanagerid'])) {
                if($args['jsvmlt'] == 'vehicledetail'){
                    $vehicle_seo = JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigValue('vehicle_seo');
                    if(!empty($vehicle_seo)){
                        $vehicle_seo = JSVEHICLEMANAGERincluder::getJSModel('vehicle')->makeVehicleSeo($vehicle_seo , $args['jsvehiclemanagerid']);
                        if($vehicle_seo != ''){
                            $id = JSVEHICLEMANAGERincluder::getJSModel('common')->parseID($args['jsvehiclemanagerid']);
                            $_redirect .= '/' . $vehicle_seo . '-' . $id;
                        }
                    }
                }else{
                    $_redirect .= '/' . $args['jsvehiclemanagerid'];
                }
            }
            // If is conditionid
            if (isset($args['conditionid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('conditions')->getConditionTitlebyId($args['conditionid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_10' . $args['conditionid'];
            }
            // If is vehicletypeid
            if (isset($args['vehicletypeid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('vehicletype')->getVehicleTypeTitlebyId($args['vehicletypeid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_11' . $args['vehicletypeid'];
            }
            // If is modelyearid
            if (isset($args['modelyearid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('modelyear')->getModelyearTitlebyId($args['modelyearid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_12' . $args['modelyearid'];
            }
            // If is cityid
            if (isset($args['cityid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('city')->getCityNamebyId($args['cityid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_13' . $args['cityid'];
            }
            // If is makeid
            if (isset($args['makeid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('make')->getMakeTitlebyId($args['makeid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_14' . $args['makeid'];
            }
            // If is modelid
            if (isset($args['modelid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('model')->getModelTitlebyId($args['modelid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_15' . $args['modelid'];
            }
            // If is sellerid
            if (isset($args['sellerid'])) {
                $alias = JSVEHICLEMANAGERincluder::getJSModel('user')->getUserNamebyId($args['sellerid']);
                $alias = JSVEHICLEMANAGERincluder::getJSModel('common')->removeSpecialCharacter($alias);
                $_redirect .= '/'.$alias.'_16' . $args['sellerid'];
            }

            // If is jsvehiclemanagerredirecturl
            if (isset($args['jsvehiclemanagerredirecturl'])) {
                $_redirect .= '?jsvehiclemanagerredirecturl=' . $args['jsvehiclemanagerredirecturl'];
            }
            return $_redirect;
        }else{ // incase of form
            $redirect_url = add_query_arg($args,$permalink);
            return $redirect_url;
        }
    }

    static function bjencode($array){
        return base64_encode(json_encode($array));
    }

    static function bjdecode($array){
        return base64_decode(json_encode($array));
    }
    
    static function generateHash($id){
        if(!is_numeric($id)){
            return '';
        }
        return base64_encode(json_encode(base64_encode($id)));
    }

}

$jsvehiclemanager = new jsvehiclemanager();


add_action( 'login_form_middle', 'addLostPasswordLink' );
function addLostPasswordLink() {
    return '<a href="'.site_url().'/wp-login.php?action=lostpassword">'. __('Lost your password','js-vehicle-manager') .'?</a>';
}


add_action('init', 'jsvehiclemanager_custom_init_session', 1);

function jsvehiclemanager_custom_init_session() {
    if (!session_id())
        session_start();
    if(isset($_SESSION['jsvehiclemanager_apply_visitor'])){
        $layout = JSVEHICLEMANAGERrequest::getVar('jsvmlt');
        if($layout != null && $layout != 'addresume'){ // reset the session id
            unset($_SESSION['jsvehiclemanager_apply_visitor']);
        }
    }
    if(isset($_SESSION['wp-jsvehiclemanager']) && isset($_SESSION['wp-jsvehiclemanager']['resumeid'])){
        $layout = JSVEHICLEMANAGERrequest::getVar('jsvmlt');
        if($layout != null && $layout != 'addresume'){ // reset the session id
            unset($_SESSION['wp-jsvehiclemanager']);
        }
    }
}

// define the upgrader_pre_download callback
function filter_upgrader_pre_download_jsvehiclemanager( $bool, $package, $instance ) {
    if(strstr($package,'js-vehicle-manager'))
        return true;
    else
        return false;
};
// add the filter
add_filter( 'upgrader_pre_download', 'filter_upgrader_pre_download_jsvehiclemanager', 10, 3 );


function jsvehiclemanager_register_plugin_styles(){
    include_once 'includes/css/site_color.php';
    wp_enqueue_style('jsauto-site', jsvehiclemanager::$_pluginpath . 'includes/css/site.css');
    wp_enqueue_style('jsauto-site-tablet', jsvehiclemanager::$_pluginpath . 'includes/css/site_tablet.css',array(),'','(min-width: 481px) and (max-width: 780px)');
    wp_enqueue_style('jsauto-site-mobile-landscape', jsvehiclemanager::$_pluginpath . 'includes/css/site_mobile_landscape.css',array(),'','(min-width: 481px) and (max-width: 650px)');
    wp_enqueue_style('jsauto-site-mobile', jsvehiclemanager::$_pluginpath . 'includes/css/site_mobile.css',array(),'','(max-width: 480px)');
    // wp_enqueue_style('jsauto-chosen-site', jsvehiclemanager::$_pluginpath . 'includes/js/chosen/chosen.min.css');
    if (is_rtl()) {
        wp_register_style('jsauto-site-rtl', jsvehiclemanager::$_pluginpath . 'includes/css/sitertl.css');
        wp_enqueue_style('jsauto-site-rtl');
    }
}

add_action( 'wp_enqueue_scripts', 'jsvehiclemanager_register_plugin_styles' );

function jsvehiclemanager_admin_register_plugin_styles() {
    wp_enqueue_style('jsauto-admin-desktop-css', jsvehiclemanager::$_pluginpath . 'includes/css/admin_desktop.css',array(),'','all');
    wp_enqueue_style('jsauto-admin-mobile-css', jsvehiclemanager::$_pluginpath . 'includes/css/admin_mobile.css',array(),'','(max-width: 480px)');
    wp_enqueue_style('jsauto-admin-mobile-landscape-css', jsvehiclemanager::$_pluginpath . 'includes/css/admin_mobile_landscape.css',array(),'','(min-width: 481px) and (max-width: 660px)');
    wp_enqueue_style('jsauto-admin-tablet-css', jsvehiclemanager::$_pluginpath . 'includes/css/admin_tablet.css',array(),'','(min-width: 481px) and (max-width: 782px)');
    if (is_rtl()) {
        wp_register_style('jsauto-admincss-rtl', jsvehiclemanager::$_pluginpath . 'includes/css/adminrtl.css');
        wp_enqueue_style('jsauto-admincss-rtl');
    }
}
add_action( 'admin_enqueue_scripts', 'jsvehiclemanager_admin_register_plugin_styles' );

?>
