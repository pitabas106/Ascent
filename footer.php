<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package ascent
 */
?>
        </div><!-- close .*-inner (main-content) -->
    </div><!-- close .container -->
</div><!-- close .main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
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
                <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'ascent' ); ?>" ><?php printf( __( '&copy; 2018 ascent. All rights reserved', 'ascent' ), 'WordPress' ); ?></a>
                <span class="sep"> | </span>
                <?php printf( __( '%1$s  ', 'ascent' ), 'Ascent by '); ?><a href="<?php echo esc_url( __( 'http://nettantra.com/', 'ascent' ) ); ?>" target="_blank"><?php printf( __( 'NetTantra', 'ascent' ), 'NetTantra' ); ?></a>
            </div><!-- close .site-info -->
        </div>
    </div>
</footer><!-- close #colophon -->
<?php if(of_get_option('enable_scroll_to_top')): ?>
    <a href="#top" id="scroll-top"></a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
