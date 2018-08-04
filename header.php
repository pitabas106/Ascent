<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="main-content">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <!-- <title><?php wp_title( '|', true, 'right' ); ?></title> -->
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo of_get_option('favicon'); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/includes/js/html5.min.js"></script>
    <![endif]-->

    <?php if (of_get_option('enable_home_slider_pagination')): ?>
      <script type="text/javascript">
        home_slider_pagination = 1;
      </script>
    <?php else: ?>
      <script type="text/javascript">
        home_slider_pagination = 0;
      </script>
    <?php endif; ?>

    <?php if (of_get_option('enable_home_slider_navigation')): ?>
      <script type="text/javascript">
        home_slider_nav = 1;
      </script>
    <?php else: ?>
      <script type="text/javascript">
        home_slider_nav = 0;
      </script>
    <?php endif; ?>

    <?php wp_head(); ?>

    <?php if(of_get_option('body_font_family')): ?>
      <?php $fonts_array = explode('|||', of_get_option('body_font_family')); ?>
      <style>
        body, h1, h2, h3, h4, h5, h6, p, * {
            font-family: '<?php echo $fonts_array[0]; ?>', sans-serif, arial;
        }
      </style>
      <?php endif; ?>
</head>

<body <?php body_class(); ?>>
  <?php do_action('before'); ?>
<header id="masthead" class="site-header" role="banner">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mail-info">
            			<?php if (of_get_option('phone_number')): ?>
            			    <span class="phone-info"><i class="fa fa-phone"></i> <?php echo of_get_option('phone_number'); ?></span>
            			<?php endif; ?>
            			<?php if (of_get_option('email_id')): ?>
            			    <span><i class="fa fa-envelope"></i> <a href="mailto:<?php echo of_get_option('email_id'); ?>"><?php echo of_get_option('email_id'); ?></a></span>
            			<?php endif; ?>
                    </div>
                </div><!-- .col-sm-6-->
                <div class="col-sm-6">
                    <div class="header-social-icon-wrap">
                        <ul class="social-icons">
            			    <?php
                            $socialmedia_navs = ascent_socialmedia_navs();
                            foreach ($socialmedia_navs as $socialmedia_url => $socialmedia_icon) {
                                if (of_get_option($socialmedia_url)) {
                                    echo '<li class="social-icon"><a target="_blank" href="'.of_get_option($socialmedia_url).'"><i class="'.$socialmedia_icon.'"></i></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div><!--.header-social-icon-wrap-->
                </div><!-- .col-sm-6-->
            </div>
        </div>
     </div>
    <div id="header-main" class="header-bottom">
        <div class="header-bottom-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div id="logo">
                            <div class="site-header-inner col-sm-12">
                                <div class="site-branding">
                                    <h1 class="site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                        				    <?php if (of_get_option('logo')): ?>
        					                   <img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                        				    <?php else: ?>
        					                   <?php bloginfo('name'); ?>
                        				    <?php endif; ?>
                    				    </a>
                                    </h1>
                				    <h4 class="site-description"><?php bloginfo('description'); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div><!--.col-sm-3-->

                    <div class="col-sm-9">
                        <div class="header-search pull-right">
                            <div id="header-search-button"><i class="fa fa-search"></i></div>
                        </div>
                        <div class="site-navigation pull-right">
            			    <nav class="main-menu">
            				<?php
                            wp_nav_menu(array(
                                'theme_location' => 'main-menu',
                                'container' => false,
                                'menu_class' => 'header-nav clearfix',
                            ));
                            ?>
            			    </nav>
    	                    <div id="responsive-menu-container"></div>
                        </div><!-- .site-navigation -->
                    </div><!--.col-sm-9-->
                </div><!--.row-->
            </div><!-- .container -->
        </div><!--.header-bottom-inner-->
    </div><!--.header-bottom-->
  <?php include_once 'header-searchform.php' ?>
</header><!-- #masthead -->

<?php include_once 'header-banner.php' ?>

<div class="main-content">
    <div class="container">
        <div id="content" class="main-content-inner">
