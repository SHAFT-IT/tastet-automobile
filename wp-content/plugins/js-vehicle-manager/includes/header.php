<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

global $config_array;
$config_array = JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigByFor('topmenu');


function jsvehiclemanagerchecktopmenuLink($name) {
    $print = false;
    $visname = 'vis_'.$name;
    $isguest = JSVEHICLEMANAGERincluder::getObjectClass('user')->isguest();

    global $config_array;

    if ($isguest == false) {
        if (isset($config_array[$name]) && $config_array[$name] == 1)
            $print = true;
    } else {
        if (isset($config_array["$visname"]) && $config_array["$visname"] == 1)
            $print = true;
    }
    return $print;
}


// $layout = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerlt');
// if ($layout == 'printresume' || $layout == 'pdf')
//     return false; // b/c we have print and pdf layouts
// $module = JSVEHICLEMANAGERrequest::getVar('jsvehiclemanagerme');
// if(
//     ($module == 'company' && $layout == 'addcompany') ||
//     ($module == 'company' && $layout == 'mycompanies') ||
//     ($module == 'credits' && $layout == 'employercredits') ||
//     ($module == 'creditslog' && $layout == 'employercreditslog') ||
//     ($module == 'credits' && $layout == 'ratelistemployer') ||
//     ($module == 'departments' && $layout == 'adddepartment') ||
//     ($module == 'departments' && $layout == 'mydepartments') ||
//     ($module == 'departments' && $layout == 'viewdepartment') ||
//     ($module == 'folder' && $layout == 'addfolder') ||
//     ($module == 'folder' && $layout == 'myfolders') ||
//     ($module == 'folder' && $layout == 'viewfolder') ||
//     ($module == 'folderresume' && $layout == 'folderresume') ||
//     ($module == 'job' && $layout == 'addjob') ||
//     ($module == 'job' && $layout == 'myjobs') ||
//     ($module == 'jobapply' && $layout == 'jobappliedresume') ||
//     ($module == 'employer' && $layout == 'controlpanel') ||
//     ($module == 'employer' && $layout == 'mystats') ||
//     ($module == 'message' && $layout == 'employermessages') ||
//     ($module == 'message' && $layout == 'jobmessages') ||
//     ($module == 'purchasehistory' && $layout == 'employerpurchasehistory') ||
//     ($module == 'resumesearch' && $layout == 'resumesearch') ||
//     ($module == 'resumesearch' && $layout == 'resumesavesearch') || 
//     ($module == 'resume' && $layout == 'resumebycategory') || 
//     ($module == 'resume' && $layout == 'resumes')
// ){
//     $menu = 'employer';
// }elseif(
//     ($module == 'company' && $layout == 'companies') ||
//     ($module == 'company' && $layout == 'viewcompany') ||
//     ($module == 'job' && $layout == 'newestjobs') ||
//     ($module == 'job' && $layout == 'jobs') ||
//     ($module == 'job' && $layout == 'shortlistedjobs') ||
//     ($module == 'job' && $layout == 'viewjob') ||
//     ($module == 'jsvehiclemanager' && $layout == 'login') ||
//     ($module == 'resume' && $layout == 'viewresume') ||
//     ($module == 'message' && $layout == 'sendmessage')
// ){
//     if(JSVEHICLEMANAGERincluder::getObjectClass('user')->isEmployer()){
//         $menu = 'employer';
//     }else{
//         $menu = 'jobseeker';
//     }
// }elseif(
//     ($module == 'coverletter' && $layout == 'addcoverletter') ||
//     ($module == 'coverletter' && $layout == 'mycoverletters') ||
//     ($module == 'coverletter' && $layout == 'viewcoverletter') ||
//     ($module == 'credits' && $layout == 'jobseekercredits') ||
//     ($module == 'credits' && $layout == 'ratelistjobseeker') ||
//     ($module == 'creditslog' && $layout == 'jobseekercreditslog') ||
//     ($module == 'job' && $layout == 'jobsbycategories') ||
//     ($module == 'job' && $layout == 'jobsbytypes') ||
//     ($module == 'job' && $layout == 'visitoraddjob') ||
//     ($module == 'jobalert' && $layout == 'jobalert') ||
//     ($module == 'jobapply' && $layout == 'myappliedjobs') ||
//     ($module == 'jobsearch' && $layout == 'jobsearch') ||
//     ($module == 'jobsearch' && $layout == 'jobsavesearch') ||
//     ($module == 'jobseeker' && $layout == 'controlpanel') ||
//     ($module == 'jobseeker' && $layout == 'mystats') ||
//     ($module == 'message' && $layout == 'jobseekermessages') ||
//     ($module == 'purchasehistory' && $layout == 'jobseekerpurchasehistory') ||
//     ($module == 'resume' && $layout == 'addresume') ||
//     ($module == 'resume' && $layout == 'myresumes') ||
//     ($module == 'user' && $layout == 'userregister')
// ){
//     $menu = 'jobseeker';
    
// }else{
//     $menu = 'jobseeker';
// }

