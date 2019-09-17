<?php
/**
 * Ascent - Jetpack Compatibility File.
 *
 * @link 		https://jetpack.me/
 *
 * @package 	Ascent
 * @since       Ascent 3.4.0
 */


// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


// If plugin - 'Jetpack' not exist then return.
if ( ! class_exists( 'Jetpack' ) ) {
	return;
}

/**
 * Ascent Jetpack Compatibility
 */
if ( ! class_exists( 'Ascent_Jetpack' ) ) :

	/**
	 * Ascent Jetpack Compatibility
	 *
	 * @since 1.0.0
	 */
	class Ascent_Jetpack {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'jetpack_setup' ) );
		}

		/**
		 * Add theme support for Infinite Scroll.
		 * See: https://jetpack.me/support/infinite-scroll/
		 */
		function jetpack_setup() {
			add_theme_support(
				'infinite-scroll',
				array(
					'container' => 'content',
					'footer'    => 'page',
				)
			);
		} 
	}

endif;

/**
 * Calling class using 'get_instance()' method
 */
Ascent_Jetpack::get_instance();
