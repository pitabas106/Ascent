<?php
/**
 * Template for Header Logo
 *
 * @package     Ascent
 * @since       3.7.0
 */
?>

<div id="logo">
    <div class="site-header-inner col-md-12">
        <div class="site-branding">
            <h1 class="site-title">
                <?php
                  $logo = ascent_get_options( 'asc_logo' );
                  $custom_logo =  get_custom_logo();
                  
                  if( $logo && ! $custom_logo ) {
                    $updated_logo = $logo; ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name', 'display' )); ?>" rel="home"><img src="<?php echo esc_url( $updated_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
                    <?php 
                      } else if( ! $logo && $custom_logo ) {
                        echo $custom_logo;
                      } else if( $logo && $custom_logo ) {
                        echo $custom_logo;
                      } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    <?php 
                  }
                ?>
            </h1>
            <?php if( display_header_text() ) : ?>
              <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
            <?php endif; ?>
        </div>
    </div>
</div>