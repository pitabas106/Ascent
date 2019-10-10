<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Ascent
 * @since   0.0.1
 */

 $enable_scroll_to_top = ascent_get_options('asc_enable_scroll_to_top');
 
 $asc_copyright = ascent_get_options('asc_copyright');

?>
            <?php ascent_content_bottom(); ?> 

        </div><!-- close .*-inner (main-content) -->
    </div><!-- close .container -->
</div><!-- close .main-content -->

<?php ascent_content_after(); ?>


    <?php ascent_footer_before(); ?>

    <footer id="colophon" class="site-footer" role="contentinfo">

        <?php ascent_footer_top(); ?>

        <div class="container animated fadeInLeft">
            <div class="row">
                <div class="site-footer-inner col-sm-12 clearfix">
                <?php get_sidebar( 'footer' ); ?>
                </div>
            </div>
        </div><!-- close .container -->

        <div id="footer-info">
            <div class="container">
                <div class="site-info">

                    <?php do_action( 'ascent_credits' ); ?>

                    <?php if( $asc_copyright ): ?>

                        <?php echo $asc_copyright; ?>

                    <?php else: ?>

                        <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'ascent' ); ?>" ><?php printf( __( '&copy; %u Ascent. All rights reserved', 'ascent' ),  date("Y") ); ?></a>
                        <span class="sep"> | </span>
                        <?php printf( __( '%1$s  ', 'ascent' ), 'Ascent by '); ?><a href="<?php echo esc_url( __( 'https://zetamatic.com/', 'ascent' ) ); ?>" target="_blank"><?php printf( __( 'ZetaMatic', 'ascent' ), 'ZetaMatic' ); ?></a>

                    <?php endif; ?>
                    
                </div><!-- close .site-info -->
            </div>
        </div>

        <?php ascent_footer_bottom(); ?>

    </footer><!-- close #colophon -->

    <?php ascent_footer_after(); ?>

    <?php if( $enable_scroll_to_top ): ?>
        <a href="#top" id="scroll-top"></a>
    <?php endif; ?>

    <?php ascent_body_bottom(); ?>

<?php wp_footer(); ?>

</body>
</html>
