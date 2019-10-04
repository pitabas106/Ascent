/**
 * Enable Swipebox- A touchable jQuery lightbox
 * @author Pitabas106
 */
jQuery(document).ready(function() {
    if (jQuery().swipebox) {
        jQuery("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").swipebox();
    }
}); //End jQuery
