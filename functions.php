<?php
/**
 * ascent functions and definitions
 *
 * @package ascent
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 750; /* pixels */


/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options-framework/' );
require_once dirname( __FILE__ ) . '/options-framework/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            var $slider_videos = jQuery('#section-slider_video_1, #section-slider_video_2, #section-slider_video_3, #section-slider_video_4, #section-slider_video_5');

            var $slider_images = jQuery('#section-slider_image_1, #section-slider_image_2, #section-slider_image_3, #section-slider_image_4, #section-slider_image_5');

            $slider_videos.hide();
            $slider_images.hide();

            var slider_type_obj = {
                '#section-home_page_slider_type_1' : '1',
                '#section-home_page_slider_type_2' : '2',
                '#section-home_page_slider_type_3' : '3',
                '#section-home_page_slider_type_4' : '4',
                '#section-home_page_slider_type_5' : '5'
            }
            jQuery.each(slider_type_obj, function( obj_key, obj_value) {
                jQuery('body').on('click', obj_key+' .of-radio-img-img', function() {
                    if(jQuery(this).hasClass('of-radio-img-selected')) {
                        if(jQuery(this).prev().prev('input[type="radio"]').val() == 'image_type') {
                          jQuery('#section-slider_image_'+obj_value).fadeToggle(400);
                          jQuery('#section-slider_video_'+obj_value).hide();
                        } else {
                          jQuery('#section-slider_video_'+obj_value).show();
                          jQuery('#section-slider_image_'+obj_value).hide();
                        }
                    }
                });

                if (jQuery('#home_page_slider_type_'+obj_value+'_video_type:checked').val() == 'video_type') {
                    jQuery('#section-slider_video_'+obj_value).show();
                    jQuery('#section-slider_image_'+obj_value).hide();
                } else {
                    jQuery('#section-slider_video_'+obj_value).hide();
                    jQuery('#section-slider_image_'+obj_value).show();
                }
            });
        });
    </script>
<?php
}


if ( ! function_exists( 'ascent_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ascent_setup() {
    global $cap, $content_width;

    /**
     * Add default posts and comments RSS feed links to head
    */
    add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails on posts and pages
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );

    // Supporting title tag via add_theme_support (since WordPress 4.1)
  	add_theme_support( 'title-tag' );

    /**
     * Enable support for Post Formats
    */
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

    /**
     * Setup the WordPress core custom background feature.
    */
    add_theme_support( 'custom-background', apply_filters( 'ascent_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

 /* Add Menu Support */
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'ascent')
        )
    );
    /* Add Post Thumbnails Support and Related Image Sizes */

    add_image_size('blog-page', 732, 9999, false);                  // For Blog Page
    add_image_size('default-page', 1140, 9999, false);              // Default Page and Full Width Page
    add_image_size('blog-post-thumb', 732, 447, true);              // For Home Blog Section and Gallery Slider on Single and Blog Page

  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   * If you're building a theme based on ascent, use a find and replace
   * to change 'ascent' to the name of your theme in all the template files
  */
  load_theme_textdomain( 'ascent', get_template_directory() . '/languages' );

}
endif; // ascent_setup
add_action( 'after_setup_theme', 'ascent_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 */
function ascent_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'ascent' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Sidebar Footer', 'ascent' ),
        'id'            => 'sidebar-footer',
        'before_widget' => '<aside id="%1$s" class="widget %2$s col-3">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

}
add_action( 'widgets_init', 'ascent_widgets_init' );


/**
 * Enqueue scripts and styles
 *
 */
