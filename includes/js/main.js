jQuery(document).ready(function() {

    /* Click search box appear */
    jQuery('body').on('click', '#header-search-button', function(e) {
         e.stopPropagation();
        jQuery(this).parents().find('.header-search-form-wrap:first').slideToggle(200);
    });
    jQuery('body .header-search-form-wrap').click(function(e){
       e.stopPropagation();
    });
    jQuery('body').click(function(e){
       jQuery('.header-search-form-wrap').fadeOut(200);
    });
    var setupHeaderSearchform = function() {
        var headerSearchFormTopPosition = jQuery('.header-top').outerHeight() + jQuery('.header-bottom').outerHeight();
        jQuery('.header-search-form-wrap').css({
            'top': headerSearchFormTopPosition + 'px'
        });
    };
    setupHeaderSearchform();
    jQuery(window).on('load scroll resize', function() {
        setupHeaderSearchform();
    });

    /* Site Main Menu animation */
    if (jQuery(window).width() >= '751') {
        jQuery('.header-bottom nav.main-menu li').hover(function() {
            jQuery(this).children('ul').stop(true, true).slideDown(200);
        }, function() {
            jQuery(this).children('ul').stop(true, true).slideUp(200);
        });
    }

    jQuery('.header-bottom nav.main-menu li ul li a').hover(function() {
        jQuery(this).stop(true, true).velocity({
            paddingLeft: "23px"
        }, 150);
    }, function() {
        jQuery(this).stop(true, true).velocity({
            paddingLeft: "20px"
        }, 150);
    });

    /*  MeanMenu Responsive Nav */
    if (jQuery().meanmenu) {
        jQuery('nav.main-menu').meanmenu({
            meanMenuClose: '<i class="fa fa-times"></i>',
            meanExpand: "+",
            meanContract: "-",
            meanMenuContainer: '#responsive-menu-container',
            meanScreenWidth: "767",
            meanRemoveAttrs: true
        });
    }

    /* Scroll to Top */
    jQuery(function() {
        if (jQuery('a#scroll-top').length) {
            jQuery(window).scroll(function() {
                if (jQuery(this).scrollTop() > 250) {
                    jQuery('a#scroll-top').fadeIn();
                } else {
                    jQuery('a#scroll-top').fadeOut();
                }
            });
            jQuery('a#scroll-top').on('click', function(event) {
                event.preventDefault();
                jQuery('html, body').velocity("scroll", {
                    duration: 750,
                    easing: "swing"
                });
            });
        }
    });


    /* Owl carousel */
    if (jQuery('#home-slider .main-owl-carousel').length) {
        jQuery("#home-slider .main-owl-carousel").owlCarousel({
          items: 1,
          margin: 0,
          nav: (home_slider_nav) ? true : false,
          dots: (home_slider_pagination) ? true : false,
          singleItem: true,
          loop: true,
          autoplay: true,
          autoHeight:true,
        });
    }

}); //End jQuery