$div = '';
//$config_array = JSVEHICLEMANAGERincluder::getJSModel('configuration')->getConfigByFor('topmenu');
// if ($menu == 'employer') {
//     if (is_user_logged_in()) { // Login user
//         if ($config_array['tmenu_emcontrolpanel'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'employer', 'jsvehiclemanagerlt'=>'controlpanel')),
//                 'title' => __('Control Panel', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_emnewjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'addjob')),
//                 'title' => __('Add','js-jobs') .' '. __('Job', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_emmyjobs'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'myjobs')),
//                 'title' => __('My Jobs', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_emmycompanies'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'company', 'jsvehiclemanagerlt'=>'mycompanies')),
//                 'title' => __('My Companies', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_emsearchresume'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'resumesearch', 'jsvehiclemanagerlt'=>'resumesearch')),
//                 'title' => __('Resume Search', 'js-jobs'),
//             );
//         }
//     } else { // user is visitor
//         if ($config_array['tmenu_vis_emcontrolpanel'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'employer', 'jsvehiclemanagerlt'=>'controlpanel')),
//                 'title' => __('Control Panel', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_emnewjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'addjob')),
//                 'title' => __('Add','js-jobs') .' '. __('Job', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_emmyjobs'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'myjobs')),
//                 'title' => __('My Jobs', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_emmycompanies'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'company', 'jsvehiclemanagerlt'=>'mycompanies')),
//                 'title' => __('My Companies', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_emsearchresume'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'resumesearch', 'jsvehiclemanagerlt'=>'resumesearch')),
//                 'title' => __('Search Resume', 'js-jobs'),
//             );
//         }
//     }
// } else {
//     if (is_user_logged_in()) {
//         if ($config_array['tmenu_jscontrolpanel'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'jobseeker', 'jsvehiclemanagerlt'=>'controlpanel')),
//                 'title' => __('Control Panel', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_jsjobcategory'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'jobsbycategories')),
//                 'title' => __('Jobs By Categories', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_jssearchjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'jobsearch', 'jsvehiclemanagerlt'=>'jobsearch')),
//                 'title' => __('Job Search', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_jsnewestjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'newestjobs')),
//                 'title' => __('Newest Jobs', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_jsmyresume'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'resume', 'jsvehiclemanagerlt'=>'myresumes')),
//                 'title' => __('My Resumes', 'js-jobs'),
//             );
//         }
//     } else { // user is visitor
//         if ($config_array['tmenu_vis_jscontrolpanel'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'jobseeker', 'jsvehiclemanagerlt'=>'controlpanel')),
//                 'title' => __('Control Panel', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_jsjobcategory'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'jobsbycategories')),
//                 'title' => __('Jobs By Categories', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_jssearchjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'jobsearch', 'jsvehiclemanagerlt'=>'jobsearch')),
//                 'title' => __('Job Search', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_jsnewestjob'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'job', 'jsvehiclemanagerlt'=>'newestjobs')),
//                 'title' => __('Newest Jobs', 'js-jobs'),
//             );
//         }
//         if ($config_array['tmenu_vis_jsmyresume'] == 1) {
//             $linkarray[] = array(
//                 'link' => jsvehiclemanager::makeUrl(array('jsvehiclemanagerme'=>'resume', 'jsvehiclemanagerlt'=>'myresumes')),
//                 'title' => __('My Resume', 'js-jobs'),
//             );
//         }
//     }
// }


    $linkarray[] = array(
        'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'user', 'jsvmlt'=>'dashboard')),
        'title' => __('Control Panel', 'js-vehicle-manager'),
    );
    if( jsvehiclemanagerchecktopmenuLink('topmenu_addVehicle') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'vehicle', 'jsvmlt'=>'formvehicle')),
            'title' => __('Add Vehicle', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_myvehicles') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'vehicle', 'jsvmlt'=>'myvehicles')),
            'title' => __('My Vehicles', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_vehiclelist') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'vehicle', 'jsvmlt'=>'vehicles')),
            'title' => __('Vehicles', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_shortlistvehicles') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'vehicle', 'jsvmlt'=>'shortlistvehicles')),
            'title' => __('Shortlist Vehicles', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_searchvehicles') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'vehicle', 'jsvmlt'=>'vehiclesearch')),
            'title' => __('Search Vehicle', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_vehiclebycity') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'city', 'jsvmlt'=>'vehiclesbycity')),
            'title' => __('Vehicle By Cities', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_vehiclebymake') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'make', 'jsvmlt'=>'vehiclesbymake')),
            'title' => __('Vehicles By Make', 'js-vehicle-manager'),
        );
    }
    if( jsvehiclemanagerchecktopmenuLink('topmenu_sellerlist') == true ){
        $linkarray[] = array(
            'link' => jsvehiclemanager::makeUrl(array('jsvmme'=>'user', 'jsvmlt'=>'sellerlist')),
            'title' => __('Sellers List', 'js-vehicle-manager'),
        );
    }


if (isset($linkarray)) {
    $div .= '<div id="jsvehiclemanager-header-main-wrapper">';
    foreach ($linkarray AS $link) {
        $div .= '<a class="headerlinks" href="' . $link['link'] . '">' . $link['title'] . '</a>';
    }
    $div .= '</div>';
}
echo $div;
?>
