<?php

function enqueueScripts() {
    $mix_manifest = (array) json_decode( file_get_contents( __DIR__ . '/mix-manifest.json' ) );
    wp_enqueue_style( 'theme_style', get_stylesheet_directory_uri() . $mix_manifest['/style.css'] );
    wp_enqueue_style( 'app_style', get_stylesheet_directory_uri() . $mix_manifest['/public/css/app.css'] );
    wp_enqueue_script( 'app_script', get_stylesheet_directory_uri() . $mix_manifest['/public/js/app.js'], [], false, true );
}

add_action( 'wp_enqueue_scripts', 'enqueueScripts', 10000 );

function showAdminBar() {
    add_filter( 'show_admin_bar', '__return_false' );
}

add_action( 'after_setup_theme', 'showAdminBar' );
