<?php
/**
 * Ascent Enqueue Scripts
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 3.8.5
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Scripts
 */
if ( ! class_exists( 'Ascent_Enqueue_Scripts' ) ) {

	/**
	 * Enqueue Scripts
	 */
	class Ascent_Enqueue_Scripts {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		
		/**
		 * Class Initiation
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}


		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'ascent_scripts' ), 1 );
		}

		/**
		 * Enqueue Scripts
		 */
		public function ascent_scripts() {

			/* JS/CSS Directory and Extension */

			$file_prefix  			= ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    			= ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  				= ASCENT_THEME_URI . 'assets/js/' . $dir_name . '/';
			$css_uri 				= ASCENT_THEME_URI . 'assets/css/' . $dir_name . '/';

			$enable_swipebox        = ascent_get_options( 'asc_enable_swipebox' );
		    $enable_sticky_header   = ascent_get_options( 'asc_enable_sticky_header' );
		    $body_font_family       = ascent_get_options( 'asc_body_font_family' );
		    $protocol               = is_ssl() ? 'https' : 'http';

		    if( $body_font_family ) {
		        $fonts_array = explode( '|||', $body_font_family );
		        wp_enqueue_style('ascent-google-font', $fonts_array[1]);
		    } else {
		        wp_enqueue_style('google-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800");
		    }

		    // load bootstrap css
		    wp_enqueue_style( 'bootstrap', ASCENT_THEME_URI . 'assets/resources/bootstrap/css/bootstrap'. $file_prefix .'.css' );

		    if( $enable_swipebox ) { //check if enable swipebox from theme options
		        wp_enqueue_style( 'swipebox', $css_uri . 'swipebox'. $file_prefix .'.css' );
		    }

		    wp_enqueue_style( 'owl-carousel', $css_uri . 'owl.carousel'. $file_prefix .'.css' );
		    wp_enqueue_style( 'owl-theme', $css_uri . 'owl.theme.default'. $file_prefix .'.css' );
		    wp_enqueue_style( 'ascent-animations', $css_uri . 'animations'. $file_prefix .'.css' );
		    wp_enqueue_style( 'meanmenu', $css_uri . 'meanmenu'. $file_prefix .'.css' );
		    wp_enqueue_style( 'bootstrap-wp', $css_uri . 'bootstrap-wp'. $file_prefix .'.css' );
			wp_enqueue_style( 'ascent-main', $css_uri . 'main'. $file_prefix .'.css' );

		    // load ascent styles
		    wp_enqueue_style( 'ascent-style', get_stylesheet_uri() );


		    // load bootstrap js
		    wp_enqueue_script( 'bootstrap', ASCENT_THEME_URI .'assets/resources/bootstrap/js/bootstrap'. $file_prefix .'.js', array( 'jquery' ) );

		    // load bootstrap wp js
		    wp_enqueue_script( 'ascent-bootstrapwp', $js_uri . 'bootstrap-wp'. $file_prefix .'.js', array( 'jquery' ) );

		    wp_enqueue_script( 'ascent-skip-link-focus-fix', $js_uri . 'skip-link-focus-fix'. $file_prefix .'.js', array(), ASCENT_THEME_VERSION, true );

		    // Load the html5 shiv.
		    wp_enqueue_script( 'html5', $js_uri . 'html5'. $file_prefix .'.js', array(), ASCENT_THEME_VERSION, true );
		    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );


		    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		    	wp_enqueue_script( 'comment-reply' );
		    }

		    if ( is_singular() && wp_attachment_is_image() ) {
		    wp_enqueue_script( 'ascent-keyboard-image-navigation', $js_uri . 'keyboard-image-navigation'. $file_prefix .'.js', array( 'jquery' ), ASCENT_THEME_VERSION );
		    }

		     //check if enable swipebox from theme options
		    if( $enable_swipebox ) {
			    wp_enqueue_script( 'swipebox', $js_uri . 'jquery.swipebox' . $file_prefix .'.js', array( 'jquery' ) );
			    wp_enqueue_script( 'ascent-swipebox-config', $js_uri . 'swipebox-config'. $file_prefix .'.js', array('jquery') );
		    }

		    wp_enqueue_script( 'owl-carousel', $js_uri . 'owl.carousel'. $file_prefix .'.js', array( 'jquery' ) );
		    wp_enqueue_script( 'appear', $js_uri . 'jquery.appear'. $file_prefix .'.js', array( 'jquery' ) );
		    wp_enqueue_script( 'meanmenu', $js_uri . 'jquery.meanmenu'. $file_prefix .'.js', array( 'jquery' ) );
		    wp_enqueue_script( 'velocity', $js_uri . 'jquery.velocity'. $file_prefix .'.js', array( 'jquery' ) );
		    wp_enqueue_script( 'ascent-appear-config', $js_uri . 'appear.config'. $file_prefix .'.js', array( 'jquery' ) );

		    // Theme main js
		    wp_enqueue_script( 'ascent-themejs', $js_uri . 'main'. $file_prefix .'.js', array( 'jquery' ) );

		    if( $enable_sticky_header ) {
		    	wp_enqueue_script( 'ascent-enable-sticky-header', $js_uri . 'enable-sticky-header'. $file_prefix .'.js', array( 'jquery' ) );
		    }
		
		}


	}

}

/**
 *  Class calling using this 'get_instance()' method
 */
Ascent_Enqueue_Scripts::get_instance();
