<?php
/**
 * Template for Header Contact Info
 *
 * @package     Ascent
 * @since       3.7.0
 */
?>

<div class="mail-info">
    
    <?php
        $phone_number = ascent_get_options( 'asc_phone_number' );
        $email_id     = ascent_get_options( 'asc_email_id' );
    ?>
    <?php if ( $phone_number ): ?>
        <span class="phone-info"><i class="fas fa-phone-square-alt"></i> <?php echo esc_html( $phone_number ); ?></span>
    <?php endif; ?>

    <?php if ( $email_id ): ?>
        <span><i class="fas fa-envelope"></i> <a href="mailto:<?php echo esc_html( $email_id ); ?>"><?php echo esc_html( $email_id ); ?></a></span>
    <?php endif; ?>

</div>