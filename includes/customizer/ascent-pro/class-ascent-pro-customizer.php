<?php
/**
 * Ascent Pro Customizer Section
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 3.4.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Ascent_Pro_Customizer
 *
 * @since 3.4.0
 */
if ( ! class_exists( 'Ascent_Pro_Customizer' ) ) {

	/**
	 * Ascent_Pro_Customizer Initial setup
	 */
	class Ascent_Pro_Customizer extends WP_Customize_Section {

		/**
		 * The type of customize section.
		 *
		 * @since  3.4.0
		 * @access public
		 * @var    string
		 */
		public $type = 'pro';

		/**
	     * Custom button text to output.
	     *
	     * @since  1.0.0
	     * @access public
	     * @var    string
	     */
	    public $pro_text = '';

		/**
		 * Custom pro button URL.
		 *
		 * @since  3.4.0
		 * @access public
		 * @var    string
		 */
		public $pro_url = '';

		/**
		 * Add custom parameters to pass to the Javascript via JSON.
		 *
		 * @since  3.4.0
		 * @access public
		 * @return string
		 */
		public function json() {

			$json = parent::json();

	        $json['pro_text'] = $this->pro_text;
	        $json['pro_url'] = esc_url($this->pro_url);
	        return $json;
		}

		/**
	     * Render the section UI in a subclass.
	     *
	     * Sections are now rendered in JS by default, see WP_Customize_Section::print_template().
	     *
	     * @since 3.4.0
	     */
	    protected function render() {}

		/**
		 * An Underscore (JS) template for rendering this section.
		 * 
		 * Class variables for this section class are available in the `data` JS object;
		 * export custom variables by overriding WP_Customize_Section::json().
		 * 
		 * @since  3.4.0
		 * @access public
		 * @return void
		 * @see WP_Customize_Section::print_template()
		 */
		protected function render_template() {
			?>

			<li id="accordion-section-{{ data.id }}"
            class="accordion-section control-section control-section-{{ data.type }} cannot-expan ">

	            <h3 class="accordion-section-title">
	                <# if ( data.pro_text && data.pro_url ) { #>
	                <a href="{{ data.pro_url }}" class="wp-ui-text-highlight" target="_blank" rel="noopener">{{ data.pro_text
	                    }}</a>
	                <# } #>
	            </h3>
	            
	        </li>
			<?php
		}
	}

}
