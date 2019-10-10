<?php
/**
 * Ascent functions and definitions
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 1.0.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 * Define Constants
 */
define( 'ASCENT_THEME_VERSION', '3.8.5' );
define( 'ASCENT_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASCENT_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'ASCENT_PRO_URL', 'https://zetamatic.com/downloads/ascent-pro/' );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 750; /* pixels */


/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

function ascent_customize_style() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
          jQuery('.controls#theme-slug-img-container li img').click(function () {
                jQuery('.controls#theme-slug-img-container li').each(function () {
                    jQuery(this).find('img').removeClass('theme-slug-radio-img-selected');
                });
                jQuery(this).addClass('theme-slug-radio-img-selected');
            });
        });
    </script>

    <style type="text/css">
        .controls#theme-slug-img-container li img {
            border: 2px solid transparent;
        }
        #theme-slug-img-container .theme-slug-radio-img-selected {
            border-radius: 2px;
            border: 2px solid #FFF;
            box-shadow: 0px 0px 5px #4c4c4c;
        }
    </style>
    <?php
}
add_action( 'customize_controls_print_footer_scripts', 'ascent_customize_style' );


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

    /*
    * Enable support for custom logo.
    */
    add_theme_support( 'custom-logo', array(
        'height'      => 200,
        'width'       => 120,
        'flex-height' => true,
    ) );

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


    /* Set header image */
    $default_banner_image = ascent_get_options( 'asc_default_banner_image' );
    $default_banner_image = ( $default_banner_image ) ? $default_banner_image : ASCENT_THEME_URI .'includes/images/banner.jpg';

    //Enable support for custom header.
    $defaults = array(
        'width'          => 1920,
        'height'         => 300,
        'flex-height'    => false,
        'flex-width'     => false,
        'default-image'  => $default_banner_image
    );
    add_theme_support( 'custom-header', $defaults );


    /* Add Menu Support */
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu', 'ascent' )
        )
    );
    /* Add Post Thumbnails Support and Related Image Sizes */

    add_image_size( 'blog-page', 732, 9999, false );                  // For Blog Page
    add_image_size( 'default-page', 1140, 9999, false );              // Default Page and Full Width Page
    add_image_size( 'blog-post-thumb', 732, 447, true );              // For Home Blog Section and Gallery Slider on Single and Blog Page

    /**
    * Make theme available for translation
    * Translations can be filed in the /languages/ directory
    * If you're building a theme based on ascent, use a find and replace
    * to change 'ascent' to the name of your theme in all the template files
    */
    load_theme_textdomain( 'ascent', ASCENT_THEME_DIR . 'languages' );

    /**
    * This function allow to import all old options to customizer options
    */
    ascent_import_old_theme_options_to_customizer();

    /* Redirect to Info page */
    global $pagenow;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect( add_query_arg( array(
            'page'    => 'ascent-details',
            'updated' => 'true'
        ), admin_url( 'themes.php' ) ) );
        exit ();
    }
 
}
endif; // ascent_setup
add_action( 'after_setup_theme', 'ascent_setup' );


 /** 
 * Import old theme options to customizer settings.
 * Delete the old theme options once imported.
 * Added a "imported" flag to database.
 */
if( !function_exists( 'ascent_import_old_theme_options_to_customizer' ) ) {
  function ascent_import_old_theme_options_to_customizer() {
    
    if( ! get_option( 'ascent_imported_old_options' ) ) {
        
        $option_name = get_option( 'stylesheet' );
        $option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
        $old_options = get_option( $option_name );

        if( ! empty($old_options ) && isset( $old_options ) ) {
            $theme_mods_ascent = get_option( 'theme_mods_ascent' );
            $theme_mods_ascent = $theme_mods_ascent['ascent_theme_options'];

            foreach( $old_options as $name => $value ) {
                $theme_mods_ascent['asc_'.$name] = $value;
            }

            if($theme_mods_ascent) {
                set_theme_mod( 'ascent_theme_options', $theme_mods_ascent );  
            }
            update_option( 'ascent_imported_old_options', '1', 'yes' );
            delete_option( 'ascent');
        }
    } 
  }
}


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
 * Ascent theme options
 *
 */
function ascent_get_options( $id, $default = false ) {
    // assigning theme name
    $themename              = get_option( 'stylesheet' );
    $themename              = preg_replace( "/\W/", "_", strtolower( $themename ) );
    $themename_option_slug  = 'ascent_theme_options';

    // getting options value
    $ascent_options = get_theme_mod( $themename_option_slug );
    if ( isset( $ascent_options[ $id ] ) ) {
        return $ascent_options[ $id ];
    } else {
        return $default;
    }
}


/**
 * Enqueue scrits.
 */
require ASCENT_THEME_DIR . 'includes/core/class-ascent-enqueue-scripts.php';

/**
 * Custom template tags for this theme.
 */
require ASCENT_THEME_DIR . 'includes/template-tags.php';
require_once ASCENT_THEME_DIR . 'includes/core/theme-hooks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require ASCENT_THEME_DIR . 'includes/extras.php';


/**
 * Customizer additions.
 */
require_once ASCENT_THEME_DIR . 'includes/customizer/class-ascent-customizer.php';


/**
 * Load info.
 */
