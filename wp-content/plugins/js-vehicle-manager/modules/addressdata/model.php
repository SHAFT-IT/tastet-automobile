<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERAddressdataModel {

    function loadaddressdata() {
        ob_start();
        if ($_FILES['loadaddressdata']['size'] > 0) {
            $db = new jsvehiclemanagerdb();
            $file_name = $_FILES['loadaddressdata']['name']; // file name
            $file_tmp = $_FILES['loadaddressdata']['tmp_name']; // actual location
            $file_size = $_FILES['loadaddressdata']['size']; // file size
            $file_type = $_FILES['loadaddressdata']['type']; // mime type of file determined by php
            $file_error = $_FILES['loadaddressdata']['error']; // any error!. get reason here
            if (!empty($file_tmp)) { // only MS office and text file is accepted.
                $ext = JSVEHICLEMANAGERincluder::getJSModel('common')->getExtension($file_name);
                if (($ext != "zip") && ($ext != "sql"))
                    return FILE_TYPE_ERROR; //file type mistmathc
            }
            $path = jsvehiclemanager::$_path . 'data';
            if (!file_exists($path)) { // creating data directory
                JSVEHICLEMANAGERincluder::getJSModel('common')->makeDir($path);
            }
            $path = jsvehiclemanager::$_path . 'data/temp';
            if (!file_exists($path)) { // creating temp directory
                JSVEHICLEMANAGERincluder::getJSModel('common')->makeDir($path);
            }
            $comp_filename = $path . '/' . $file_name;
            move_uploaded_file($file_tmp, $path . '/' . $file_name);
            if ($ext == 'zip') {
                require_once jsvehiclemanager::$_path . '/includes/lib/pclzip.lib.php';
                $archive = new PclZip($comp_filename);
                $list = $archive->listContent();
                if ($archive->extract(PCLZIP_OPT_PATH, $path) == 0) {
                    die("Error : " . $archive->errorInfo(true));
                }
                $comp_filename = $path . '/' . $list[0]['filename'];
            }

            $comp_filename .= 'cities.sql';
            $filestring = file_get_contents($comp_filename);

            $option = $_POST['datakept'];
            $fileowner = $_POST['fileowner'];
            $datacontain = $_POST['datacontain'];
            if(($filestring != false) AND ($fileowner == 2)){

                $hasstate = strpos($filestring, '#__js_vehiclemanager_states');
                $hascities = strpos($filestring, '#__js_vehiclemanager_cities');
                
                if (($hasstate) AND ($hascities)) {
                    $filestring = str_replace('#__', $db->prefix, $filestring);
                    $queries = explode(';', $filestring);
                    unset($queries[count($queries) - 1]);
                    $perquery = 0;
                    echo "<style type=\"text/css\">
                                div#progressbar{display:block;width:275px;height:20px;position:relative;padding:2px;border:1px solid #E0E1E0;}
                                span#backgroundtext{position:absolute;width:275px;height:20px;top:0px;left:0px;text-align:center;}
                                span#backgroundcolour{display:block;height:20px;background:#D8E8ED;width:1%;}
                                h1{color:1A5E80;}
                            </style>";
                    echo str_pad('<html><h1>' . __('Address Data Update', 'js-vehicle-manager') . '</h1><div id="progressbar"><span id="backgroundtext">0% complete.</span><span id="backgroundcolour" style="width:1%;"></span></div></html>', 5120);
                    echo str_pad(__('LOADING'), 5120) . "<br />\n";
                    ob_flush();
                    flush();
                    if ($option == 1) { //kept data
                        $city_insert = 0;
                        $state_insert = 0;
                        echo str_pad(__('Backup', 'js-vehicle-manager'), 5120) . "<br />\n";
                        ob_flush();
                        flush();
                        if ($fileowner == 1) { // myfile
                        } elseif ($fileowner == 2) { // joomsky file
                            if ($datacontain == 1) { // states
                                $state_insert = 1;
                            } elseif ($datacontain == 2) { // cities
                            $city_insert = 1    ;
                        } elseif ($datacontain == 3) { // states and cities
                                $city_insert = 1;
                                $state_insert = 1;
                            }
                        }
                        if ($city_insert == 1) {
                            $drop_city = "DROP TABLE IF EXISTS `" . $db->prefix . "js_vehiclemanager_cities_new`";
                            $db->setQuery($drop_city);
                            $db->query();

                            $create_cities = " CREATE TABLE `" . $db->prefix . "js_vehiclemanager_cities_new` (
    							  `id` mediumint(6) NOT NULL,
                                  `cityName` varchar(70) DEFAULT NULL,
                                  `name` varchar(60) DEFAULT NULL,
                                  `stateid` smallint(8) DEFAULT NULL,
                                  `countryid` smallint(9) DEFAULT NULL,
                                  `latitude` varchar(50) DEFAULT NULL,
                                  `longitude` varchar(50) DEFAULT NULL,
                                  `enabled` tinyint(1) NOT NULL DEFAULT '0'
                                  PRIMARY KEY (`id`),
    							  KEY `countryid` (`countryid`),
    							  KEY `stateid` (`stateid`),
							  FULLTEXT KEY `name` (`name`)   
							) ENGINE=MyISAM DEFAULT CHARS    ET=utf8 COMMENT='utf8_general_ci'";
                            $db->setQuery($create_cities);
                            $db->query();
                            

                        $query = "INSERT INTO    `" . $db->prefix . "js_vehiclemanager_cities_new`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
							SELECT city.id,  city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
                            	FROM `" . $db->prefix . "js_vehiclemanager_cities` AS city";

                           // jsvehiclemanagerdb::query($query);
                        }
                        if ($state_insert == 1) {
                            $drop_state = "DROP TABLE IF EXISTS `" . $db->prefix . "js_vehiclemanager_states_new`";

                            $db->setQuery($drop_state);
                            $db->query();

                            $create_state = "CREATE TABLE `" . $db->prefix . "js_vehiclemanager_states_new` (
    						  `id` smallint(8) NOT NULL AUTO_INCREMENT,
    						  `name` varchar(35) DEFAULT NULL,
    						  `shortRegion` varchar(25) DEFAULT NULL,
    						  `countryid` smallint(9) DEFAULT NULL,
    						  `enabled` tinyint(1) NOT NULL DEFAULT '0',
    						  PRIMARY KEY (`id`),
    						  KEY `countryid` (`countryid`),
						  FULLTEXT KEY `name` (`name`)    
						) ENGINE=MyISAM DEFAULT CHARSE    T=utf8 COMMENT='utf8_general_ci'";

                            $db->setQuery($create_state);
                            $db->query();


                            $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_states_new`(id,name,shortRegion,countryid,enabled)
    							SELECT state.id AS id,state.name AS name,state.shortRegion AS shortRegion,state.countryid AS countryid,state.enabled AS enabled
    							FROM `" . $db->prefix . "js_vehiclemanager_states` AS state
    							";

                           // jsvehiclemanagerdb::query($query);
                        }
                    } elseif ($option == 2) {// Discard old data;
                        $discaed_city = 0;
                        $discaed_state = 0;
                        echo str_pad(__('Delete', 'js-vehicle-manager'), 5120) . "<br />\n";
                        ob_flush();
                        flush();
                        if ($fileowner == 1) { // myfile
                            $discaed_city = 1;
                            $discaed_state = 1;
                        } elseif ($fileowner == 2) { // joomsky file
                            if ($datacontain == 1) { // states
                                $discaed_state = 1;
                            } elseif ($datacontain == 2) { // cities
                                $discaed_city = 1;
                            } elseif ($datacontain == 3) { // states and cities
                                $discaed_city = 1;
                                $discaed_state = 1;
                            }
                        }
                        if ($discaed_city == 1) {
                            
                            $drop_city = "DROP TABLE IF EXISTS `" . $db->prefix . "js_vehiclemanager_cities_new`";
                            $db->setQuery($drop_city);
                            $db->query();

                            $q = "DELETE FROM `" . $db->prefix . "js_vehiclemanager_cities`";
                            $db->setQuery($q);
                            $db->query();

                        }
                        if ($discaed_state == 1) {
                            
                            $drop_state = "DROP TABLE IF EXISTS `" . $db->prefix . "js_vehiclemanager_states_new`";
                            $db->setQuery($drop_state);
                            $db->query();

                            $q = "DELETE FROM `" . $db->prefix . "js_vehiclemanager_states`";
                            $db->setQuery($q);
                            $db->query();

                        }
                    }
                    echo str_pad(__('Importing New Data', 'js-vehicle-manager'), 5120) . "<br />\n";
                    ob_flush();
                    flush();

                    $percentageperquery = count($queries) - 1;
                    $percentageperquery = round( 100 / $percentageperquery , 1);
                $percentageperquery = ($percentageperquery > 100) ? 100 : $percentageperquery;
                if($option == 1){   

                        $queries = str_replace('js_vehiclemanager_states', 'js_vehiclemanager_states_new', $queries);
                    $queries = str_replace  ('js_vehiclemanager_cities', 'js_vehiclemanager_cities_new', $queries);

                        if($state_insert == 1){
                            $q = "DELETE FROM `" . $db->prefix . "js_vehiclemanager_states`";
                           // jsvehiclemanagerdb::query($q);
                        }
                        if($city_insert == 1){
                            $q = "DELETE FROM `" . $db->prefix . "js_vehiclemanager_cities`";
                            // jsvehiclemanagerdb::query($q);
                        }
    
                        if($state_insert == 1 AND $city_insert == 1){

                        }else{
                            if($city_insert == 1){ // only cities
                                unset($queries[0]);
                            }else{ 
                                $temp = $queries;
                                $queries = array();
                                $queries[0] = $temp[0]; // only states
                            }
                        }
                    }else{
                        if($discaed_state == 1 AND $discaed_city == 1){

                        }else{
                            if($discaed_city == 1){ // only cities
                                unset($queries[0]);
                            }else{ 
                                $temp = $queries;
                                $queries = array();
                                $queries[0] = $temp[0]; // only states
                            }
                        }                        
                    }

                    $perquery = 0;

                    foreach ($queries AS $query) {
                        if (!empty($query)) {
                            $db->setQuery($query);
                            $db->query();
                        }
                        $perquery += $percentageperquery;
                        $perquery = ($perquery > 100) ? 100 : $perquery;
                        //This div will show loading percents
                        echo str_pad('<script type="text/javascript">document.getElementById("backgroundcolour").style.width = "' . $perquery . '%";</script>', 50120);
                        echo str_pad('<script type="text/javascript">document.getElementById("backgroundtext").innerHTML = "' . $perquery . '% complete.";</script>', 50120);
                        ob_flush();
                        flush();
                }   

                    if ($option == 1) {// kept data
                        if ($city_insert == 1) {
                            $removeduplicationofcities = $this->correctCityData();
                            if ($removeduplicationofcities == 0)
                                return SAVE_ERROR;
                            $q = "DROP TABLE `" . $db->prefix . "js_vehiclemanager_cities_new`";

                            $db->setQuery($query);
                            $db->query();
                        }
                        if ($state_insert == 1) {
                            $removeduplicationofstates = $this->correctStateData();
                            if ($removeduplicationofstates == 0)
                                return SAVE_ERROR;
                            $q = "DROP TABLE `" . $db->prefix . "js_vehiclemanager_states_new`";

                            $db->setQuery($query);
                            $db->query();
                        }
                    }
                    return SAVED;
                }// iffile
            }
        }
        return false; //return 0 if any error occured
}   

    function correctCityData() {
        $db = new jsvehiclemanagerdb();
        $query = "SELECT country.id AS countryid FROM `" . $db->prefix . "js_vehiclemanager_countries` AS country ";

        $db->setQuery($query);
        $country_data = $db->loadObjectList();
    $query = "DELETE FROM `" . $db->prefix . "js_vehiclemanager_cities`";

        $db->setQuery($query);
        $db->query();

        foreach ($country_data AS $d) {
            switch ($d->countryid) {
            case 1:// United States Country 
                $query = "SELECT state.i    d AS stateid FROM `" . $db->prefix . "js_vehiclemanager_states` AS state WHERE countryid=" . $d->countryid;
                    $db->setQuery($query);
                    $us_state_by_id = $db->loadObjectList();
                    if (is_array($us_state_by_id) AND ( !empty($us_state_by_id))) {
                        foreach ($us_state_by_id AS $sid) {
                            if ($sid->stateid) {
                            $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_cities`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
                                            SELECT city.id, city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
                                        FROM `" . $db->prefix . "js_ vehiclemanager_cities_new` AS city WHERE stateid=" . $sid->stateid . " AND countryid=" . $d->countryid . " group by cityName,name ";

                                $db->setQuery($query);
                                if(!$db->query())
                                    return 0;
                            }else {
                                $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_cities`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
                                            SELECT city.id, city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
                                            FROM `" . $db->prefix . "js_vehiclemanager_cities_new` AS city WHERE countryid=" . $d->countryid . " group by cityName,name ";

                             $db->setQuery($query);
                            if(!$db->query())
                                    return 0;
                            }
                        }
                    }
                    break;
            case 2: 
                    $query = "SELECT state.id AS stateid FROM `" . $db->prefix . "js_vehiclemanager_states` AS state WHERE countryid=" . $d->countryid;
                    $db->setQuery($query);
                    $ca_state_by_id = $db->loadObjectList();
                    if (is_array($ca_state_by_id) AND ( !empty($ca_state_by_id))) {
                        foreach ($ca_state_by_id AS $sid) {
                            if ($sid->stateid) {
                            $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_cities`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
							    			SELECT city.id, city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
										FROM `" . $db->prefix . "js_  vehiclemanager_cities_new` AS city WHERE stateid=" . $sid->stateid . " AND countryid=" . $d->countryid . " group by cityName,name ";

                                $db->setQuery($query);
                                if(!$db->query())
                                    return 0;
                            }else {
                                $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_cities`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
											SELECT city.id, city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
											FROM `" . $db->prefix . "js_vehiclemanager_cities_new` AS city WHERE countryid=" . $d->countryid . " group by cityName,name ";

                                $db->setQuery($query);
                                if(!$db->query())
                                    return 0;
                        }   
                    }   
                    }
                    break;
                default:
                    $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_cities`(id, cityName, name, stateid, countryid, latitude, longitude, enabled)
								SELECT city.id, city.cityName, city.name, city.stateid, city.countryid, city.latitude, city.longitude, city.enabled
								FROM `" . $db->prefix . "js_vehiclemanager_cities_new` AS city WHERE countryid=" . $d->countryid . " group by cityName,name ";
                    $db->setQuery($query);
                    if (!$db->query())
                        return 0;
                    break;
            }
        }
        return true;
}   

    function correctStateData() {
        $db = new jsvehiclemanagerdb();
        $query = "SELECT country.id AS countryid FROM `" . $db->prefix . "js_vehiclemanager_countries` AS country ";
        $db->setQuery($query);
        $country_data = $db->loadObjectList();
    $query = "DELETE FROM `" . $db->prefix .  "js_vehiclemanager_states`";

        $db->setQuery($query);
        $db->query();

        foreach ($country_data AS $d) {
            $query = "INSERT INTO `" . $db->prefix . "js_vehiclemanager_states`(id,name,shortRegion,countryid,enabled)
					SELECT state.id AS id,state.name AS name,state.shortRegion AS shortRegion,state.countryid AS countryid,state.enabled AS enabled
					FROM `" . $db->prefix . "js_vehiclemanager_states_new` AS state WHERE countryid=" . $d->countryid . " group by name ";
                $db->setQuery($query);
            if (!$db->query())
                return 0;
        }
        return true;
    }
    
    function getMessagekey(){
        $key = 'addressdata';if(is_admin()){$key = 'admin_'.$key;}return $key;
    }

}

?>
