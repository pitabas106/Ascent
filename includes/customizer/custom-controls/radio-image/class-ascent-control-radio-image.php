<?php
/**
 * Customizer Control: radio-image.
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 3.4.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Radio Image control (modified radio).
 */
class Ascent_Control_Radio_Image extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ascent-radio-image';

	
	public function render_content() {

		if (empty($this->choices))
			return;

		$name = $this->id;
		?>
		<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		<ul class="controls" id='theme-slug-img-container'>
			<?php
				foreach ($this->choices as $value => $label) :

					$class = ($this->value() == $value) ? 'theme-slug-radio-img-selected theme-slug-radio-img-img' : 'theme-slug-radio-img-img';
					?>

					<li style="display: inline;">
						<label>
							<input <?php $this->link(); ?> style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php $this->link(); checked($this->value(), $value); ?> />
							<img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
						</label>
					</li>

					<?php
				endforeach;
			?>
		</ul>
		<?php
	}
	
}
