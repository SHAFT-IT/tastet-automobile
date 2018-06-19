              </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div> <!-- END .main-outer-wrapper -->


<div class="footer-outer-wrapper">
            <?php if(st_get_setting("show_footer_widget",'y')=='y'): ?>
                <div class="footer-wrapper container">
                    <div class="row">
                    	<div class="three columns">
                        	<?php dynamic_sidebar('footer_1'); ?>
                        </div>
                        <div class="three columns">
                          	<?php dynamic_sidebar('footer_2'); ?>
                        </div>
                        <div class="three columns">
                            <?php dynamic_sidebar('footer_3'); ?>
                        </div>
                        <div class="three columns">
                         <?php dynamic_sidebar('footer_4'); ?>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                </div>
               <?php endif; ?> 
                
                <div class="copyright-outer-wrapper">
                    <div class="copyright-wrapper container">
                        <div class="row clearfix">
                            <div class="copyright-left left b20">
                                <?php if(st_get_setting("show_footer_nav",'y')=='y'): ?>
                            	<nav class="footer-nav">
                            		<?php
                                        $defaults = array(
                                            	'theme_location'  => 'Footer_Menu',
                                            	'container'       => false,
                                            	'menu_class'      => 'menu',
                                            	'echo'            => true
                                             );
                                        wp_nav_menu( $defaults );
                                        ?>
                            	</nav>
                                <?php endif; ?>
                            </div>
                            <?php if(st_get_setting("footer_copyright")!=''): ?>
                            <div class="copyright-right right b20 text-right">
                            	<?php //echo stripslashes(st_get_setting("footer_copyright"));  ?>
								© 2018. Tous droits réservés. Créé par SHAFT 
								<a class="VisioRankFooter" target="_blank" href="http://www.shaft-it.com/">
									<img class="aligncenter wp-image-44 size-full" src="http://www.tastet-automobiles.fr/wp-content/uploads/2018/06/logo-shaft-it-1-3-300x112.png" alt="49" width="150" height="34">
								</a>
								<p><a href="/mentions-legales/">Mentions légales</a></p>
                            </div>
                            <?php endif; ?>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

        </div> <!-- END .body-wrapper -->
    </div> <!-- END .body-outer-wrapper -->
    <?php wp_footer(); ?>
<script type="text/javascript" src="https://www.siouz.com/themes/siouz/js/widget.js"></script>


</body>
</html>