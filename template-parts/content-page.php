<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ascent
 * @since   0.0.1
 */
?>

<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php ascent_entry_top(); ?>

	<header class="page-header">
		<?php ascent_entry_header_before(); ?>

		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

		<?php ascent_entry_header_after(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="text">
		<?php ascent_entry_content_before(); ?>

		<?php the_content(); ?>
		
		<?php ascent_entry_content_after(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ascent' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<?php ascent_entry_footer_before(); ?>

		<?php edit_post_link( __( 'Edit', 'ascent' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
		
	<?php ascent_entry_footer_after(); ?>


	<?php ascent_entry_bottom(); ?>

</article><!-- #post-## -->
