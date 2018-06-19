<?php if (!defined('ABSPATH')) die('Restricted Access');?>
<div id="jsvehiclemanageradmin-wrapper">
    <div id="jsvehiclemanageradmin-leftmenu">
        <?php JSVEHICLEMANAGERincluder::getClassesInclude('jsvehiclemanageradminsidemenu'); ?>
    </div>
   <div id="jsvehiclemanageradmin-data"> 
        <span class="jsvm_js-admin-title">
            <span class="jsvm_heading">  
                <a href="<?php echo admin_url('admin.php?page=jsvehiclemanager'); ?>"><img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/back-icon.png" /></a>
                <span class="jsvm_text-heading"><?php echo __('Pro Feature Page', 'js-vehicle-manager'); ?></span>    
            </span>
            <?php JSVEHICLEMANAGERincluder::getClassesInclude('jsvehiclemanageradminsidemenu'); ?>
        </span>
        <div class="jsvehiclemanager-pro-feature-wrp">
            <div class="jsvehiclemanager-pro-feature-banner">
                <div class="jsvehiclemanager-pro-feature-banner-left">
                    <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/main.png" alt="main" title="main" />
                </div>
                <div class="jsvehiclemanager-pro-feature-banner-right">
                    <div class="jsvehiclemanager-pro-feature-banner-data">
                        <div class="jsvehiclemanager-pro-feature-title">js vehicle manager</div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            <span class="jsvehiclemanager-pro-feature-desc-txt">
                                Features available in pro version only
                            </span>
                            <span class="jsvehiclemanager-pro-feature-desc-btn">
                                <a href="#" class="jsvehiclemanager-pro-feature-desc-btn-anchor" title="buy now">
                                    Buy Now
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jsvehiclemanager-pro-feature-bottom">
                <div class="jsvehiclemanager-pro-feature-tit">
                    Js Vehicle Manager Pro Features
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/visitor-add-vehilce.png" alt="visitor add vehicle" title="visitor add vehicle" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Visitor Add Vehicle
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager comes with unique feature, visitor can add vehicle in the system. JS Vehicle Manager sends visitor email containing vehicle detail link.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/featured.png" alt="featured vehicle" title="featured vehicle" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Featured Vehicle
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager offers interface to mark vehicles as featured vehicles using credits (admin controlled), featured vehicles appears on top of vehicle listing.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/socail-login.png" alt="socail login" title="socail login" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Social Login
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            If user hesitate to register, don’t worry about it, JS Vehicle Manager offers social login for these user.
                            JS Vehicle Manager offers social login of these popular social sites. Facebook, Linkedin and Xing.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/contact-seller.png" alt="contact seller" title="contact seller" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Buyer Contact Seller
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager allows users and visitors to contact the seller of vehicle using interface provided by JS Vehicle Manager.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/compare.png" alt="compare" title="compare" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Compare
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager offers interface for vehicle comparison. Users can choose up to three vehicles that they want to compare, and decide whats best for them. 
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/shortlist.png" alt="shortlist" title="shortlist" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Shortlisted Vehicles
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager provides interface for shortlisting a vehicle, users/visitors can shortlist a vehicle assign it a rating and a comments/note for himself. There is layout on which users/visitors can view their shortlisted vehicles. 
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/make-offer.png" alt="make offer" title="make offer" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Make An Offer
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                             JS Vehicle Manager provides interface to users/visitors to make an offer for a vehicle, owner will be notified by email with the details provided by user/visitor about the offer.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/test-drive.png" alt="test drive" title="test drive" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Schedule A Test Drive
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager provides interface to users/visitors to schedule a test drive of the vehicle they are interested in. Owner will be notified by email with the details provided by user/visitor.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/tell-friend.png" alt="tell friend" title="tell friend" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Tell A Friend
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager provides interface to users/visitors to send vehicle detail link of any vehicle to any email they want, they can specify up to three email addresses  which will receive the email.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/alert.png" alt="alert" title="alert" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Vehicle Alert
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager provides interface to users/visitors subscribe email alerts, user/visitor can specify a criteria and duration and they will receive emails containing vehicles that fulfill their provided criteria.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/credits.png" alt="credits" title="credits" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Credits System
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            Admin create package for users with cost and credits. admin can define cost for add vehicle and featured vehicle with expiries ,users can buy credit packs defined by admin using paypal or woocommrece.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/themes.png" alt="themes" title="themes" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Themes
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            Admin can customize the color layout for the JS Vehicle Manager. Admin can either select colors from a color pallet table with live preview of changes or select any of the predefined set.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/ads.png" alt="google adsense" title="google adsense" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Google Adsense
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            Admin can add Google ads in vehicle listing, admin has full control over the google ads using configurations. Google ads will generate revenue.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/share-vehicle.png" alt="share vehicle" title="share vehicle" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Vehicle Social Sharings
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager provides interface to users/visitors share vehicle detail link on social media. JS Vehicle Manager supports all the major social networking sites(admin controlled).
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/stats-report.png" alt="stats report" title="stats report" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Report And Stats For Admin
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            Reports are very essentials for admin to know what going on his system. JS Vehicle Manager provides very through and detailed reports and graphs for admin.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/payment-method.png" alt="payment method" title="payment method" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Payment Methods
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager supports PayPal express checkout and woo commerce. Admin can configure these payment methods to sell credits pack to users.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/sold.png" alt="sold" title="sold" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Mark As Sold
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager allows owner and admin to mark a vehicle as sold to avoid any confusions. Admin can control whether sold vehicles will be shown in listing or not.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/rss.png" alt="rss" title="rss" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Rss
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager supports Rss. User/visitor can get the latest vehicles in his favorable RSS reader. RSS feeds settings can managed by admin.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/print.png" alt="print" title="print" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Print
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager allows users/visitors to print any vehicle (print button visibility admin controlled). users can print vehicle to maintain a record of vehicles.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/export.png" alt="export" title="export" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            Export
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager allows admin to export vehicles data in csv format. admin can define a criteria for vehicle export. Admin can keep an offline record of vehicles.
                        </div>
                    </div>
                </div>
                <div class="jsvehiclemanager-pro-feature-box">
                    <div class="jsvehiclemanager-pro-feature-top">
                        <img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/pro-installation/pdf.jpg" alt="pdf" title="pdf" />
                    </div>
                    <div class="jsvehiclemanager-pro-feature-btm">
                        <div class="jsvehiclemanager-pro-feature-title">
                            PDF
                        </div>
                        <div class="jsvehiclemanager-pro-feature-desc">
                            JS Vehicle Manager allows users/visitors to export any vehicle as PDF (PDF button visibility admin controlled). users can export vehicle to maintain a record of vehicles.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>