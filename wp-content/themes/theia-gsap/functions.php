<?php

function enqueueScripts() {
    $mix_manifest = (array) json_decode( file_get_contents( __DIR__ . '/mix-manifest.json' ) );
    wp_enqueue_style( 'theme_style', get_stylesheet_directory_uri() . $mix_manifest['/style.css'] );
    wp_enqueue_style( 'app_style', get_stylesheet_directory_uri() . $mix_manifest['/public/css/app.css'] );
    wp_enqueue_script( 'app_script', get_stylesheet_directory_uri() . $mix_manifest['/public/js/app.js'], [], false, true );

    if ( is_page( 'meet-the-freds' ) ) {
        wp_enqueue_style( 'meet_the_freds_style',
            get_stylesheet_directory_uri() . $mix_manifest['/public/css/meet-the-freds.css'] );
        wp_enqueue_script( 'meet_the_freds_script',
            get_stylesheet_directory_uri() . $mix_manifest['/public/js/meet-the-freds.js'], [], false, true
        );
    }

    if ( is_page( 'creative-process' ) ) {
        wp_enqueue_style( 'creative_process_style',
            get_stylesheet_directory_uri() . $mix_manifest['/public/css/creative-process.css'] );
        wp_enqueue_script( 'creative_process_script',
            get_stylesheet_directory_uri() . $mix_manifest['/public/js/creative-process.js'], [], false, true
        );
    }

    if ( is_page( 'position-parameter-visualiser' ) ) {
        wp_enqueue_style( 'position_parameter_visualiser_style',
            get_stylesheet_directory_uri() . $mix_manifest['/public/css/position-parameter-visualiser.css'] );
        wp_enqueue_script( 'position_parameter_visualiser_script',
            get_stylesheet_directory_uri() . $mix_manifest['/public/js/position-parameter-visualiser.js'], [], false, true
        );
    }
}

add_action( 'wp_enqueue_scripts', 'enqueueScripts', 10000 );

function showAdminBar() {
    add_filter( 'show_admin_bar', '__return_false' );
}

add_action( 'after_setup_theme', 'showAdminBar' );

function switchTheme() {
    foreach ( [ 'Meet The Freds', 'Position Parameter Visualiser', 'Creative Process' ] as $page_title ) {
        $page = get_page_by_title( $page_title );

        $postarr = [
            'post_type'    => 'page',
            'post_title'   => $page_title,
            'post_content' => '',
            'post_status'  => 'publish',
        ];

        if ( ! isset( $page->ID ) ) {
            wp_insert_post( $postarr );
        }
    }
}

add_action( 'after_switch_theme', 'switchTheme' );
