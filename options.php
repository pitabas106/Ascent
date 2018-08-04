<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */

function optionsframework_option_name() {

	// Change this to use your theme slug
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'ascent'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/includes/images/theme-options/';

	$protocol = is_ssl() ? 'https' : 'http';
	$google_raleway = 'Raleway|||'. $protocol. "://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i";
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

	$options = array();

	/*  Tab 1: Header Settings
	============================================================================================*/
	$options[] = array(
		'name' => __('Header Settings', 'ascent'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Favicon', 'ascent'),
		'desc' => __('Upload a 16px by 16px PNG image that will represent your website favicon.', 'ascent'),
		'id' => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Logo', 'ascent'),
		'desc' => __('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'ascent'),
		'id' => 'logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Default Banner Image', 'ascent'),
		'desc' => __('Default banner image will be displayed on all the pages where banner image is not overridden by page specific banner settings.', 'ascent'),
		'id' => 'default_banner_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Phone Number', 'ascent'),
		'desc' => __('Provide the phone number.', 'ascent'),
		'id' => 'phone_number',
		'std' => '000-000-0000',
		'type' => 'text');

	$options[] = array(
		'name' => __('Email ID', 'ascent'),
		'desc' => __('Provide the email address.', 'ascent'),
		'id' => 'email_id',
		'std' => 'support@wordpress.com',
		'type' => 'text');



	/*  Tab 2: Styling
	============================================================================================*/
	$options[] = array(
		'name' => __('Styling', 'ascent'),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Select Font Style', 'ascent' ),
		'desc' => __( 'Configure Font Style.', 'ascent' ),
		'id' => 'body_font_family',
		'std' => '',
		'type' => 'select',
		'class' => 'small', //mini, tiny, small
		'options' => $ascent_google_fonts
	);

	$options[] = array(
		'name' => __('Body Text Color', 'ascent'),
		'desc' => __('Configure body text color.', 'ascent'),
		'id' => 'body_text_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Body Link Color', 'ascent'),
		'desc' => __('Configure body link color.', 'ascent'),
		'id' => 'body_link_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Top Border Color', 'ascent'),
		'desc' => __('Configure footer top border color.', 'ascent'),
		'id' => 'footer_top_border_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Background Color', 'ascent'),
		'desc' => __('Configure footer background color. ', 'ascent'),
		'id' => 'footer_background_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Bottom Background Color', 'ascent'),
		'desc' => __('Configure footer bottom background color. ', 'ascent'),
		'id' => 'footer_background_bottom_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => "Theme Color Scheme",
		'desc' => "Select the color scheme.",
		'id' => "theme_color_scheme",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'default-color.png',
			'green' => $imagepath . 'green.png',
			'gamboge' => $imagepath . 'gamboge.png',
			'turquoise4' => $imagepath . 'turquoise4.png',
			'dodgerblue' => $imagepath . 'dodger-blue.png',
			'mediumslateblue' => $imagepath . 'medium-slate-blue.png',
		)
	);

	$options[] = array(
		'name' => __('Custom Theme Color', 'ascent'),
		'desc' => __('User can customize the theme color. <em>(Note: If you wants to use the above "Theme Color Scheme" option, you should be clear this "Custom Theme Color" option. Otherwise this "Custom Theme Color" option will override the "Theme Color Scheme" option.)</em>. ', 'ascent'),
		'id' => 'custom_theme_color',
		'std' => '',
		'type' => 'color' );


	/*  Tab 3: Social Media
	============================================================================================*/
	$options[] = array(
		'name' => __('Social Media', 'ascent'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Facebook', 'ascent'),
		'desc' => __('Provide facebook url.', 'ascent'),
		'id' => 'facebook_url',
		'std' => 'http://facebook.com',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'ascent'),
		'desc' => __('Provide twitter url.', 'ascent'),
		'id' => 'twitter_url',
		'std' => 'http://twitter.com',
		'type' => 'text');

	$options[] = array(
		'name' => __('LinkedIn', 'ascent'),
		'desc' => __('Provide linkedin url.', 'ascent'),
		'id' => 'linkedin_url',
		'placeholder' => 'LinkedIn',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google+', 'ascent'),
		'desc' => __('Provide google plus url.', 'ascent'),
		'id' => 'google_plus_url',
		'placeholder' => 'Google+',
		'type' => 'text');

	$options[] = array(
		'name' => __('Instagram', 'ascent'),
		'desc' => __('Provide instagram url.', 'ascent'),
		'id' => 'instagram_url',
		'placeholder' => 'Instagram',
		'type' => 'text');

	$options[] = array(
		'name' => __('YouTube', 'ascent'),
		'desc' => __('Provide youtube url.', 'ascent'),
		'id' => 'youtube_url',
		'placeholder' => 'YouTube',
		'type' => 'text');

	$options[] = array(
		'name' => __('Skype', 'ascent'),
		'desc' => __('Provide Skype url.', 'ascent'),
		'id' => 'skype_url',
		'placeholder' => 'Skype',
		'type' => 'text');

	$options[] = array(
		'name' => __('Dribbble', 'ascent'),
		'desc' => __('Provide dribbble url.', 'ascent'),
		'id' => 'dribbble_url',
		'placeholder' => 'Dribbble',
		'type' => 'text');

	$options[] = array(
		'name' => __('Digg', 'ascent'),
		'desc' => __('Provide digg url.', 'ascent'),
		'id' => 'digg_url',
		'placeholder' => 'Digg',
		'type' => 'text');

	$options[] = array(
		'name' => __('Github', 'ascent'),
		'desc' => __('Provide github url.', 'ascent'),
		'id' => 'github_url',
		'placeholder' => 'Github',
		'type' => 'text');

	$options[] = array(
		'name' => __('Delicious', 'ascent'),
		'desc' => __('Provide delicious url.', 'ascent'),
		'id' => 'delicious_url',
		'placeholder' => 'Delicious',
		'type' => 'text');

	$options[] = array(
		'name' => __('Reddit', 'ascent'),
		'desc' => __('Provide reddit url.', 'ascent'),
		'id' => 'reddit_url',
		'placeholder' => 'Reddit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pinterest', 'ascent'),
		'desc' => __('Provide pinterest url.', 'ascent'),
		'id' => 'pinterest_url',
		'placeholder' => 'Pinterest',
		'type' => 'text');

	$options[] = array(
		'name' => __('Flickr', 'ascent'),
		'desc' => __('Provide flickr url.', 'ascent'),
		'id' => 'flickr_url',
		'placeholder' => 'Flickr',
		'type' => 'text');

	$options[] = array(
		'name' => __('RSS', 'ascent'),
		'desc' => __('Provide rss url.', 'ascent'),
		'id' => 'rss_url',
		'placeholder' => 'RSS',
		'type' => 'text');


	/*  Tab 4: Home Slider Settings
	============================================================================================*/
	$options[] = array(
		'name' => __('Home Page Slider', 'ascent'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Homepage Slider', 'ascent'),
		'desc' => __('Do you want to display slider on homepage?', 'ascent'),
		'id' => 'home_page_slider',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable header static banner', 'ascent'),
		'desc' => __('Do you want to display the static banner image?', 'ascent'),
		'id' => 'static_header_banner_image',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Slider Dotted Overlay BG', 'ascent'),
		'desc' => __('Do you want to enable slider overlay dotted bg?', 'ascent'),
		'id' => 'slider_overlay_bg',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Slider Dotted Pagination', 'ascent'),
		'desc' => __('Do you want to enable slider dotted pagination?', 'ascent'),
		'id' => 'enable_home_slider_pagination',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Slider Navigation', 'ascent'),
		'desc' => __('Do you want to enable slider left/right navigation?', 'ascent'),
		'id' => 'enable_home_slider_navigation',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Video Height', 'ascent'),
		'desc' => __('Provide video height in pixel.', 'ascent'),
		'id' => 'home_slider_video_height',
		'std' => '400',
		'type' => 'text');


	/* Slider 1 */
	$options[] = array(
		'name' => "Homepage Slider Type",
		'desc' => "Select the slider type(Video/Image).",
		'id' => "home_page_slider_type_1",
		'std' => "image_type",
		'type' => "images",
		'options' => array(
			'image_type' => $imagepath . 'image-type.png',
			'video_type' => $imagepath . 'video-type.png',
		)
	);
	$options[] = array(
		'name' => __('Slider Image 1', 'ascent'),
		'desc' => __('Upload slider image 1.', 'ascent'),
		'id' => 'slider_image_1',
		'std' => get_template_directory_uri() . '/includes/images/banner.jpg',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Slider Video 1', 'ascent'),
		'desc' => __('Enter the video URL.', 'ascent'),
		'id' => 'slider_video_1',
		'type' => 'text');
	$options[] = array(
		'name' => __('Slider Description 1', 'ascent'),
		'desc' => __('slider description 1.', 'ascent'),
		'id' => 'slider_description_1',
		'type' => 'textarea');

	/* Slider 2 */
	$options[] = array(
		'name' => "Homepage Slider Type",
		'desc' => "Select the slider type(Video/Image).",
		'id' => "home_page_slider_type_2",
		'std' => "image_type",
		'type' => "images",
		'options' => array(
			'image_type' => $imagepath . 'image-type.png',
			'video_type' => $imagepath . 'video-type.png',
		)
	);
	$options[] = array(
		'name' => __('Slider Image 2', 'ascent'),
		'desc' => __('Upload slider image 2.', 'ascent'),
		'id' => 'slider_image_2',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Slider Video 2', 'ascent'),
		'desc' => __('Enter the video URL.', 'ascent'),
		'id' => 'slider_video_2',
		'type' => 'text');
	$options[] = array(
		'name' => __('Slider Description 2', 'ascent'),
		'desc' => __('slider description 2.', 'ascent'),
		'id' => 'slider_description_2',
		'type' => 'textarea');

	/* Slider 3 */
	$options[] = array(
		'name' => "Homepage Slider Type",
		'desc' => "Select the slider type(Video/Image).",
		'id' => "home_page_slider_type_3",
		'std' => "image_type",
		'type' => "images",
		'options' => array(
			'image_type' => $imagepath . 'image-type.png',
			'video_type' => $imagepath . 'video-type.png',
		)
	);
	$options[] = array(
		'name' => __('Slider Image 3', 'ascent'),
		'desc' => __('Upload slider image 3.', 'ascent'),
		'id' => 'slider_image_3',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Slider Video 3', 'ascent'),
		'desc' => __('Enter the video URL.', 'ascent'),
		'id' => 'slider_video_3',
		'type' => 'text');
	$options[] = array(
		'name' => __('Slider Description 3', 'ascent'),
		'desc' => __('slider description 3.', 'ascent'),
		'id' => 'slider_description_3',
		'type' => 'textarea');

	/* Slider 4 */
	$options[] = array(
		'name' => "Homepage Slider Type",
		'desc' => "Select the slider type(Video/Image).",
		'id' => "home_page_slider_type_4",
		'std' => "image_type",
		'type' => "images",
		'options' => array(
			'image_type' => $imagepath . 'image-type.png',
			'video_type' => $imagepath . 'video-type.png',
		)
	);
	$options[] = array(
		'name' => __('Slider Image 4', 'ascent'),
		'desc' => __('Upload slider image 4.', 'ascent'),
		'id' => 'slider_image_4',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Slider Video 4', 'ascent'),
		'desc' => __('Enter the video URL.', 'ascent'),
		'id' => 'slider_video_4',
		'type' => 'text');
	$options[] = array(
		'name' => __('Slider Description 4', 'ascent'),
		'desc' => __('slider description 4.', 'ascent'),
		'id' => 'slider_description_4',
		'type' => 'textarea');

	/* Slider 5 */
	$options[] = array(
		'name' => "Homepage Slider Type",
		'desc' => "Select the slider type(Video/Image).",
		'id' => "home_page_slider_type_5",
		'std' => "image_type",
		'type' => "images",
		'options' => array(
			'image_type' => $imagepath . 'image-type.png',
			'video_type' => $imagepath . 'video-type.png',
		)
	);
	$options[] = array(
		'name' => __('Slider Image 5', 'ascent'),
		'desc' => __('Upload slider image 5.', 'ascent'),
		'id' => 'slider_image_5',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Slider Video 5', 'ascent'),
		'desc' => __('Enter the video URL.', 'ascent'),
		'id' => 'slider_video_5',
		'type' => 'text');
	$options[] = array(
		'name' => __('Slider Description 5', 'ascent'),
		'desc' => __('slider description 5.', 'ascent'),
		'id' => 'slider_description_5',
		'type' => 'textarea');


	/*  Tab 5: Other Settings
	============================================================================================*/
	$options[] = array(
		'name' => __('Other Settings', 'ascent'),
		'type' => 'heading');

	/* Enable/Disable Swipebox */
	$options[] = array(
		'name' => __('Enable Swipebox- A touchable jQuery lightbox ', 'ascent'),
		'desc' => __('Do you want to enable the Swipebox plugin?', 'ascent'),
		'id' => 'enable_swipebox',
		'std' => '1',
		'type' => 'checkbox');

	/* Enable/Disable Sticky Header */
	$options[] = array(
		'name' => __('Enable Sticky Header ', 'ascent'),
		'desc' => __('Do you want to enable the sticky header?', 'ascent'),
		'id' => 'enable_sticky_header',
		'std' => '1',
		'type' => 'checkbox');

	/* Enable/Disable Scroll to Top Feature */
	$options[] = array(
		'name' => __('Enable Scroll to Top ', 'ascent'),
		'desc' => __('Do you want to enable scroll to top feature?', 'ascent'),
		'id' => 'enable_scroll_to_top',
		'std' => '1',
		'type' => 'checkbox');

	return $options;
}
