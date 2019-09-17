<?php
/**
 * Ascent Theme Customizer Controls.
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

$control_dir = ASCENT_THEME_DIR . 'includes/customizer/custom-controls';

require $control_dir . '/radio-image/class-ascent-control-radio-image.php';
