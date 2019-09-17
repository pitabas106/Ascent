<?php
/**
 * Template for Header Social Meida
 *
 * @package     Ascent
 * @since       3.7.0
 */

  $wa_message = __( 'Hey, Please visit our website to get more info.', 'ascent' );
  $wa_text = urlencode( '$wa_message'.site_url() );

?>

<div class="header-social-icon-wrap">

    <ul class="social-icons">
       <?php
        $socialmedia_navs = ascent_socialmedia_navs();
        foreach ( $socialmedia_navs as $name => $item_class ) {
          $social_url = ascent_get_options( $name );
          
          if( $name == 'asc_whatsapp_number' && $social_url ) {
            echo '<li class="social-icon">
              <a target="_blank" href="'.esc_url( 'https://api.whatsapp.com/send?phone='.$social_url .'&text='.$wa_text ).'"><i class="'.$item_class.'"></i></a>
              </li>';
          } else {
            if ( $social_url ) {
            echo '<li class="social-icon"><a target="_blank" href="'.esc_url( $social_url ).'"><i class="'.$item_class.'"></i></a></li>';
            }
          }
        }
        ?>
    </ul>
    
</div>
