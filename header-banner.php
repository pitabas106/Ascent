<?php
/**
 * Common Header Banner.
 */
 $home_slider_video_height = '';
 $hm_v_height = of_get_option('home_slider_video_height');
 if(!empty($hm_v_height)) {
     $home_slider_video_height = 'height: '.$hm_v_height.'px' ;
 }

?>
<?php $enable_home_slider = of_get_option('home_page_slider'); ?>
<?php if (($enable_home_slider == 1) && is_front_page()): ?>
<?php $home_slider_array = ascent_home_slider();?>
    <div id="home-slider" class="">
    	<div class="main-owl-carousel owl-carousel owl-theme">
    	<?php $enable_slider_overaly = (of_get_option('slider_overlay_bg')) ? 'bg-overlay' : ' default-bg'; ?>
    	<?php foreach ($home_slider_array as $home_slider_item => $home_slider_fields): ?>
    	    <?php if (of_get_option($home_slider_fields['image']) || of_get_option($home_slider_fields['video'])): ?>
                <?php $home_page_slider_type = of_get_option($home_slider_fields['slider_type']); ?>
        	    <div class="item <?php echo $home_page_slider_type; ?>">
                    <?php if($home_page_slider_type == 'video_type'): ?>
                        <?php
                            $video_url = of_get_option($home_slider_fields['video']);
                            if(ascent_check_video_type($video_url) == 'youtube') {
                                $embed_video_url = ascent_generate_youtube_embed_url($video_url);
                            } elseif(ascent_check_video_type($video_url) == 'vimeo') {
                                $embed_video_url = ascent_generate_vimeo_embed_url($video_url);
                            } else {
                                $embed_video_url = '';
                            }
                        ?>
                        <?php if(!empty($embed_video_url)): ?>
                            <iframe class="video-frame" src="<?php echo $embed_video_url; ?>" style="<?php echo $home_slider_video_height; ?>"></iframe>
                        <?php else: ?>
                            <h2 class="text-center video-frame"><br><br><br> Please Provide Valid Video URL.</h2>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="<?php echo $enable_slider_overaly; ?>"></div>
                        <img src="<?php echo of_get_option($home_slider_fields['image']); ?>" class="gallery-post-single" alt="Slide"/>
                    <?php endif; ?>

            		<div class="content-wrapper clearfix">
            		    <div class="container">
                			<div class="slide-content text-center clearfix">
                			    <?php echo of_get_option($home_slider_fields['description']); ?>
                			</div>
            		    </div>
            		</div>
        	    </div><!--.item 1-->
    	    <?php endif; ?>
    	<?php endforeach; ?>
    	</div><!--.main-owl-carousel-->
    </div><!--.home-carousel-->
<?php else: ?>
    <?php if (of_get_option('static_header_banner_image')): ?>
        <div id="banner">
            <?php if (of_get_option('default_banner_image')): ?>
    	       <img src="<?php echo of_get_option('default_banner_image'); ?>" alt="<?php bloginfo('name'); ?>-Banner">
            <?php else: ?>
    	       <img src="<?php echo get_template_directory_uri().'/includes/images/banner.jpg'?>" alt="<?php bloginfo('name'); ?>-Banner">
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
