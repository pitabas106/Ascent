<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="main-content">
 * @package Ascent
 * @since 1.0.0
 */
?><!DOCTYPE html>
<?php ascent_html_before(); ?>

<html <?php language_attributes(); ?>>
<head>
    <?php ascent_head_top(); ?>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php 
      if( false === get_option( 'site_icon', false ) )  {
        $ascent_old_fav_icon = ascent_get_options( 'favicon' ); 
        if( $ascent_old_fav_icon ) {
          echo '<link rel="icon" href="'.$ascent_old_fav_icon.'" sizes="16x16" />';
        }
      }
    ?>

    <?php
    $home_slider_pagination = ascent_get_options( 'asc_enable_home_slider_pagination' );
    $home_slider_navigation = ascent_get_options( 'asc_enable_home_slider_navigation' );
    $body_font_family       = ascent_get_options( 'asc_body_font_family' );

     if ( $home_slider_pagination ): ?>
      <script type="text/javascript">
        home_slider_pagination = 1;
      </script>
    <?php else: ?>
      <script type="text/javascript">
        home_slider_pagination = 0;
      </script>
    <?php endif; ?>

    <?php if ( $home_slider_navigation ): ?>
      <script type="text/javascript">
        home_slider_nav = 1;
      </script>
    <?php else: ?>
      <script type="text/javascript">
        home_slider_nav = 0;
      </script>
    <?php endif; ?>

    <?php ascent_head_bottom(); ?>

    <?php wp_head(); ?>

    <?php if( $body_font_family ): ?>
      <?php $fonts_array = explode( '|||', $body_font_family ); ?>
      <style>
        body, h1, h2, h3, h4, h5, h6, p, * {
            font-family: '<?php echo $fonts_array[0]; ?>', sans-serif, arial;
        }
      </style>
      <?php endif; ?>
</head>

<body <?php body_class(); ?>>
  
  <?php ascent_body_top(); ?>

  <?php wp_body_open(); ?>

    <?php ascent_header_before(); ?>

    <header id="masthead" class="site-header" role="banner">

        <?php ascent_header_top(); ?>

        <div class="header-top">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <?php get_template_part( 'template-parts/header/header', 'contactinfo' ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php get_template_part( 'template-parts/header/header', 'socialmedia' ); ?>
                    </div>

                </div>
            </div>
        </div>

        <div id="header-main" class="header-bottom">
            <div class="header-bottom-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">

                            <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>

                        </div><!--.col-md-3-->

                        <div class="col-md-9">
                            <div class="header-search pull-right">
                                <div id="header-search-button"><i class="fas fa-search"></i></div>
                            </div>
                            <div class="site-navigation pull-right">

                                <?php get_template_part( 'template-parts/header/header', 'menu' ); ?>
                                
                            </div><!-- .site-navigation -->
                        </div><!--.col-md-9-->
                    </div><!--.row-->
                </div><!-- .container -->
            </div><!--.header-bottom-inner-->
        </div><!--.header-bottom-->

        <?php get_template_part( 'template-parts/header', 'searchform' ); ?>

      <?php ascent_header_bottom(); ?>

    </header><!-- #masthead -->

    <?php ascent_header_after(); ?>

<?php get_template_part( 'template-parts/header', 'banner' ); ?>


<?php ascent_content_before(); ?>

<div class="main-content">
    <div class="container">
        <div id="content" class="main-content-inner">

            <?php ascent_content_top(); ?>
