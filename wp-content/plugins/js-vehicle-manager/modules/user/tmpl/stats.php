<?php 
if (!defined('ABSPATH'))
    die('Restricted Access');
$msgkey = JSVEHICLEMANAGERincluder::getJSModel('user')->getMessagekey();
JSVEHICLEMANAGERmessages::getLayoutMessage($msgkey);
JSVEHICLEMANAGERbreadcrumbs::getBreadcrumbs();
include_once(jsvehiclemanager::$_path . 'includes/header.php');
if (jsvehiclemanager::$_error_flag_message == null) { ?>

<div id="jsvehiclemanager-wrapper">
    <div class="control-pannel-header">
        <span class="heading">
            <?php echo __('My Stats', 'js-vehicle-manager'); ?>
        </span>            
    </div>
    <div id="jsvehiclemanager-mystats-content">
        <div class="jsvehiclemanager-topstats">
            <div class="jsvehiclemanager-mainwrp  jsvehiclemanager-total">
                
                <div class="jsvehiclemanager-img-wrap">
                    <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/total-rep.png">
                </div>

                <div class="jsvehiclemanager-headtext"><?php echo __('Total vehicles','js-vehicle-manager'); ?></div>
                <div class="jsvehiclemanager-count">(<?php echo jsvehiclemanager::$_data['totalvehicles']; ?>)</div>
            </div>
            <div class="jsvehiclemanager-mainwrp jsvehiclemanager-featured ">
                <div class="jsvehiclemanager-img-wrap">
                    <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/total-rep.png">
                </div>
                <div class="jsvehiclemanager-headtext"><?php echo __('Featured Vehicles','js-vehicle-manager'); ?></div>
                <div class="jsvehiclemanager-count">(<?php echo jsvehiclemanager::$_data['featuredvehicles']; ?>)</div>
            </div>
        </div>
        <table id="jsvehiclemanager-table" class="jsvehiclemanager-first-table">
            <thead class="stats">
                <tr>
                    <th class="title">&nbsp;</th>
                    <th class="total center"> <?php echo __('total','js-vehicle-manager');?> </th>
                    <th class="publish center"> <?php echo __('Publish','js-vehicle-manager');?> </th>
                    <th class="expired center"> <?php echo __('Expired','js-vehicle-manager');?> </th>
                </tr>
            </thead>
            <tbody class="stats">
                <tr>
                    <td class="title total-vehicles"><?php echo __('Vehicles','js-vehicle-manager');?></td>
                    <td class="total center responsive_feature"><?php echo jsvehiclemanager::$_data['totalvehicles']; ?></td>
                    <td class="publish center responsive_feature"><?php echo jsvehiclemanager::$_data['totalvehicles'] - jsvehiclemanager::$_data['expiredvehicles']; ?></td>
                    <td class="expired center responsive_feature"><?php echo jsvehiclemanager::$_data['expiredvehicles']; ?></td>
                </tr>
                <tr>
                    <td class="title total-feature"><?php echo __('Featured vehicles','js-vehicle-manager');?></td>
                    <td class="total center responsive_feature"><?php echo jsvehiclemanager::$_data['featuredvehicles']; ?></td>
                    <td class="publish center responsive_feature"><?php echo jsvehiclemanager::$_data['featuredvehicles'] - jsvehiclemanager::$_data['featuredexpiredvehicles']; ?></td>
                    <td class="expired center responsive_feature"><?php echo jsvehiclemanager::$_data['featuredexpiredvehicles']; ?></td>
                </tr>
            </tbody>
        </table>
    
    </div>
</div>
<?php
}else{
    echo jsvehiclemanager::$_error_flag_message;
}
?>