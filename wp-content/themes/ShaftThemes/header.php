<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta name="google-site-verification" content="sjooS_OqPk5aPKTGkUxDMhLGpB57UOu59bmDUuDiAEg" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Mobile Specific ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />

    <!-- Title Tag ======================================================== -->
    <title><?php st_title(); ?></title>

    <!-- Browser Specical Files =========================================== -->
    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]> <link rel='stylesheet' id=''  href='<?php echo ST_THEME_URL; ?>ie8.css' type='text/css' media='all' /><![endif]-->

    <!-- Site Favicon ===================================================== -->
    <?php echo st_favicon(); ?>
    <?php
     $defaults = array('theme_location'  => 'Primary_Navigation','container'=> false,'menu_class'=> 'menu','menu_id'=> '','echo' => false);
     if(class_exists('ST_Walker_Nav_Menu')){$defaults['walker'] =  new  ST_Walker_Nav_Menu();}
     $primary_nav =  wp_nav_menu( $defaults );
    ?>

    <!-- WP HEAD ========================================================== -->
    <?php wp_head(); ?>
</head>
<?php // <!-- Begin Body ======================================================= --> ?>
<body <?php body_class(); ?>>
    <div class="body-outer-wrapper">
        <div class="body-wrapper <?php echo st_boxed_full(); ?>">
            <div class="header-outer-wrapper b30">
                <div class="logo-outer-wrapper">
                    <div class="logo-wrapper container">
                        <div class="row">
                            <div class="twelve columns">
                                <?php
                                  global $st_options;
                                    $logo_padding_top = $st_options['logo_padding_top'];// st_get_setting('logo_padding_top');
                                    $logo_padding_bottom = $st_options['logo_padding_bottom']; //st_get_setting('logo_padding_bottom');

                                    $logo_padding_top =($logo_padding_top=='') ? 20 : intval($logo_padding_top);
                                    $logo_padding_bottom =($logo_padding_bottom=='') ? 20 : intval($logo_padding_bottom);


                                ?>
                                <div class="logo-left" style="padding:<?php echo $logo_padding_top; ?>px 0px <?php echo $logo_padding_bottom; ?>px 0px">
                                    <p>
                                      <a href="<?php echo home_url(); ?>">
                                      <?php if(st_get_setting("site_logo")): ?>
                                      <img src="<?php echo st_get_setting("site_logo"); ?>" alt="<?php _e('Logo','magazon'); ?>"></a>
                                      <?php else: ?>
                                       <?php bloginfo('name'); ?>
                                      <?php endif; ?>
                                      </a>
                                    </p>
                                </div>
                                <!--<div class="logo-right-widget right">
                                    <div class="logo-right-ads">
                                        <?php //dynamic_sidebar('header_ads'); ?>
                                    </div>
                                </div>-->
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div> <!-- END .logo-outer-wrapper -->

                <div class="primary-nav-outer-wrapper">
                    <div class="primary-nav-wrapper container">
                            <div class="twelve columns nav-wrapper">
                                <a href="#" id="primary-nav-mobile-a" class="primary-nav-close">

                                    <?php _e('<i class="fa fa-bars" aria-hidden="true"></i> Menu','magazon'); ?>
                                </a>
                                <nav id="primary-nav-mobile"></nav>

                                <nav id="primary-nav-id" class="primary-nav slideMenu">
                                    <?php
                                       echo  $primary_nav;
                                        ?>
                                    <div class="clear"></div>
                                </nav>

                            </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .primary-nav-outer-wrapper -->

		<div class="header-phone">
			<!--i class="fa fa-phone"></i> 06 07 53 80 29-->
      <?php echo do_shortcode("[do_widget id=text-8]"); ?> 
		</div>
		</div>
            </div> <!-- END .header-outer-wrapper-->





            <div class="main-outer-wrapper mt30"><div class="slider sliderhome"><?php
    echo do_shortcode("[metaslider id=23]");
?></div>
			    <div class="main-wrapper container">
			        <div class="row row-wrapper">
			            <div class="page-wrapper twelve columns b0">
			                <div class="row">
