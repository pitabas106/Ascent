<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ascent
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
	<section class="content-padder error-404 not-found jumbotron text-center">
	    <header class="page-header">
		<h1 class="title large-text"><?php _e('404', 'ascent') ?></h1>
	    </header><!-- .page-header -->
	    <div class="page-content">
		<h2 class="entry-title"><?php _e( 'Oops! Something went wrong here.', 'ascent' ); ?></h2>
		<p><?php _e( 'Nothing could be found at this location.', 'ascent' ); ?></p>
		<p><?php _e('Try going back to the', 'ascent') ?> <a href="<?php echo esc_url(home_url('/')); ?>"><strong><?php _e('Homepage','ascent'); ?></strong></a> <?php _e('instead?', 'ascent') ?> </p>
	    </div><!-- .page-content -->
	</section><!-- .content-padder -->
    </div>

</div>
<?php get_footer(); ?>
