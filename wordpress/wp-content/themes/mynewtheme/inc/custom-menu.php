<?php
function mynewtheme_custom_menu() {
    // register_nav_menu('top-menu', 'Primary Menu');
    // register_nav_menu('footer-menu-1', 'Footer Menu 1');
    // register_nav_menu('footer-menu-2', 'Footer Menu 2');

    // or
    // register_nav_menu('top-menu', __('Primary Menu', 'mytheme70'));
    // register_nav_menu('footer-menu-1', __('Footer Menu 1', 'mytheme70'));
    // register_nav_menu('footer-menu-2', __('Footer Menu 2', 'mytheme70'));

    // or
    register_nav_menus(array(
        'top-menu'      => __('Primary Menu', 'Mynewtheme'),
        'footer-menu-1' => __('Footer Menu 1', 'Mynewtheme'),
        'footer-menu-2' => __('Footer Menu 2', 'Mynewtheme'),
    ));

}
add_action('after_setup_theme', 'mynewtheme_custom_menu');