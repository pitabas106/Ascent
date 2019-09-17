<?php
/**
 * Template for Header Menu
 *
 * @package     Ascent
 * @since       3.7.0
 */
?>

<nav class="main-menu">
    <?php
      wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => 'header-nav clearfix',
      ));
    ?>
</nav>
<div id="responsive-menu-container"></div>