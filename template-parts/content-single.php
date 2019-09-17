<?php
/**
 * Template for Content Single
 *
 * @package     Ascent
 * @since       0.0.1
 */
?>


<article itemtype="https://schema.org/CreativeWork" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $column_class =  ( 'post' == get_post_type() ) ? 'col-sm-12 col-md-10' : 'col-sm-12 col-md-12';
  ?>

  	<?php ascent_entry_top(); ?>

    <div class="row">
	    <?php if ( 'post' == get_post_type() ) : ?>
	        <div class="post-meta-info col-sm-12 col-md-2">

	        	<?php ascent_entry_meta_before(); ?>

	      		<div class="entry-meta">
	      		    <time class="entry-time updated" itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>"><i class="far fa-clock nt-mobile"></i> <?php the_time( 'M' ); ?><strong><?php the_time( 'd' ); ?></strong></time>
	      		    <span class="comments_count clearfix entry-comments-link"><i class="fas fa-comment-dots nt-mobile"></i>  <?php comments_popup_link( '0', '1', '%' ); ?></span>
	      		</div><!-- .entry-meta -->

	      		<?php ascent_entry_meta_after(); ?>

	        </div><!--.post-meta-info-->
	     <?php endif; ?>

		<div class="post-content-wrap <?php echo esc_attr( $column_class ); ?>">

			<?php ascent_entry_header_before(); ?>

		    <header class="page-header">
				<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
				 <?php if ( 'post' == get_post_type() ) : ?>
				    <span class="entry-author" itemtype="https://schema.org/Person" itemprop="author">
					<?php esc_html_e( 'Posted by', 'ascent' ) ?>
					<span class="author vcard entry-author-link">
					    <?php the_author_posts_link(); ?>
					</span>
				    </span>
				<?php endif; ?>
		    </header><!-- .entry-header -->

		    <?php ascent_entry_header_after(); ?>


		    <div class="entry-content" itemprop="text">

				<?php $format = get_post_format( $post->ID ); ?>
				<?php if ( has_post_thumbnail( $post->ID ) ): ?>
				    <?php
					    $image_id = get_post_thumbnail_id();
					    $full_image_url = wp_get_attachment_url( $image_id );
				    ?>
				    <?php if ( '' != get_the_post_thumbnail() ): ?>
						<figure>
						    <a class="swipebox" href="<?php echo esc_url( $full_image_url ); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'blog-page' ); ?>
						    </a>
						</figure>
				    <?php endif; ?>
				<?php endif; ?>

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

		    <footer class="footer-meta">

				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				    <?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'ascent' ) );
				    ?>
				    <?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'ascent' ) );
				    ?>

				    <?php if ( ($categories_list && ascent_categorized_blog()) || ($tags_list) ): ?>

					    <div class="cat-tag-meta-wrap">
							<?php if ( $categories_list && ascent_categorized_blog() ) :?>
							    <span class="cats-meta"><?php printf( __( '<i class="fas fa-folder"></i> %1$s', 'ascent' ), $categories_list ); ?></span>
							<?php endif; ?>
							<?php if ( $tags_list ) : ?>
							    <span class="tags-meta"><?php printf( __( '<i class="fas fa-tags"></i> %1$s', 'ascent' ), $tags_list ); ?></span>
							<?php endif; ?>
					    </div>
				    <?php endif; ?>
				<?php endif; // End if 'post' == get_post_type() ?>

		    </footer><!-- .entry-meta -->

		    <?php ascent_entry_footer_after(); ?>

		</div><!--.post-content-wrap-->
    </div><!--.row-->

    <?php ascent_entry_bottom(); ?>

</article><!-- #post-## -->
