<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERreportsModel {

    function overallReportsForGraph(){
        $db = new jsvehiclemanagerdb();
        $result = array();

        // vehicles by Makes
        $query = "SELECT make.id, make.title, make.logo, (SELECT COUNT(veh.id) FROM `#__js_vehiclemanager_vehicles` AS veh WHERE veh.makeid = make.id) AS total 
            FROM `#__js_vehiclemanager_makes` AS make
            WHERE make.status = 1";
        $db->setQuery($query);
        $data = $db->loadObjectList();
        $result['makes'] = $data;

        // vehicles by Types
        $query = "SELECT vtype.id, vtype.title, vtype.logo, (SELECT COUNT(veh.id) FROM `#__js_vehiclemanager_vehicles` AS veh WHERE veh.vehicletypeid = vtype.id) AS total 
            FROM `#__js_vehiclemanager_vehicletypes` AS vtype
            WHERE vtype.status = 1";
        $db->setQuery($query);
        $data = $db->loadObjectList();
        $result['vehicletypes'] = $data;
        
        // vehicles by conditions
        $query = "SELECT con.id, con.title,(SELECT COUNT(veh.id) FROM `#__js_vehiclemanager_vehicles` AS veh WHERE veh.conditionid = con.id) AS total 
            FROM `#__js_vehiclemanager_conditions` AS con
            WHERE con.status = 1";
        $db->setQuery($query);
        $data = $db->loadObjectList();
        $result['conditions'] = $data;
        
        // vehicles by transmission
        $query = "SELECT tm.id, tm.title,(SELECT COUNT(veh.id) FROM `#__js_vehiclemanager_vehicles` AS veh WHERE veh.transmissionid = tm.id) AS total 
            FROM `#__js_vehiclemanager_transmissions` AS tm
            WHERE tm.status = 1";
        $db->setQuery($query);
        $data = $db->loadObjectList();
        $result['transmission'] = $data;
        
        // vehicles by fueltype
        $query = "SELECT ft.id, ft.title,(SELECT COUNT(veh.id) FROM `#__js_vehiclemanager_vehicles` AS veh WHERE veh.fueltypeid = ft.id) AS total 
            FROM `#__js_vehiclemanager_fueltypes` AS ft
            WHERE ft.status = 1";
        $db->setQuery($query);
        $data = $db->loadObjectList();
        $result['fueltype'] = $data;

        // var for graph
        $col1 = __('Conditions','js-vehicle-manager');
        $col2 = __('Vehicles By Conditions','js-vehicle-manager');
        $var = "['$col1', '$col2'],";
        foreach ($result['conditions'] as $object) {
            $var .= "['".__($object->title,'js-vehicle-manager')."' , $object->total],";
        }
        jsvehiclemanager::$_data['conditions'] = $var;
        
        // var for graph
        $col1 = __('Vehicle types','js-vehicle-manager');
        $col2 = __('Vehicle By types','js-vehicle-manager');
        $var = "['$col1', '$col2'],";
        foreach ($result['vehicletypes'] as $object) {
            $var .= "['".__($object->title,'js-vehicle-manager')."' , $object->total],";
        }
        jsvehiclemanager::$_data['vehicletypes'] = $var;
        
        // var for graph
        $col1 = __('Makes','js-vehicle-manager');
        $col2 = __('Vehicle By Makes','js-vehicle-manager');
        $var = "['$col1', '$col2'],";
        foreach ($result['makes'] as $object) {
            $var .= "['".__($object->title,'js-vehicle-manager')."' , $object->total],";
        }
        jsvehiclemanager::$_data['makes'] = $var;
        
        // var for graph
        $col1 = __('Transmissions','js-vehicle-manager');
        $col2 = __('Vehicle By Transmissions','js-vehicle-manager');
        $var = "['$col1', '$col2'],";
        foreach ($result['transmission'] as $object) {
            $var .= "['".__($object->title,'js-vehicle-manager')."' , $object->total],";
        }
        jsvehiclemanager::$_data['transmission'] = $var;
        
        // var for graph
        $col1 = __('Fuel types','js-vehicle-manager');
        $col2 = __('Vehicle By Fuel types','js-vehicle-manager');
        $var = "['$col1', '$col2'],";
        foreach ($result['fueltype'] as $object) {
            $var .= "['".__($object->title,'js-vehicle-manager')."' , $object->total],";
        }
        jsvehiclemanager::$_data['fueltype'] = $var;
    }
  
}
?>