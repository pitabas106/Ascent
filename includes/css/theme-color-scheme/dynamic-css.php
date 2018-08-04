<?php
/*
* Generate dynamic css
*/
if( !function_exists( 'generate_dynamic_css' ) ){
    function generate_dynamic_css(){
        $theme_color_light = '';
        $theme_color_light_10 = '';
        $theme_color_dark = '';
        $theme_white = '';

        $theme_color = of_get_option('custom_theme_color');
        if(!empty($theme_color)) {
            $theme_color_light = ascent_adjust_color_brightness($theme_color, 190);
            $theme_color_light_10 = ascent_adjust_color_brightness($theme_color, 220);
            $theme_color_dark = ascent_adjust_color_brightness($theme_color, -60);
            $theme_white = '#FFF';
        }

        $dynamic_css = array(
            array(
                'elements'	=>	'::selection',
                'property'	=>	'background',
                'value'		=> 	$theme_color
            ),
            array(
                'elements'	=>	'::selection',
                'property'	=>	'color',
                'value'		=> 	$theme_white
            ),
            array(
                'elements'	=>	'::-moz-selection',
                'property'	=>	'background',
                'value'		=> 	$theme_color
            ),
            array(
                'elements'	=>	'::-moz-selection',
                'property'	=>	'color',
                'value'		=> 	$theme_white
            ),

            /* Link */
            array(
                'elements'	=>	'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, a, .header-top a:hover, .site-branding h1.site-title a, #colophon .widget_calendar table a:hover',
                'property'	=>	'color',
                'value'		=> 	$theme_color
            ),

            /* Background color style */
            array(
                'elements'	=>	'a#scroll-top, .read-more, .read-more.black:hover, .pager li > a:hover, .pager li > a:focus, #home-slider .slide-content .btn, table thead, a#scroll-top, .post-meta-info .entry-meta .comments_count, body input[type="submit"]:hover, body input[type="submit"]:focus, .mean-container .mean-bar, .mean-container .mean-bar .mean-nav ul li a.meanmenu-reveal, .mean-container .mean-bar .mean-nav ul li a.mean-expand:hover',
                'property'	=>	'background-color',
                'value'		=> 	$theme_color
            ),

            /* Background style */
            array(
                'elements'	=>	'nav.main-menu ul > li:hover > a, nav.main-menu ul > .current-menu-item > a, nav.main-menu ul .current_page_item > a, nav.main-menu ul > li:hover > a, nav.main-menu ul > .current-menu-item > a, .mean-container a.meanmenu-reveal, .comment a.btn, .error-404, .mean-container .mean-bar .meanmenu-reveal, #home-slider .owl-dots .owl-dot.active span, #home-slider .owl-dots .owl-dot:hover span ',
                'property'	=>	'background',
                'value'		=> 	$theme_color
            ),

            /* Border Color style */
            array(
                'elements'	=>	'.wp-caption, .header-top, nav.main-menu ul > li ul, .pager li > a:hover, .pager li > a:focus, #colophon, .entry-content blockquote, .post-meta-info .entry-meta, .comment a.btn, body input[type="text"]:focus, body input[type="email"]:focus, body input[type="url"]:focus, body input[type="tel"]:focus, body input[type="number"]:focus, body input[type="date"]:focus, body input[type="range"]:focus, body input[type="password"]:focus, body input[type="text"]:focus, body textarea:focus, body .form-control:focus, select:focus, table thead th ',
                'property'	=>	'border-color',
                'value'		=> 	$theme_color
            ),


            /* Light color style */
            array(
                'elements'	=>	'.nav > li > a:hover, .nav > li > a:focus, .post-meta-info .entry-meta, .comment-form .alert-info',
                'property'	=>	'background-color',
                'value'		=> 	$theme_color_light
            ),
            array(
                'elements'	=>	'.entry-content blockquote',
                'property'	=>	'background',
                'value'		=> 	$theme_color_light
            ),

            array(
                'elements'	=>	'.error-404 a',
                'property'	=>	'color',
                'value'		=> 	$theme_color_light
            ),
            array(
                'elements'	=>	'.comment-form .alert-info, table thead th',
                'property'	=>	'border-color',
                'value'		=> 	$theme_color_light
            ),
            array(
                'elements'	=>	'.comment-form .alert-info',
                'property'	=>	'border-color',
                'value'		=> 	$theme_color_light
            ),
            array(
                'elements'	=>	'.comment-form .alert-info',
                'property'	=>	'color',
                'value'		=> 	$theme_color_dark
            ),
        );

        $prop_count = count($dynamic_css);

        if($prop_count > 0){
            echo "<style type='text/css' id='dynamic-css'>\n\n";
            foreach($dynamic_css as $css_unit ){
                if(!empty($css_unit['value'])){
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }
            if(!empty($theme_color)) {
                echo "@media (max-width: 991px) and (min-width: 0px) {
                    .post-meta-info .entry-meta .comments_count,
                    .post-meta-info .entry-meta {
                        background: none;
                        border-color: transparent;
                        background-color: transparent;
                    }
                    .post-meta-info .entry-meta .comments_count a  {
                        background: none;
                    }
                }";
            }
            echo '</style>';
        }
    }
}
add_action('wp_head', 'generate_dynamic_css');


/*
* Adjust color brightness
* @params: color_code and brightness
*/
if( !function_exists( 'ascent_adjust_color_brightness' ) ){
    function ascent_adjust_color_brightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }
        return $return;
    }
}
