<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Ascent
 * @since   0.0.1
 */
get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-8">	
	
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="entry-title" itemprop="headline">
				<?php printf( __( 'Search Results for: %s', 'ascent' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header><!-- .page-header -->

		<?php ascent_content_while_before(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php ascent_entry_before(); ?>

			<?php get_template_part( 'template-parts/content', 'search' ); ?>

			<?php ascent_entry_after(); ?>

		<?php endwhile; ?>

		<?php ascent_content_while_after(); ?>


		<?php ascent_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php ascent_entry_before(); ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

		<?php ascent_entry_after(); ?>

	<?php endif; // end of loop. ?>

    </div>
    
    <div class="col-sm-12 col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>