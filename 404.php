<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Ascent
 * @since 1.0.0 
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
	<section class="content-padder error-404 not-found jumbotron text-center">
	    <header class="page-header">
		<h1 class="title large-text"><?php esc_html_e('404', 'ascent') ?></h1>
	    </header><!-- .page-header -->
	    <div class="page-content">
		<h2 class="entry-title"><?php esc_html__( 'Oops! Something went wrong here.', 'ascent' ); ?></h2>
		<p><?php esc_html_e( 'Nothing could be found at this location.', 'ascent' ); ?></p>
		<p><?php esc_html_e('Try going back to the', 'ascent'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><strong><?php esc_html_e('Homepage','ascent'); ?></strong></a> <?php esc_html_e('instead?', 'ascent') ?> </p>
	    </div><!-- .page-content -->
	</section><!-- .content-padder -->
    </div>

</div>
<?php get_footer(); ?>
