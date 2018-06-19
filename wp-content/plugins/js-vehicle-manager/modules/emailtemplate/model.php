<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGEREmailtemplateModel {

    function sendMail($mailfor, $action, $id) {
        if (!is_numeric($mailfor))
            return false;
        if (!is_numeric($action))
            return false;
        if ($id != null)
            if (!is_numeric($id))
                return false;
        $config_array = JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigByFor('email');
        $senderEmail = $config_array['mailfromaddress'];
        $senderName = $config_array['mailfromname'];
        $adminEmailid = $config_array['adminemailaddress'];

        $isguest = JSVEHICLEMANAGERincluder::getObjectClass('user')->isguest();
        $pageid = jsvehiclemanager::getPageid();
        switch ($mailfor) {
            case 1: // Vehicle
                switch ($action) {
                    case 1: // Add New
                        $creditid = JSVEHICLEMANAGERrequest::getVar('creditid');
                        
                        $record = $this->getRecordByTablenameAndId('js_vehiclemanager_vehicles', $id,$creditid);
                        if(empty($record)){
                            return;
                        }
                        $username = $record->name;
                        $vehname = $record->maketitle.'-'.$record->modeltitle.'-'.$record->modelyeartitle;
                        $email = $record->email;
                        $status = $record->status;
                        $location = $record->location;
                        $maketitle = $record->maketitle;
                        $modeltitle = $record->modeltitle;
                        $modelyeartitle = $record->modelyeartitle;
                        
                        $credits = 0;
                        $checkstatus = null;

                        $link = null;
                        if ($status == 1) {
                            $checkstatus = __('Approved', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle', 'jsvmlt'=>'vehicledetail', 'jsvehiclemanagerid'=>$id)) .'" target="_blank">' . __('Vehicle Detail', 'js-vehicle-manager') . '</a>';
                        }
                        if ($status == -1) {
                            $checkstatus = __('Rejected', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle' , 'jsvmlt' => 'myvehicles' )) .'" target="_blank">' . __('Vehicles', 'js-vehicle-manager') . '</a>';
                        }
                        if ($status == 0) {
                            $checkstatus = __('Pending', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle' , 'jsvmlt' => 'myvehicles' )) .'" target="_blank">' . __('Vehicles', 'js-vehicle-manager') . '</a>';
                        }

                        $matcharray = array(
                            '{VEHICLE_TITLE}' => $vehname,
                            '{SELLER_NAME}' => $username,
                            '{VEHICLE_LINK}' => $link,
                            '{VEHICLE_STATUS}' => $checkstatus,
                            '{VEHICLE_CREDITS}' => $credits,
                            '{LOCATION}' => $location,
                        );
                        
                        $getEmailStatus = JSVEHICLEMANAGERincluder::getJSModel('emailtemplatestatus')->getEmailTemplateStatus('add_new_vehicle');

                        $template = $this->getTemplateForEmail('new-vehicle');
                        $msgSubject = $template->subject;
                        $msgBody = $template->body;
                        $this->replaceMatches($msgSubject, $matcharray);
                        $this->replaceMatches($msgBody, $matcharray);

                        // Add New vehicle mail to User

                        if ($getEmailStatus->seller == 1) {
                            $this->sendEmail($email, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }

                        if ($getEmailStatus->admin == 1) {
                            $template = $this->getTemplateForEmail('new-vehicle-admin');
                            $msgSubject = $template->subject;
                            $msgBody = $template->body;
                            $this->replaceMatches($msgSubject, $matcharray);
                            $this->replaceMatches($msgBody, $matcharray);
                            $link = '<a href="' . admin_url("admin.php?page=jsvm_vehicle") .'" target="_blank">' . __('Vehicles', 'js-vehicle-manager') . '</a>';
                            $matcharray{'{VEHICLE_LINK}'} = $link;
                            $msgSubject = $template->subject;
                            $msgBody = $template->body;
                            $this->replaceMatches($msgSubject, $matcharray);
                            $this->replaceMatches($msgBody, $matcharray);

                            $this->sendEmail($adminEmailid, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }
                        break;
                    case 2: // Vehicle Delete
                        $getEmailStatus = JSVEHICLEMANAGERincluder::getJSModel('emailtemplatestatus')->getEmailTemplateStatus('delete_vehicle');
                        if ($getEmailStatus->seller == 1) {                        
                                
                            $matcharray = array(
                                '{SELLER_NAME}' => $_SESSION['autoz-email']['sellername'],
                                '{VEHICLE_TITLE}' => $_SESSION['autoz-email']['vehicletitle']
                            );
                            $email = $_SESSION['autoz-email']['useremail'];
                            
                            $template = $this->getTemplateForEmail('delete-vehicle');
                            $msgSubject = $template->subject;
                            $msgBody = $template->body;
                            $this->replaceMatches($msgSubject, $matcharray);
                            $this->replaceMatches($msgBody, $matcharray);
                            
                            unset($_SESSION['autoz-email']);
                            // vehicle Delete mail to User
                            $this->sendEmail($email, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }
                        break;
                    case 3: // VEHICLE approve OR reject
                        $creditid = JSVEHICLEMANAGERrequest::getVar('creditid');

                        $record = $this->getRecordByTablenameAndId('js_vehiclemanager_vehicles', $id,$creditid);
                        if(empty($record)){
                            return;
                        }
                        $username = $record->name;
                        $vehname = $record->maketitle.'-'.$record->modeltitle.'-'.$record->modelyeartitle;
                        $email = $record->email;
                        $status = $record->status;
                        $location = $record->location;
                        $maketitle = $record->maketitle;
                        $modeltitle = $record->modeltitle;
                        $modelyeartitle = $record->modelyeartitle;
                        
                        $credits = 0;

                        $link = null;
                        $checkstatus = null;
                        if ($status == 1) {
                            $checkstatus = __('Approved', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle', 'jsvmlt'=>'vehicledetail', 'jsvehiclemanagerid'=>$id)) .'" target="_blank">' . __('Vehicle Detail', 'js-vehicle-manager') . '</a>';
                        }
                        if ($status == -1) {
                            $checkstatus = __('Rejected', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle' , 'jsvmlt' => 'myvehicles' )) .'" target="_blank">' . __('My Vehicles', 'js-vehicle-manager') . '</a>';
                        }

                        $matcharray = array(
                            '{VEHICLE_TITLE}' => $vehname,
                            '{SELLER_NAME}' => $username,
                            '{VEHICLE_LINK}' => $link,
                            '{VEHICLE_STATUS}' => $checkstatus,
                            '{VEHICLE_CREDITS}' => $credits,
                            '{LOCATION}' => $location
                        );

                        $template = $this->getTemplateForEmail('vehicle-status');
                        $getEmailStatus = JSVEHICLEMANAGERincluder::getJSModel('emailtemplatestatus')->getEmailTemplateStatus('vehicle_status');

                        $msgSubject = $template->subject;
                        $msgBody = $template->body;
                        $this->replaceMatches($msgSubject, $matcharray);
                        $this->replaceMatches($msgBody, $matcharray);

                        // vehicle Approve mail to User
                        if ($getEmailStatus->seller == 1 && $record->visitor_vehicle != 0 ) {
                            $this->sendEmail($email, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }
                        if ($status == 1) {
                            $checkstatus = __('Approved', 'js-vehicle-manager');
                            $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'vehicle', 'jsvmlt'=>'vehicledetail', 'jsvehiclemanagerid'=>$id)) .'" target="_blank">' . __('Vehicle Detail', 'js-vehicle-manager') . '</a>';
                        }
                        if ($status == -1) {
                            $checkstatus = __('Rejected', 'js-vehicle-manager');
                            $link = null;
                        }
                        if ($status == 2) {
                            $checkstatus = __('Removed', 'js-vehicle-manager');
                            $link = null;
                        }

                        $matcharray{'{VEHICLE_LINK}'} = $link;
                        $matcharray{'{VEHICLE_STATUS}'} = $checkstatus;

                        $msgSubject = $template->subject;
                        $msgBody = $template->body;
                        $this->replaceMatches($msgSubject, $matcharray);
                        $this->replaceMatches($msgBody, $matcharray);
                        // vehicle Approve mail to visitor
                        if ($getEmailStatus->seller_visitor == 1 && $record->visitor_vehicle == 0) {
                            $this->sendEmail($email, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }
                        break;
                }
                break;
            case 2: // mail for purchase credits pack
            break;
            case 3: //user resgistration
                switch ($action) {
                    case 1: //user register registration
                        $record = $this->getRecordByTablenameAndId('users', $id);
                        if(empty($record)){
                            return;
                        }
                        $link = null;

                        $Username = $record->username;
                        $email = $record->useremail;

                        $link = '<a href="' . jsvehiclemanager::makeUrl(array('jsvehiclemanagerpageid'=>jsvehiclemanager::getPageid(), 'jsvmme'=>'user', 'jsvmlt'=>'dashboard')) .'" target="_blank">' . __('Dashboard', 'js-vehicle-manager') . '</a>';
                        $matcharray = array(
                            '{SELLER_NAME}' => $Username,
                            '{MY_DASHBOARD_LINK}' => $link
                        );

                        $template = $this->getTemplateForEmail('new-seller');
                        $getEmailStatus = JSVEHICLEMANAGERincluder::getJSModel('emailtemplatestatus')->getEmailTemplateStatus('add_new_seller');
                        $msgSubject = $template->subject;
                        $msgBody = $template->body;
                        $this->replaceMatches($msgSubject, $matcharray);
                        $this->replaceMatches($msgBody, $matcharray);

                        // New vehicleseeker registration mail to user
                        if ($getEmailStatus->seller == 1) {
                            $this->sendEmail($email, $msgSubject, $msgBody, $senderEmail, $senderName, '');
                        }
                        break;
                }
                break;
        }
    }

    function getTemplate($tempfor) {
        if(!$tempfor)
            return '';

        $db = new jsvehiclemanagerdb();
        $query = "SELECT * FROM `#__js_vehiclemanager_emailtemplates` WHERE templatefor = '" . $tempfor . "'";
        $db->setQuery($query);
        jsvehiclemanager::$_data[0] = $db->loadObject();
        return;
    }

    function storeEmailTemplate($data) {
        if (empty($data))
            return false;

        $data['body'] = wpautop(wptexturize(stripslashes($data['body'])));
        $row = JSVEHICLEMANAGERincluder::getJSTable('emailtemplate');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }
        if (!$row->store()) {
            return SAVE_ERROR;
        }

        return SAVED;
    }

    function getTemplateForEmail($templatefor) {
        $db = new jsvehiclemanagerdb();
        $query = "SELECT * FROM `#__js_vehiclemanager_emailtemplates` WHERE templatefor = '" . $templatefor . "'";
        $db->setQuery($query);
        $template = $db->loadObject();
        return $template;
    }

    function replaceMatches(&$string, $matcharray) {
        foreach ($matcharray AS $find => $replace) {
            $string = str_replace($find, $replace, $string);
        }
    }

    function sendEmail($recevierEmail, $subject, $body, $senderEmail, $senderName, $attachments = '') {
        if (!$senderName)
            $senderName = jsvehiclemanager::$_config['title'];
        $headers = 'From: ' . $senderName . ' <' . $senderEmail . '>' . "\r\n";
        add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
        $body = preg_replace('/\r?\n|\r/', '<br/>', $body);
        $body = str_replace(array("\r\n", "\r", "\n"), "<br/>", $body);
        $body = nl2br($body);
        wp_mail($recevierEmail, $subject, $body, $headers, $attachments);
    }

    function getRecordByTablenameAndId($tablename, $id, $creditid = null) {
        if (!is_numeric($id))
            return false;
        $query = null;
        $db = new jsvehiclemanagerdb();
        switch ($tablename) {
            case 'js_vehiclemanager_vehicles':
                $query = "SELECT user.uid 
                    FROM `#__js_vehiclemanager_vehicles` AS veh
                    JOIN `#__js_vehiclemanager_users` AS user ON user.id = veh.uid
                    WHERE veh.id = ".$id;
                $db->setQuery($query);
                $guest_vehivle = $db->loadResult();

                if($guest_vehivle == 0){
                    $query = "SELECT veh.id, veh.uid, veh.status, veh.isfeaturedvehicle, user.name, user.email, user.uid AS visitor_vehicle, veh.loccity, make.title AS maketitle, model.title AS modeltitle, mdy.title AS modelyeartitle
                        FROM `#__js_vehiclemanager_vehicles` AS veh
                        JOIN `#__js_vehiclemanager_makes` AS make ON make.id = veh.makeid
                        JOIN `#__js_vehiclemanager_models` AS model ON model.id = veh.modelid
                        LEFT JOIN `#__js_vehiclemanager_users` AS user ON user.id = veh.uid
                        LEFT JOIN `#__js_vehiclemanager_modelyears` AS mdy ON mdy.id = veh.modelyearid
                        WHERE veh.id = ".$id;
                    $db->setQuery($query);
                    $data = $db->loadObject();
                    if(!empty($data)){
                        $data->location = JSVEHICLEMANAGERincluder::getJSModel('city')->getLocationDataForView($data->loccity);
                    }
                    return $data;
                }else {
                    $credtitsforaddvehicle = 0;
                    $query = "SELECT veh.id, veh.uid, veh.status, veh.isfeaturedvehicle, user.name, user.email, user.uid AS visitor_vehicle, veh.loccity, make.title AS maketitle, model.title AS modeltitle, mdy.title AS modelyeartitle
                        FROM `#__js_vehiclemanager_vehicles` AS veh
                        JOIN `#__js_vehiclemanager_makes` AS make ON make.id = veh.makeid
                        JOIN `#__js_vehiclemanager_models` AS model ON model.id = veh.modelid
                        JOIN `#__js_vehiclemanager_users` AS user ON user.id = veh.uid
                        LEFT JOIN `#__js_vehiclemanager_modelyears` AS mdy ON mdy.id = veh.modelyearid
                        WHERE veh.id = ".$id;
                    $db->setQuery($query);
                    $data = $db->loadObject();
                    if(!empty($data)){
                        $data->location = JSVEHICLEMANAGERincluder::getJSModel('city')->getLocationDataForView($data->loccity);
                    }
                    $data->credtitsforaddvehicle = $credtitsforaddvehicle;
                    return $data;
                }
                break;
            case 'users':
                $query = 'SELECT u.name AS username, u.email AS useremail
                            FROM `#__js_vehiclemanager_users` AS u
                            WHERE u.id = ' . $id;
                break;
        }
        if ($query != null) {
            $db = new jsvehiclemanagerdb();
            $db->setQuery($query);
            $record = $db->loadObject();
            return $record;
        }
        return false;
    }

    function getMessagekey(){
        $key = 'emailtemplate';if(is_admin()){$key = 'admin_'.$key;}return $key;
    }
}

?>
