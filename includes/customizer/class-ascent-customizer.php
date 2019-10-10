<?php
/**
 * Ascent Theme Customizer Class
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 3.4.0
 */

/**
 * Customizer Loader
 */
if ( ! class_exists( 'Ascent_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 3.4
	 */
	class Ascent_Customizer {

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
		 * Class Constructor
		 */
		public function __construct() {

			/**
			 * Customizer
			 */
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );

			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register_customizer_settings' ) );
				add_action( 'customize_register', array( $this, 'ascent_pro_upgrade_configurations' ), 2 );
			}

			add_action( 'customize_register', array( $this, 'customize_register_panel' ), 2 );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_register', array( $this, 'customizer_sanitize' ) );
		}



		
		/**
		 * Enque style and js.
		 *
		 * @since 3.4.0
		 * 
		 */
		function enqueue() {
		    wp_enqueue_script( 'ascent-customize-controls', ASCENT_THEME_URI . 'includes/customizer/assets/js/customizer-pro.js', array( 'customize-controls' ) );

		    wp_enqueue_style( 'ascent-customize-controls-style', ASCENT_THEME_URI . 'includes/customizer/assets/css/customizer-pro.css' );
		}


		/**
		 * Register custom section and panel.
		 *
		 * @since 3.4.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customize_register_panel( $wp_customize ) {
			require ASCENT_THEME_DIR . 'includes/customizer/customizer-controls.php';
		}
		
		/**
		 * Ascent custom sanitization.
		 *
		 * @since 3.4.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customizer_sanitize( $wp_customize ) {
			require ASCENT_THEME_DIR . 'includes/customizer/sanitize/customizer-sanitize.php';
		}

		/**
		 * Add upgrade link configurations controls.
		 *
		 * @since 3.4.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function ascent_pro_upgrade_configurations( $wp_customize ) {

			require ASCENT_THEME_DIR . 'includes/customizer/ascent-pro/class-ascent-pro-customizer.php';
		}


		/**
		 * Add postMessage support.
		 *
		 * @since 1.0.0
		 * @param $wp_customize Theme Customizer object.
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Override Settings
			 */
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title & Description Color', 'ascent' );
			$wp_customize->get_section( 'header_image' )->priority = 2;
			$wp_customize->get_section( 'title_tagline' )->priority = 3;
			$wp_customize->get_section( 'title_tagline' )->title = __( 'Header Settings', 'ascent' );
			$wp_customize->get_section( 'colors' )->priority = 4;
			$wp_customize->get_section( 'colors' )->title = __( 'Styling', 'ascent' );
			
		}


		/**
		 * Process and Register Customizer Panels, Sections, Settings and Controls.
		 *
		 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
		 * @since 3.4.0
		 * @return void
		 */
		public function register_customizer_settings( $wp_customize ) {

			
			$imagepath =  ASCENT_THEME_URI . 'includes/customizer/assets/images/';


		    $wp_customize->register_section_type( 'Ascent_Pro_Customizer' );

		    // Register sections for Ascent pro.
		    $wp_customize->add_section(
		        new Ascent_Pro_Customizer(
		            $wp_customize,
		            'ascent_pro',
		            array(
		                'pro_text'    => esc_html__( 'More Options Available in Pro!', 'ascent' ),
		                'pro_url'          => htmlspecialchars_decode( ascent_get_pro_url( ASCENT_PRO_URL, 'customizer', 'upgrade-link', 'upgrade-to-pro' ) ),
		                'priority'  => 1,
		            )
		        )
		    );

			/*  Header Settings
			============================================================================================*/

			$wp_customize->add_setting( 'ascent_theme_options[asc_phone_number]' , array(
				'default' => '000-000-0000',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_phone_number]', array(
			    'label' =>  __( 'Phone Number', 'ascent' ),
			    'priority' => 61,
				'section'	=> 'title_tagline',
				'type'	 => 'text',
				'description' => __( 'Provide the phone number.', 'ascent' ),
			) );
			$wp_customize->add_setting( 'ascent_theme_options[asc_email_id]' , array(
		    	'default' => 'support@wordpress.com',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_email',
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_email_id]', array(
			    'label' =>  __( 'Email ID', 'ascent' ),
			    'priority' => 62,
				'section'	=> 'title_tagline',
				'type'	 => 'text',
				'description' => __( 'Provide the email address.', 'ascent' ),
			) );

			
			/*  Other Settings
			============================================================================================*/
			$wp_customize->add_section( 'ascent_other_settings', array(
					'title' => __( 'Other Settings', 'ascent' ),
					'priority' => 6,
			));

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_swipebox]' , array(
					'default' => true,
					'transport'   => 'refresh',
					'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_swipebox]', array(
				'label' => __( 'Do you want to enable the Swipebox plugin?', 'ascent' ),
				'section' => 'ascent_other_settings',
				'settings' => 'ascent_theme_options[asc_enable_swipebox]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_sticky_header]' , array(
				'default' => true,
				'transport'   => 'refresh',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_sticky_header]', array(
				'label' => __( 'Do you want to enable the sticky header?', 'ascent' ),
				'section' => 'ascent_other_settings',
				'settings' => 'ascent_theme_options[asc_enable_sticky_header]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_scroll_to_top]' , array(
				'default' => true,
				'transport'   => 'refresh',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_scroll_to_top]', array(
				'label' => __( 'Do you want to enable scroll to top feature?', 'ascent' ),
				'section' => 'ascent_other_settings',
				'settings' => 'ascent_theme_options[asc_enable_scroll_to_top]',
				'type' => 'checkbox',
			) );

			/*  Colors
			* All these below fields are using WP default colors sections
			============================================================================================*/

			$protocol = is_ssl() ? 'https' : 'http';
			$google_raleway =  'Raleway|||'. $protocol. "://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i";
			$google_opensans = 'Open Sans|||'. $protocol. "://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800";
			$google_roboto = 'Roboto|||'. $protocol. "://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i";
			$google_ptsans = 'PT Sans|||'. $protocol. "://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i";

			$ascent_google_fonts = array(
				'' => __( 'Select Google Font', 'ascent' ),
				$google_opensans => __( 'Open Sans', 'ascent' ),
				$google_raleway => __( 'Raleway', 'ascent' ),
				$google_roboto => __( 'Roboto', 'ascent' ),
				$google_ptsans => __( 'PT Sans', 'ascent' ),
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_body_font_family]', array(
				'capability' => 'edit_theme_options',
				'type'       => 'theme_mod',
				'sanitize_callback' => 'ascent_sanitize_select',
			) );

			$wp_customize->add_control( 'ascent_theme_options[asc_body_font_family]', array(
			  'type' => 'select',
			  'section' => 'colors',
			  'label' => __( 'Select Font Style', 'ascent' ),
			  'description' => __( 'Configure Font Style.', 'ascent' ),
			  'choices' => $ascent_google_fonts
			) );


			$wp_customize->add_setting( 'ascent_theme_options[asc_body_text_color]', array(
				'default' => '#333333',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_body_text_color]', array(
				'label' => __( 'Body Text Color', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_body_text_color]',
				'type'          => 'color',
			) ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_body_link_color]', array(
				'default' => '#292b2c',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_body_link_color]', array(
				'label' => __( 'Body Link Color', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_body_link_color]',
				'type'          => 'color',
			) ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_footer_top_border_color]', array(
				'default' => '#f6f6f6',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_footer_top_border_color]', array(
				'label' => esc_html__( 'Footer Top Border Color', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_footer_top_border_color]',
				'type'          => 'color',
			) ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_footer_background_color]', array(
				'default' => '#292b2c',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_footer_background_color]', array(
				'label' => esc_html__( 'Footer Background Color', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_footer_background_color]',
				'type'          => 'color',
			) ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_footer_background_bottom_color]', array(
				'default' => '#292b2c',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_footer_background_bottom_color]', array(
				'label' => esc_html__( 'Footer Bottom Background Color', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_footer_background_bottom_color]',
				'type'          => 'color',
			) ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_theme_color_scheme]', array(
				'default' => 'default',
				'type' => 'theme_mod',
				'transport'   => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'ascent_sanitize_radio',
			) );

			$wp_customize->add_control(
			    new Ascent_Control_Radio_Image(
			        $wp_customize,
			        'ascent_theme_options[asc_theme_color_scheme]',
			        array(
			            'label'          => esc_html__( 'Theme Color Scheme', 'ascent' ),
			            'section'        => 'colors',
			            'settings'       => 'ascent_theme_options[asc_theme_color_scheme]',
			            'type'           => 'radio',
						'choices' => array(
							'default' => $imagepath . 'default-color.png',
							'green' => $imagepath . 'green.png',
							'gamboge' => $imagepath . 'gamboge.png',
							'turquoise4' => $imagepath . 'turquoise4.png',
							'dodgerblue' => $imagepath . 'dodger-blue.png',
							'mediumslateblue' => $imagepath . 'medium-slate-blue.png',
						)
			        )
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_custom_theme_color]', array(
				'default' => '#292b2c',
				'type' => 'theme_mod',
				'transport'   => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ascent_theme_options[asc_custom_theme_color]', array(
				'label' => esc_html__( 'Custom Theme Color', 'ascent' ),
				'description' => esc_html__( 'User can customize the theme color. <em>(Note: If you wants to use the above "Theme Color Scheme" option, you should be clear this "Custom Theme Color" option. Otherwise this "Custom Theme Color" option will override the "Theme Color Scheme" option.)</em>.', 'ascent' ),
				'section' => 'colors',
				'settings'      => 'ascent_theme_options[asc_custom_theme_color]',
				'type'          => 'color',
			) ) );


			/*  Social Media
			============================================================================================*/
			$wp_customize->add_section( 'ascent_social_section' , array(
				'title'      => __( 'Social Media', 'ascent' ),
				'priority' => 5,
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_facebook_url]', array(
		        'default' => 'https://facebook.com',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
			) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_facebook_url]', array(
		        'label' => __( 'Facebook URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_twitter_url]', array(
		        'default' => 'https://twitter.com',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_twitter_url]', array(
		        'label' => __( 'Twitter URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_linkedin_url]', array(
		        'default' => '',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_linkedin_url]', array(
		        'label' => __( 'LinkedIn URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_google_plus_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );

		    $wp_customize->add_control( 'ascent_theme_options[asc_google_plus_url]', array(
		        'label' => __( 'Google Plus URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_instagram_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_instagram_url]', array(
		        'label' => __( 'Instagram URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_youtube_url]', array(
		        'default' => '',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_youtube_url]', array(
		        'label' => __( 'YouTube URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_skype_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_skype_url]', array(
		        'label' => __( 'Skype URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_dribbble_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_dribbble_url]', array(
		        'label' => __( 'Dribbble URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_digg_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_digg_url]', array(
		        'label' => __( 'Digg URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_github_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_github_url]', array(
		        'label' => __( 'Github URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_delicious_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_delicious_url]', array(
		        'label' => __( 'Delicious URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_reddit_url]', array(
		        'default' => '',
						'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_reddit_url]', array(
		        'label' => __( 'Reddit URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_pinterest_url]', array(
		        'default' => '',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_pinterest_url]', array(
		        'label' => __( 'Pinterest URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_rss_url]', array(
		        'default' => '',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_rss_url]', array(
		        'label' => __( 'RSS URL', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'url',
		    ) );

		    $wp_customize->add_setting( 'ascent_theme_options[asc_whatsapp_number]', array(
		        'default' => '',
				'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );
		    $wp_customize->add_control( 'ascent_theme_options[asc_whatsapp_number]', array(
		        'label' => __( 'Whatsapp Number', 'ascent' ),
		        'description' => __( 'Please enter the number using your country code e.g +91 7735899277', 'ascent' ),
		        'section' => 'ascent_social_section',
		        'type' => 'text',
		    ) );



			/*  Home Page Slider
			============================================================================================*/

			$wp_customize->add_section( 'ascent_home_page_slider' , array(
				'title'      => __( 'Home Page Slider', 'ascent' ),
				'description' => __( 'In this Slider section, you can upload image or video, only one thing will populate in the Home page slider', 'ascent' ),
				'priority'   => 7,
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_home_page_slider]' , array(
				'default' => true,
				'transport'   => 'refresh',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_home_page_slider]', array(
				'label' => __( 'Do you want to display slider on homepage?', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_home_page_slider]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_static_header_banner_image]' , array(
				'default' => true,
				'transport'   => 'refresh',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_static_header_banner_image]', array(
				'label' => __( 'Do you want to display the static banner image ?', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_static_header_banner_image]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_slider_overlay_bg]' , array(
				'transport'   => 'refresh',
				'default' => true,
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_slider_overlay_bg]', array(
				'label' => __( 'Do you want to enable slider overlay dotted bg ?', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_enable_slider_overlay_bg]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_home_slider_pagination]' , array(
				'default' => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_home_slider_pagination]', array(
				'label' => __( 'Do you want to enable slider dotted pagination?', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_enable_home_slider_pagination]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_enable_home_slider_navigation]' , array(
				'transport'   => 'refresh',
				'default' => '',
				'sanitize_callback' => 'ascent_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'ascent_theme_options[asc_enable_home_slider_navigation]', array(
				'label' => __( 'Do you want to enable slider left/right navigation?', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_enable_home_slider_navigation]',
				'type' => 'checkbox',
			) );

			$wp_customize->add_setting( 'ascent_theme_options[asc_home_slider_video_height]', array(
				'capability' => 'edit_theme_options',
				'default' => '400',
				'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
		      'ascent_theme_options[asc_home_slider_video_height]',
		      array(
		          'label' => esc_html__( 'Enter the Video Height in Pixel', 'ascent' ),
		          'section' => 'ascent_home_page_slider',
		          'type' => 'text'
		      )
		  	);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_image_1]', array(
				'capability' => 'edit_theme_options',
				'default' => '',
				'sanitize_callback' => 'ascent_sanitize_image',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'ascent_theme_options[asc_slider_image_1]', array(
				'label'    => __( 'Slider Image 1', 'ascent' ),
				'section' => 'ascent_home_page_slider',
				'settings' => 'ascent_theme_options[asc_slider_image_1]',
				'description' => __( 'Upload image for first slider in sequence.', 'ascent' ),
			)));

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_video_1]', array(
				'capability' => 'edit_theme_options',
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
		      'ascent_theme_options[asc_slider_video_1]',
		        array(
			      'label' => esc_html__( 'Enter the Slider Video URL 1', 'ascent' ),
			      'section' => 'ascent_home_page_slider',
			      'type' => 'text'
		        )
		    );

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_description_1]', array(
				'capability' => 'edit_theme_options',
				'default' => '',
				'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
		      'ascent_theme_options[asc_slider_description_1]',
		      array(
		          'label' => esc_html__( 'Slider description 1', 'ascent' ),
		          'section' => 'ascent_home_page_slider',
		          'type' => 'textarea'
		       )
		    );

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_image_2]', array(
			  'capability' => 'edit_theme_options',
			  'sanitize_callback' => 'ascent_sanitize_image',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'ascent_theme_options[asc_slider_image_2]', array(
			    'label'    => __( 'Slider Image 2', 'ascent' ),
			    'section' => 'ascent_home_page_slider',
			    'settings' => 'ascent_theme_options[asc_slider_image_2]',
			    'description' => __( 'Upload image for first slider in sequence.', 'ascent' ),
			)));

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_video_2]', array(
			  'capability' => 'edit_theme_options',
			  'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_video_2]',
			    array(
			        'label' => esc_html__( 'Enter the Slider Video URL 2', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'text'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_description_2]', array(
			  	'capability' => 'edit_theme_options',
				'default' => '',
			  	'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_description_2]',
			    array(
			        'label' => esc_html__( 'Slider description 2', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'textarea'
			    )
			);


			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_image_3]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'ascent_sanitize_image',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'ascent_theme_options[asc_slider_image_3]', array(
				    'label'    => __( 'Slider Image 3', 'ascent' ),
				    'section' => 'ascent_home_page_slider',
				    'settings' => 'ascent_theme_options[asc_slider_image_3]',
				    'description' => __( 'Upload image for first slider in sequence.', 'ascent' ),
				)
			));

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_video_3]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_video_3]',
			    array(
			        'label' => esc_html__( 'Enter the Slider Video URL 3', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'text'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_description_3]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_description_3]',
			    array(
			        'label' => esc_html__( 'Slider description 3', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'textarea'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_image_4]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'ascent_sanitize_image',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'ascent_theme_options[asc_slider_image_4]', array(
			    'label'    => __( 'Slider Image 4', 'ascent' ),
			    'section' => 'ascent_home_page_slider',
			    'settings' => 'ascent_theme_options[asc_slider_image_4]',
			    'description' => __( 'Upload image for first slider in sequence.', 'ascent' ),
			)));

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_video_4]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_video_4]',
			    array(
			        'label' => esc_html__( 'Enter the Slider Video URL 4', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'text'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_description_4]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_description_4]',
			    array(
			        'label' => esc_html__( 'Slider description 4', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'textarea'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_image_5]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'ascent_sanitize_image',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'ascent_theme_options[asc_slider_image_5]', array(
			    'label'    => __( 'Slider Image 5', 'ascent' ),
			    'section' => 'ascent_home_page_slider',
			    'settings' => 'ascent_theme_options[asc_slider_image_5]',
			    'description' => __( 'Upload image for first slider in sequence.', 'ascent' ),
			)));

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_video_5]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_video_5]',
			    array(
			        'label' => esc_html__( 'Enter the Slider Video URL 5', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'text'
			    )
			);

			$wp_customize->add_setting( 'ascent_theme_options[asc_slider_description_5]', array(
			  'capability' => 'edit_theme_options',
				'default' => '',
			  'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
			    'ascent_theme_options[asc_slider_description_5]',
			    array(
			        'label' => esc_html__( 'Slider description 5', 'ascent' ),
			        'section' => 'ascent_home_page_slider',
			        'type' => 'textarea'
			    )
			);


			/* Footer Section*/

			$wp_customize->add_section( 'ascent_footer', array(
					'title' => __( 'Footer Settings', 'ascent' ),
					'priority' => 8,
			));

			$wp_customize->add_setting( 'ascent_theme_options[asc_copyright]', array(
				'capability' => 'edit_theme_options',
				'default' => '',
				'sanitize_callback' => 'wp_kses_post'
			) );
			$wp_customize->add_control(
		      'ascent_theme_options[asc_copyright]',
		      array(
		          'label' => esc_html__( 'Copyright', 'ascent' ),
		          'section' => 'ascent_footer',
		          'type' => 'textarea'
		       )
		    );
		}


	}

}

/**
 *  Class calling using this 'get_instance()' method
 */
Ascent_Customizer::get_instance();
