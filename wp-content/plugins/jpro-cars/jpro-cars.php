<?php
/*
Plugin Name: JPro Cars
Plugin URI: http://www.theme-vision.com/jprocars/
Description: Extends Wordpress with car classifieds & car dealer features.
Version: 1.4.1
Author: Jaroslav Svetlik
Author URI: http://www.theme-vision.com

    Copyright: © 2015 Jaroslav Svetlik.
    License: GNU General Public License v3.0
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
	Last Update: 06-Feb-2017
*/

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'TV_Cars' ) ) {
	class TV_Cars {
		
		/**
		 * Refers to a single instance of this class.
		 * 
		 * @rewritten
		 * @since 0.9
		 */
		private static $instance = null;
		
		/**
		 * Plugin Version
		 *
		 * @rewritten
		 * @since 0.7
		 */
		static private $version = '1.4.1';
		
		/**
		 * Class Constructor
		 *
		 * @rewritten
		 * @since 0.7
		 */
		function __construct() {
			
			add_action( 'plugins_loaded', array( $this, 'localization' ) );
			
			$this->init();
			
		}
		
		/**
		 * Creates or returns an instance of this class.
		 *
		 * @rewritten
		 * @since 0.9
		 */
		public static function get_instance() {
			
			if( null == self::$instance ) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		/**
		 * Plugin Localization
		 *
		 * @rewritten
		 * @since 0.7
		 */
		function localization() {
			$path = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
			load_plugin_textdomain( 'jprocars', false, $path );
		}
		
		/**
		 * Plugin Initialization
		 *
		 * @rewritten
		 * @since 0.7
		 */
		public function init() {
			
			$this->defines();
			$this->includes();
			$this->shortcodes();
			
		}
		
		/**
		 * Plugin Defines
		 *
		 * @rewritten
		 * @since 0.7
		 */
		private function defines() {
			if( ! defined( 'JPRO_CAR_URI' ) )
				   define( 'JPRO_CAR_URI', plugin_dir_url( __FILE__ ) );
			
			if( ! defined( 'JPRO_CAR_DIR' ) ) 
				   define( 'JPRO_CAR_DIR', plugin_dir_path( __FILE__ ) );
			  
			if( ! defined( 'JPRO_TEMPLATES_DIR' ) ) 
				   define( 'JPRO_TEMPLATES_DIR', JPRO_CAR_DIR . 'templates/' );
		}
		
		/**
		 * Include Necessary Files
		 *
		 * @rewritten
		 * @since 0.7
		 */
		private function includes() {
			$files = array(
				JPRO_CAR_DIR . 'classes/class-jprocustom.php',
				JPRO_CAR_DIR . 'includes/backend/post_taxonomy_type.php',
				JPRO_CAR_DIR . 'install.php',
				JPRO_CAR_DIR . 'classes/class.jp-tinymce.php',
				JPRO_CAR_DIR . 'classes/class.jp-themes-compatibility.php',
				JPRO_CAR_DIR . 'classes/class.jp-settings.php',
				JPRO_CAR_DIR . 'classes/class.jp-country.php',
				JPRO_CAR_DIR . 'classes/class.jp-cars.php',
				JPRO_CAR_DIR . 'includes/global/media_uploader.php',
				JPRO_CAR_DIR . 'includes/functions_global.php',
				JPRO_CAR_DIR . 'includes/functions_backend.php',
				JPRO_CAR_DIR . 'includes/functions_frontend.php',
				JPRO_CAR_DIR . 'includes/widgets/widget_my-profile.php',
				JPRO_CAR_DIR . 'templates/single-car-classifieds.php'
			);
			if( $files ) {
				foreach( $files as $file ) {
					require_once $file;
				}
			}
		}
		
		/**
		 * Load Shortcodes
		 *
		 * @rewritten
		 * @since 0.7
		 */
		private function shortcodes() {
			$files = glob( JPRO_CAR_DIR . 'shortcodes/*.php' );
			foreach( $files as $file ) {
				require_once $file;
			}
		}
		
		/**
		 * Get Plugin Version
		 *
		 * @rewritten
		 * @since 0.9
		 */
		public static function version() {
			return self::$version;
		}
	}
	TV_Cars::get_instance();
}