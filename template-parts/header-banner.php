<?php
/**
 * Common Header Banner.
 */
 $home_slider_video_height = '';
 $hm_v_height = ascent_get_options('asc_home_slider_video_height');

 if(!empty($hm_v_height)) {
     $home_slider_video_height = 'height: '.$hm_v_height.'px' ;
 }

?>
<?php

$enable_home_slider = ascent_get_options('asc_home_page_slider');

?>
<?php if (($enable_home_slider == 1) && is_front_page()): ?>
<?php $home_slider_array = ascent_home_slider();?>
    <div id="home-slider" class="">
        <div class="main-owl-carousel owl-carousel owl-theme">
        <?php $enable_slider_overaly = (ascent_get_options('asc_enable_slider_overlay_bg', '')) ? 'bg-overlay' : ' default-bg'; ?>
        <?php foreach ($home_slider_array as $home_slider_item => $home_slider_fields): ?>
        <?php

        $new_home_slider_image = $home_slider_fields['image'];

        $new_home_slider_video = $home_slider_fields['video'];

        $home_slider_image = ascent_get_options($new_home_slider_image);
        $home_slider_video = ascent_get_options($new_home_slider_video);

        $home_page_slider_type = ($home_slider_video) ? 'video_type' : 'image_type';

        $new_home_slider_description = $home_slider_fields['description'];
        $home_slider_description = ascent_get_options($new_home_slider_description);
        ?>
            <?php if ($home_slider_image || $home_slider_video): ?>
                <div class="item <?php echo esc_attr($home_page_slider_type); ?>">
                    <?php if($home_page_slider_type == 'video_type'): ?>
                        <?php
                            $video_url = $home_slider_video;
                            if(ascent_check_video_type($video_url) == 'youtube') {
                                $embed_video_url = ascent_generate_youtube_embed_url($video_url);
                            } elseif(ascent_check_video_type($video_url) == 'vimeo') {
                                $embed_video_url = ascent_generate_vimeo_embed_url($video_url);
                            } else {
                                $embed_video_url = '';
                            }
                        ?>
                        <?php if(!empty($embed_video_url)): ?>
                            <iframe class="video-frame" src="<?php echo esc_url($embed_video_url); ?>" style="<?php echo esc_attr($home_slider_video_height); ?>"></iframe>
                        <?php else: ?>
                            <h2 class="text-center video-frame"><br><br><br> <?php echo esc_html__('Please provide valid video URL.', 'ascent'); ?></h2>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="<?php echo esc_attr($enable_slider_overaly); ?>"></div>
                        <img src="<?php echo esc_url($home_slider_image); ?>" class="gallery-post-single" alt="Slide"/>
                    <?php endif; ?>

                    <div class="content-wrapper clearfix">
                        <div class="container">
                            <div class="slide-content text-center clearfix">
                                <?php echo $home_slider_description; ?>
                            </div>
                        </div>
                    </div>
                </div><!--.item 1-->
            <?php endif; ?>
        <?php endforeach; ?>
        </div><!--.main-owl-carousel-->
    </div><!--.home-carousel-->
<?php else: ?>
    <?php
    $static_header_banner_image = ascent_get_options('asc_static_header_banner_image');

     if ($static_header_banner_image): ?>
        <div id="banner">
          <?php if ( get_header_image() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img class="site-banner" src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            </a>
          <?php else: ?>
               <img src="<?php echo esc_url(ASCENT_THEME_URI.'includes/images/banner.jpg'); ?>" alt="<?php bloginfo('name'); ?>-Banner">
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
