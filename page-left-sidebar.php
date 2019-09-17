<?php
/**
 * Template Name: Left Sidebar Page
 *
 *
 * @package Ascent
 * @since   0.0.1
 */

get_header(); ?>


<div class="row">
    
    <div class="col-sm-12 col-md-3">
        <?php get_sidebar(); ?>
    </div>
    
    <div class="col-sm-12 col-md-9">

        <?php ascent_content_while_before(); ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php ascent_entry_before(); ?>

            <?php get_template_part( 'template-parts/content', 'page' ); ?>

            <?php ascent_entry_after(); ?>
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
        <?php endwhile; // end of the loop. ?>

        <?php ascent_content_while_after(); ?>

    </div>
    
</div>
<?php get_footer(); ?>