<?php //if( get_setting( 'search_disable', false ) ) return; ?>
<div id="header-search-form-wrap" class="header-search-form-wrap">
   <div class="container">
      <form role="search" method="get" class="header-search-form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
         <div class="control-group">
            <i class="fa fa-search"></i>  
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'ascent' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'ascent' ); ?>">
            <button class="search" type="submit"><i class="icon-search"></i></button>
         </div>
      </form>
   </div>
</div>