if ( is_admin() ) {
  require ASCENT_THEME_DIR.'includes/info/class.info.php';
  require ASCENT_THEME_DIR.'includes/info/info.php';
}

/**
 * Dynamic CSS.
 */
require_once ASCENT_THEME_DIR . 'assets/css/theme-color-scheme/dynamic-css.php';


/**
 * Jetpack Compatibility
 */
require_once ASCENT_THEME_DIR . 'includes/compatibility/class-ascent-jetpack.php';


/* Theme Social media icons  */
if( ! function_exists( 'ascent_socialmedia_navs' ) ){
    function ascent_socialmedia_navs() {
        return array(
            'asc_twitter_url'           => 'fab fa-twitter',
            'asc_facebook_url'          => 'fab fa-facebook',
            'asc_google_plus_url'       => 'fab fa-google-plus',
            'asc_linkedin_url'          => 'fab fa-linkedin',
            'asc_instagram_url'         => 'fab fa-instagram',
            'asc_youtube_url'           => 'fab fa-youtube',
            'asc_skype_url'             => 'fab fa-skype',
            'asc_dribbble_url'          => 'fab fa-dribbble',
            'asc_digg_url'              => 'fab fa-digg',
            'asc_github_url'            => 'fab fa-github',
            'asc_delicious_url'         => 'fab fa-delicious',
            'asc_reddit_url'            => 'fab fa-reddit',
            'asc_pinterest_url'         => 'fab fa-pinterest',
            'asc_flickr_url'            => 'fab fa-flickr',
            'asc_rss_url'               => 'fas fa-rss-square',
            'asc_whatsapp_number'       => 'fab fa-whatsapp-square'
        );
    }
}

/* Theme Home Slider options */
if( ! function_exists( 'ascent_home_slider' ) ){
    function ascent_home_slider() {
        return array(
            'item_1' => array(
                'image'         => 'asc_slider_image_1',
                'video'         => 'asc_slider_video_1',
                'description'   => 'asc_slider_description_1',
            ),
            'item_2' => array(
                'image'         => 'asc_slider_image_2',
                'video'         => 'asc_slider_video_2',
                'description'   => 'asc_slider_description_2',
            ),
            'item_3' => array(
                'image'         => 'asc_slider_image_3',
                'video'         => 'asc_slider_video_3',
                'description'   => 'asc_slider_description_3',
            ),
            'item_4' => array(
                'image'         => 'asc_slider_image_4',
                'video'         => 'asc_slider_video_4',
                'description'   => 'asc_slider_description_4',
            ),
            'item_5' => array(
                'image'         => 'asc_slider_image_5',
                'video'         => 'asc_slider_video_5',
                'description'   => 'asc_slider_description_5',
            ),
        );
    }
}


/* Generate YouTube embed url */
if( ! function_exists( 'ascent_generate_youtube_embed_url' ) ) {
    function ascent_generate_youtube_embed_url( $url ) {

        $shortUrlRegex  = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex   = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        return '//www.youtube.com/embed/'.$youtube_id;
    }
}


/* Generate Vimeo embed url */
if( !function_exists( 'ascent_generate_vimeo_embed_url' ) ) {
    function ascent_generate_vimeo_embed_url( $url ) {
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


/* Check video type */
if( !function_exists( 'ascent_check_video_type' ) ) {

    function ascent_check_video_type( $url ) {
        if ( strpos( $url, 'youtube' ) > 0 ) {
            return 'youtube';
        } elseif ( strpos( $url, 'vimeo') > 0 ) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
}


/*
* The CSS file selected in the options panel 'stylesheet' option
* is loaded on the theme front end
*/
if( !function_exists( 'ascent_options_stylesheets_alt_style' ) ) {
    function ascent_options_stylesheets_alt_style() {
        $theme_color_scheme = ascent_get_options( 'asc_theme_color_scheme' );
        if ( $theme_color_scheme && $theme_color_scheme !== 'default' ) {
            $select_color_scheme = ascent_get_options( 'asc_theme_color_scheme' );
            $color_scheme_css_path = ASCENT_THEME_URI . 'assets/css/theme-color-scheme/'.$select_color_scheme.'.css';
            wp_enqueue_style( $select_color_scheme, $color_scheme_css_path, array(), null );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'ascent_options_stylesheets_alt_style' );


if ( ! function_exists( 'ascent_get_pro_url' ) ) :
    /**
    * Returns an URL with utm tags
    * the admin settings page.
    *
    * @param string $url    URL fo the site.
    * @param string $source utm source.
    * @param string $medium utm medium.
    * @param string $campaign utm campaign.
    * @return mixed
    */
    function ascent_get_pro_url( $url, $source = '', $medium = '', $campaign = '' ) {

        $url = trailingslashit( $url );

        // Set up our URL if we have a source.
        if ( isset( $source ) ) {
            $url = add_query_arg( 'utm_source', sanitize_text_field( $source ), $url );
        }
        // Set up our URL if we have a medium.
        if ( isset( $medium ) ) {
            $url = add_query_arg( 'utm_medium', sanitize_text_field( $medium ), $url );
        }
        // Set up our URL if we have a campaign.
        if ( isset( $campaign ) ) {
            $url = add_query_arg( 'utm_campaign', sanitize_text_field( $campaign ), $url );
        }

        return esc_url( $url );
    }

endif;

