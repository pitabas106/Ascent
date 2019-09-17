<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Ascent
 * @since 1.0.0
 */
?>

<?php ascent_sidebars_before(); ?>

<div class="sidebar">

    <?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
    <div class="sidebar-padder">

    	<?php ascent_sidebar_top()  ?>

    	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

    	    <aside id="search" class="widget widget_search">
    		   <?php get_search_form(); ?>
    	    </aside>

    	    <aside id="archives" class="widget widget_archive">
      		    <h3 class="widget-title"><?php esc_html_e( 'Archives', 'ascent' ); ?></h3>
          		<ul>
          		    <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
          		</ul>
    	    </aside>

    	    <aside id="meta" class="widget widget_meta">
        		<h3 class="widget-title"><?php esc_html_e( 'Meta', 'ascent' ); ?></h3>
        		<ul>
        		    <?php wp_register(); ?>
        		    <li><?php wp_loginout(); ?></li>
        		    <?php wp_meta(); ?>
        		</ul>
            </aside>

    	<?php endif; ?>

        <?php ascent_sidebar_bottom(); ?>

    </div><!-- close .sidebar-padder -->
</div><!-- close .sidebar -->

<?php ascent_sidebars_after(); ?>
