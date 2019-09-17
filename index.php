<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ascent
 * @since   0.0.1
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-9">	
	<?php if ( have_posts() ) : ?>
    	<?php ascent_content_while_before(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php ascent_entry_before(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			
			<?php ascent_entry_after(); ?>

		<?php endwhile; ?>

		<?php ascent_content_nav( 'nav-below' ); ?>

    	<?php ascent_content_while_after(); ?>


	<?php else : ?>

		<?php ascent_entry_before(); ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

		<?php ascent_entry_after(); ?>

	<?php endif; ?>
    </div>
    
    <div class="col-sm-12 col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>