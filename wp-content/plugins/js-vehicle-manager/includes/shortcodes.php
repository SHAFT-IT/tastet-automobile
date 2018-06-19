<?php
if (!defined('ABSPATH'))
    die('Restricted Access');
	// Vehicle Manager Pages
	if( ! function_exists( 'vehicle_manager_pages' ) ) {
	    function vehicle_manager_pages($raw_args, $content = null){
	    	ob_start();
	        $defaults = array(
	            'page' => "",
	            'tell_a_friend' => "",
	            'title' => __('Thank you','js-vehicle-manager'),
	            'message' => __('Please add your text field for the ','js-vehicle-manager'),
	        );
	        $sanitized_args = shortcode_atts($defaults, $raw_args);
            if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
                jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
            }else{
	        	jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
            }
	        //echo '<pre>';print_r(jsvehiclemanager::$_data['sanitized_args']);echo '</pre>';exit;
	        $pageid = JSVEHICLEMANAGERrequest::getVar('page_id');
	        if(!$pageid)  $pageid = get_the_ID();
	        jsvehiclemanager::setPageID($pageid);
	        jsvehiclemanager::addStyleSheets();
	        $offline = JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
	        if ($offline == 1) {
	            JSVEHICLEMANAGERlayout::getSystemOffline();
	        } else {
	        	switch($sanitized_args['page']){
	        		case 1: // List Vehicles
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehicles' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 2: // List Search
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehiclesearch' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 3: // Add Vehicle
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'formvehicle' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 4: // My Vehicles
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'myvehicles' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 5: // My Profile
		        		$module = 'user';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'dashboard' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 7: // Vehicle Detail
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehicledetail' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 8: // Shortlisted Vehicles
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'shortlistvehicles' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 9: // Vehicles by City
		        		$module = 'city';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehiclesbycity' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 10: // Vehicles by Type
		        		$module = 'vehicletype';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehiclesbytype' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 11: // Vehicles by Make
		        		$module = 'make';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehiclesbymake' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 12: // Seller List
		        		$module = 'user';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'sellerlist' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 13: // Seller Detail
		        		$module = 'user';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'viewsellerinfo' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 19: // Login
		        		$module = 'jsvehiclemanager';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'login' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		case 20: // Thank you
		        		$module = 'jsvehiclemanager';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'thankyou' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        		default:
		        		$module = 'vehicle';
		        		jsvehiclemanager::$_data['sanitized_args']['jsvmlt'] = (!isset(jsvehiclemanager::$_data['sanitized_args']['jsvmlt']) || empty(jsvehiclemanager::$_data['sanitized_args']['jsvmlt'])) ? 'vehicles' : jsvehiclemanager::$_data['sanitized_args']['jsvmlt'];
	        		break;
	        	}
	        	//echo '<pre>';print_r(jsvehiclemanager::$_data['sanitized_args']);exit;
				$c_mod = JSVEHICLEMANAGERrequest::getVar('jsvmme');
	        	if($c_mod){
	        		$module = $c_mod;
	        	}
	        	JSVEHICLEMANAGERincluder::include_file($module);
	        }
	        $content .= ob_get_clean();
	        return $content;
	    }
	}
add_shortcode( 'vehicle_manager_pages', 'vehicle_manager_pages' );
// plugin shortcodes start 
	add_shortcode('jsvehiclemanager_list_vehicles', 'show_list_vehicles');
		function show_list_vehicles($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'vehicle',
		        'jsvmlt' => 'vehicles',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'vehicle');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'vehicles');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_vehicle_search', 'show_vehicle_search');
		function show_vehicle_search($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'vehicle',
		        'jsvmlt' => 'vehiclesearch',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'vehicle');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'vehiclesearch');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_add_vehicle', 'show_add_vehicle');
		function show_add_vehicle($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'vehicle',
		        'jsvmlt' => 'formvehicle',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'vehicle');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'formvehicle');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_my_vehicles', 'show_my_vehicles');
		function show_my_vehicles($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'vehicle',
		        'jsvmlt' => 'myvehicles',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'vehicle');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'myvehicles');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_control_panel', 'show_control_panel');
		function show_control_panel($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'user',
		        'jsvmlt' => 'dashboard',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'user');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'dashboard');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
		
	add_shortcode('jsvehiclemanager_vehicles_by_city', 'show_vehicles_by_city');
		function show_vehicles_by_city($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'city',
		        'jsvmlt' => 'vehiclesbycity',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'city');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'vehiclesbycity');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_vehicles_by_type', 'show_vehicles_by_type');
		function show_vehicles_by_type($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'vehicletype',
		        'jsvmlt' => 'vehiclesbytype',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'vehicletype');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'vehiclesbytype');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_vehicles_by_make', 'show_vehicles_by_make');
		function show_vehicles_by_make($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'make',
		        'jsvmlt' => 'vehiclesbymake',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'make');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'vehiclesbymake');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_sellers_list', 'show_sellers_list');
		function show_sellers_list($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'user',
		        'jsvmlt' => 'sellerlist',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'user');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'sellerlist');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_sellers_by_city', 'show_sellers_by_city');
		function show_sellers_by_city($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'user',
		        'jsvmlt' => 'sellerbycity',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'user');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'sellerbycity');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
		
	add_shortcode('jsvehiclemanager_login', 'show_login');
		function show_login($raw_args, $content = null) {
		    //default set of parameters for the front end shortcodes
		    ob_start();
		    $defaults = array(
		        'jsvmme' => 'jsvehiclemanager',
		        'jsvmlt' => 'login',
		    );
		    $sanitized_args = shortcode_atts($defaults, $raw_args);
		    if(isset(jsvehiclemanager::$_data['sanitized_args']) && !empty(jsvehiclemanager::$_data['sanitized_args'])){
		        jsvehiclemanager::$_data['sanitized_args'] += $sanitized_args;
		    }else{
		        jsvehiclemanager::$_data['sanitized_args'] = $sanitized_args;
		    }
		    $pageid = get_the_ID();
		    jsvehiclemanager::setPageID($pageid);
		    jsvehiclemanager::addStyleSheets();
		    $offline =JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigurationByConfigName('offline');
		    if ($offline == 1) {
		        JSVEHICLEMANAGERlayout::getSystemOffline();
		    } elseif (JSVEHICLEMANAGERincluder::getObjectClass('user')->isdisabled()) { // handling for the user disabled
		        JSVEHICLEMANAGERlayout::getUserDisabledMsg();
		    } else {
		        $module = JSVEHICLEMANAGERrequest::getVar('jsvmme', null, 'jsvehiclemanager');
		        $layout = JSVEHICLEMANAGERrequest::getLayout('jsvmlt', null, 'login');
	            JSVEHICLEMANAGERincluder::include_file($module);
		    }
		    $content .= ob_get_clean();
		    return $content;
		}
?>