function ascent_scripts() {
    $protocol = is_ssl() ? 'https' : 'http';
    if(of_get_option('body_font_family')) {
      $fonts_array = explode('|||', of_get_option('body_font_family'));
      wp_enqueue_style('ascent-google-font', $fonts_array[1]);
    } else {
      wp_enqueue_style('google-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800");
    }
    // load bootstrap css
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

    if(of_get_option('enable_swipebox')) { //check if enable swipebox from theme options
        wp_enqueue_style( 'swipebox', get_template_directory_uri() . '/includes/css/swipebox.min.css' );
    }
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/includes/css/owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/includes/css/owl.theme.default.min.css' );
    wp_enqueue_style( 'ascent-animations', get_template_directory_uri() . '/includes/css/animations.css' );
    wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/includes/css/meanmenu.min.css' );
    wp_enqueue_style( 'ascent-main', get_template_directory_uri() . '/includes/css/main.css' );

    // load bootstrap js
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

    // load bootstrap wp js
    wp_enqueue_script( 'ascent-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

    wp_enqueue_script( 'ascent-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'ascent-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

    wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/includes/js/smoothscroll.js', array('jquery') );

    if(of_get_option('enable_swipebox')) { //check if enable swipebox from theme options
        wp_enqueue_script( 'swipebox', get_template_directory_uri() . '/includes/js/jquery.swipebox.min.js', array('jquery') );
        wp_enqueue_script( 'ascent-swipebox-config', get_template_directory_uri() . '/includes/js/swipebox-config.js', array('jquery') );
    }

    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/includes/js/owl.carousel.min.js', array('jquery') );
    wp_enqueue_script( 'appear', get_template_directory_uri() . '/includes/js/jquery.appear.js', array('jquery') );
    wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/includes/js/jquery.meanmenu.min.js', array('jquery') );
    wp_enqueue_script( 'velocity', get_template_directory_uri() . '/includes/js/jquery.velocity.js', array('jquery') );
    wp_enqueue_script( 'ascent-appear-config', get_template_directory_uri() . '/includes/js/appear.config.js', array('jquery') );

    // Theme main js
    wp_enqueue_script( 'ascent-themejs', get_template_directory_uri() . '/includes/js/main.js', array('jquery') );

    if(of_get_option('enable_sticky_header')) {
        wp_enqueue_script( 'ascent-enable-sticky-header', get_template_directory_uri() . '/includes/js/enable-sticky-header.js', array('jquery') );
    }

}

add_action( 'wp_enqueue_scripts', 'ascent_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Dynamic CSS.
 */
require_once get_template_directory() . '/includes/css/theme-color-scheme/dynamic-css.php';



/* Theme Social media icons  */
if( !function_exists( 'ascent_socialmedia_navs' ) ){
    function ascent_socialmedia_navs() {
        return array(
            'twitter_url' => 'fa fa-twitter',
            'facebook_url' => 'fa fa-facebook',
            'google_plus_url' => 'fa fa-google-plus',
            'linkedin_url' => 'fa fa-linkedin',
            'instagram_url' => 'fa fa-instagram',
            'youtube_url' => 'fa fa-youtube',
            'skype_url' => 'fa fa-skype',
            'dribbble_url' => 'fa fa-dribbble',
            'digg_url' => 'fa fa-digg',
            'github_url' => 'fa fa-github',
            'delicious_url' => 'fa fa-delicious',
            'reddit_url' => 'fa fa-reddit',
            'pinterest_url' => 'fa fa-pinterest',
            'flickr_url' => 'fa fa-flickr',
            'rss_url' => 'fa fa-rss'
        );
    }
}

/* Theme Home Slider  */
if( !function_exists( 'ascent_home_slider' ) ){
    function ascent_home_slider() {
        return array(
            'item_1' => array(
                'image' => 'slider_image_1',
                'video' => 'slider_video_1',
                'description' => 'slider_description_1',
                'slider_type' => 'home_page_slider_type_1'
            ),
            'item_2' => array(
                'image' => 'slider_image_2',
                'video' => 'slider_video_2',
                'description' => 'slider_description_2',
                'slider_type' => 'home_page_slider_type_2'
            ),
            'item_3' => array(
                'image' => 'slider_image_3',
                'video' => 'slider_video_3',
                'description' => 'slider_description_3',
                'slider_type' => 'home_page_slider_type_3'
            ),
            'item_4' => array(
                'image' => 'slider_image_4',
                'video' => 'slider_video_4',
                'description' => 'slider_description_4',
                'slider_type' => 'home_page_slider_type_4'
            ),
            'item_5' => array(
                'image' => 'slider_image_5',
                'video' => 'slider_video_5',
                'description' => 'slider_description_5',
                'slider_type' => 'home_page_slider_type_5'
            ),
        );
    }
}

if( !function_exists( 'ascent_generate_youtube_embed_url' ) ) {
    function ascent_generate_youtube_embed_url($url) {
        preg_match(
    		'/[\\?\\&]v=([^\\?\\&]+)/',
    		$url,
    		$matches
    	);
        //the ID of the YouTube URL: x6qe_kVaBpg
        $id = $matches[1];
        return '//www.youtube.com/embed/'.$id;
    }
}

if( !function_exists( 'ascent_generate_vimeo_embed_url' ) ) {
    function ascent_generate_vimeo_embed_url($url) {
        preg_match(
    		'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
    		$url,
    		$matches
    	);

        //the ID of the Vimeo URL: 71673549
        $id = $matches[2];

        return 'http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff';
    }
}

if( !function_exists( 'ascent_check_video_type' ) ) {
    function ascent_check_video_type($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
}

if( !function_exists( 'ascent_theme_option_custom_style' ) ) {
    function ascent_theme_option_custom_style() {
?>
    <style type="text/css">
        <?php if(of_get_option('body_text_color')): ?>
            body {
                color: <?php echo of_get_option('body_text_color'); ?>;
            }
        <?php endif; ?>

        <?php if(of_get_option('body_link_color')): ?>
            body a {
                color: <?php echo of_get_option('body_link_color'); ?>;
            }
        <?php endif; ?>

        <?php if(of_get_option('footer_top_border_color')): ?>
            #colophon {
                border-color: <?php echo of_get_option('footer_top_border_color'); ?>;
            }
        <?php endif; ?>

        <?php if(of_get_option('footer_background_color')): ?>
            #colophon {
                background-color: <?php echo of_get_option('footer_background_color'); ?>;
            }
        <?php endif; ?>
        <?php if(of_get_option('footer_background_bottom_color')): ?>
            #footer-info {
                background-color: <?php echo of_get_option('footer_background_bottom_color'); ?>;
            }
        <?php endif; ?>
    </style>
<?php
    }
}
add_action( 'wp_head', 'ascent_theme_option_custom_style' );


/*
* The CSS file selected in the options panel 'stylesheet' option
* is loaded on the theme front end
*/
if( !function_exists( 'ascent_options_stylesheets_alt_style' ) ) {
    function ascent_options_stylesheets_alt_style()   {
       if ( of_get_option('theme_color_scheme') && of_get_option('theme_color_scheme') !== 'default' ) {
           $select_color_scheme = of_get_option('theme_color_scheme');
           $color_scheme_css_path = get_template_directory_uri() . '/includes/css/theme-color-scheme/'.$select_color_scheme.'.css';

           wp_enqueue_style( $select_color_scheme, $color_scheme_css_path, array(), null);
       }
    }
}
add_action( 'wp_enqueue_scripts', 'ascent_options_stylesheets_alt_style' );

if( !function_exists( 'ascent_string_encode' ) ) {
  function ascent_string_encode($string) {
    $chars_array = array(
    'A' => 'Z',  'B' => 'Y',  'C' => 'X',  'D' => 'W',  'E' => 'V',  'F' => 'U',  'G' => 'T',  'H' => 'S',  'I' => 'R',  'J' => 'Q',  'K' => 'P',  'L' => 'O',  'M' => 'N',  'N' => 'M',  'O' => 'L',  'P' => 'K',  'Q' => 'J',  'R' => 'I',  'S' => 'H',  'T' => 'G',  'U' => 'F',  'V' => 'E',  'W' => 'D',  'X' => 'C',  'Y' => 'B',  'Z' => 'A',  '0' => 'a',  '1' => 'b',  '2' => 'c',  '3' => 'd',  '4' => 'e',  '5' => 'f',  '6' => 'g',  '7' => 'h',  '8' => 'i',  '9' => 'j',  '.' => 'k',  '@' => 'l',  '~' => 'm',  '+' => 'n',  '%' => 'o',  '^' => 'p',  '!' => 'q',  '*' => 'r',  '(' => 's',  ')' => 't',  '[' => 'u',  ']' => 'v',  '{' => 'w',  '}' => 'x',  '<' => 'y',  '/' => 'z');

    $string = str_split(strtoupper($string));
    $encode_array = array();
    for($i = 0; $i < count($string); $i++) {
      $encode_array[] = isset($chars_array[$string[$i]]) ? $chars_array[$string[$i]] : $string[$i];
    }
    return implode('', $encode_array);
  }
}

if( !function_exists( 'ascent_admin_notice_theme_support' ) ) {
  function ascent_admin_notice_theme_support() {
    $admin_email = get_option('admin_email');
    $admin_email = ascent_string_encode($admin_email);
    $premium_support_url = 'https://ascenttheme.com/premium-support/BVRbpyPMy4Og4KwN/'.urlencode($admin_email);
  ?>
    <div class="notice notice-success is-dismissible">
      <p style="font-size: 15px;"><?php _e( 'Are you having any trouble regarding this theme? Do you want to do more with this theme? Then subscribe to the Ascent Premium Support button.', 'ascent' ); ?></p>
    	<p style="margin: 2px 0 10px 0;"><a href="<?php echo esc_url($premium_support_url); ?>" target="_blank" class="button button-primary"><?php _e( 'Ascent Premium Support', 'ascent' ); ?></a></p>
    </div>
    <?php
  }
}
add_action( 'admin_notices', 'ascent_admin_notice_theme_support' );
