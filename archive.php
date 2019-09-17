<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ascent
 * @since   0.0.1
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-9">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
		<div class="content-padder">

		    <?php if ( have_posts() ) : ?>

		        <header class="page-header">
		            <?php
		              the_archive_title( '<h1 class="page-title" itemprop="headline">', '</h1>' );
		              the_archive_description( '<div class="taxonomy-description">', '</div>' );
		            ?>
				</header><!-- .page-header -->

				<?php ascent_content_while_before(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php ascent_entry_before(); ?>

				    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				    <?php ascent_entry_after(); ?>

				<?php endwhile; ?>

				<?php ascent_content_while_after(); ?>

				<?php ascent_content_nav( 'nav-below' ); ?>

		    <?php else : ?>

		    	<?php ascent_entry_before(); ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

				<?php ascent_entry_after(); ?>

		    <?php endif; ?>

		</div><!-- .content-padder -->

    </div>

    <div class="col-sm-12 col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
