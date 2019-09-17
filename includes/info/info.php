<?php
/**
 * Info setup
 *
 * @package     Ascent
 * @author      Pitabas106
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       Ascent 3.4.0
 */

if ( ! function_exists( 'ascent_details_setup' ) ) :

    /**
     * Info setup.
     *
     * @since 3.4.0
     */
    function ascent_details_setup() {

        $config = array(

            // Welcome content.
            'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'ascent' ), get_bloginfo('name'), 'ascent' ),

            // Tabs.
            'tabs' => array(
                'getting-started' => esc_html__( 'Getting Started', 'ascent' ),
                'support'         => esc_html__( 'Support', 'ascent' ),
                // 'demo-content'    => esc_html__( 'Demo Content', 'ascent' ),
                'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'ascent' ),
            ),

            // Quick links.
            'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'ascent' ),
                    'url'  => 'https://zetamatic.com/downloads/ascent/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'ascent' ),
                    'url'  => 'https://ascenttheme.com/',
                ),
                
                'rating_url' => array(
                    'text' => esc_html__( 'Rate This Theme','ascent' ),
                    'url'  => 'https://wordpress.org/support/theme/ascent/reviews/#new-post',
                ),
                'pro_url' => array(
                    'text' => esc_html__( 'Ascent Pro','ascent' ),
                    'url'  => ASCENT_PRO_URL,
                ),
            ),

            // Getting started.
            'getting_started' => array(
                
                'two' => array(
                    'title'       => esc_html__( 'Static Front Page', 'ascent' ),
                    'icon'        => 'dashicons dashicons-admin-generic',
                    'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'ascent' ),
                    'button_text' => esc_html__( 'Static Front Page', 'ascent' ),
                    'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                    'button_type' => 'primary',
                ),
                'three' => array(
                    'title'       => esc_html__( 'Theme Options', 'ascent' ),
                    'icon'        => 'dashicons dashicons-admin-customizer',
                    'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'ascent' ),
                    'button_text' => esc_html__( 'Customize', 'ascent' ),
                    'button_url'  => wp_customize_url(),
                    'button_type' => 'primary',
                ),
                'four' => array(
                    'title'       => esc_html__( 'Widgets', 'ascent' ),
                    'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                    'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'ascent' ),
                    'button_text' => esc_html__( 'Widgets', 'ascent' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
                ),
                // 'five' => array(
                //     'title'       => esc_html__( 'Demo Content', 'ascent' ),
                //     'icon'        => 'dashicons dashicons-layout',
                //     'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'ascent' ), esc_html__( 'One Click Demo Import', 'ascent' ) ),
                //     'button_text' => esc_html__( 'Demo Content', 'ascent' ),
                //     'button_url'  => admin_url( 'themes.php?page=ascent-details&tab=demo-content' ),
                //     'button_type' => 'secondary',
                // ),
                'six' => array(
                    'title'       => esc_html__( 'Theme Preview', 'ascent' ),
                    'icon'        => 'dashicons dashicons-welcome-view-site',
                    'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'ascent' ),
                    'button_text' => esc_html__( 'View Demo', 'ascent' ),
                    'button_url'  => 'https://ascenttheme.com/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            // Support.
            'support' => array(
                'one' => array(
                    'title'       => esc_html__( 'Contact Support', 'ascent' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'ascent' ),
                    'button_text' => esc_html__( 'Contact Support', 'ascent' ),
                    'button_url'  => 'https://wordpress.org/support/theme/ascent/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                
                'three' => array(
                    'title'       => esc_html__( 'Child Theme', 'ascent' ),
                    'icon'        => 'dashicons dashicons-admin-tools',
                    'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'ascent' ),
                    'button_text' => esc_html__( 'Learn More', 'ascent' ),
                    'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),


            //Demo content.
            'demo_content' => array(
                'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'ascent' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'ascent' ) . '</a>' ),
            ),

            // Upgrade content.
            'upgrade_to_pro' => array(
                'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'ascent' ),
                'button_text' => esc_html__( 'Upgrade Now', 'ascent' ),
                'button_url'  => 'https://zetamatic.com/downloads/ascent-pro',
                'button_type' => 'primary',
                'is_new_tab'  => true,
            ),
        );

        Ascent_Info::init( $config );
    }

endif;

add_action( 'after_setup_theme', 'ascent_details_setup' );