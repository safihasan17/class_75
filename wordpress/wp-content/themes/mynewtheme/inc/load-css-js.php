<?php

function add_css_js(){
    $dir = get_template_directory_uri();

    // Google Fonts / Icon fonts / CDN libraries
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap', array(), null );
    wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.15.4/css/all.css', array(), '5.15.4' );
    wp_enqueue_style( 'bootstrap-icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css', array(), '1.4.1' );
    wp_enqueue_style( 'animate-css', '//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1' );

    // Local library stylesheets (theme's own /lib folder)
    wp_enqueue_style( 'owlcarousel', $dir . '/lib/owlcarousel/assets/owl.carousel.min.css', array(), null );
    wp_enqueue_style( 'lightbox', $dir . '/lib/lightbox/css/lightbox.min.css', array(), null );

    // Theme stylesheets
    wp_enqueue_style( 'bootstrap', $dir . '/assets/css/bootstrap.min.css', array(), null );
    wp_enqueue_style( 'main-style', $dir . '/assets/css/style.css', array( 'bootstrap' ), null, 'all' );
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), null );

    // JS libraries (jQuery already registered by WordPress core)
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.0.0', true );
    wp_enqueue_script( 'wow', $dir . '/lib/wow/wow.min.js', array(), null, true );
    wp_enqueue_script( 'easing', $dir . '/lib/easing/easing.min.js', array(), null, true );
    wp_enqueue_script( 'waypoints', $dir . '/lib/waypoints/waypoints.min.js', array(), null, true );
    wp_enqueue_script( 'counterup', $dir . '/lib/counterup/counterup.min.js', array( 'waypoints' ), null, true );
    wp_enqueue_script( 'owlcarousel-js', $dir . '/lib/owlcarousel/owl.carousel.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'lightbox-js', $dir . '/lib/lightbox/js/lightbox.min.js', array(), null, true );

    // Theme's own script (loads last, depends on the above)
    wp_enqueue_script( 'main-js', $dir . '/assets/js/main.js', array( 'jquery', 'bootstrap-bundle', 'wow', 'owlcarousel-js' ), null, true );
}

add_action( "wp_enqueue_scripts", "add_css_js");
