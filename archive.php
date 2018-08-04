<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ascent
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-9">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>	
	<div class="content-padder">
		
	    <?php if ( have_posts() ) : ?>
    
		<header class="page-header">
		    <h1 class="page-title">
		    <?php
			if ( is_category() ) :
			    printf( __ ('Category: ', 'ascent')) . single_cat_title();

			elseif ( is_tag() ) :
			    printf( __ ('Tag: ', 'ascent')) . single_tag_title();

			elseif ( is_author() ) :
			    /* Queue the first post, that way we know
			     * what author we're dealing with (if that is the case).
			    */
			    the_post();
			    printf( __( 'Author: %s', 'ascent' ), '<span class="author vcard">' . get_the_author() . '</span>' );
			    /* Since we called the_post() above, we need to
			     * rewind the loop back to the beginning that way
			     * we can run the loop properly, in full.
			     */
			    rewind_posts();

			elseif ( is_day() ) :
			    printf( __( 'Day: %s', 'ascent' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
			    printf( __( 'Month: %s', 'ascent' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
			    printf( __( 'Year: %s', 'ascent' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			    _e( 'Asides', 'ascent' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			    _e( 'Images', 'ascent');

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			    _e( 'Videos', 'ascent' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			    _e( 'Quotes', 'ascent' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			    _e( 'Links', 'ascent' );

			else :
			    _e( 'Archives', 'ascent' );

			endif;
		    ?>
		    </h1>
		    <?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
			    printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		    ?>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

		    <?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );
		    ?>

		<?php endwhile; ?>

		<?php ascent_content_nav( 'nav-below' ); ?>
    
	    <?php else : ?>
    
		<?php get_template_part( 'no-results', 'archive' ); ?>
    
	    <?php endif; ?>
    
	</div><!-- .content-padder -->

    </div>
    
    <div class="col-sm-12 col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
