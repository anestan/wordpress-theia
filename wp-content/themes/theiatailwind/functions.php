<?php

if ( ! defined( 'DISABLE_COMMENTS' ) ) {
	define( 'DISABLE_COMMENTS', false );
}

require get_stylesheet_directory() . '/inc/helpers.php';

if ( class_exists( 'WooCommerce' ) ) {
	require get_stylesheet_directory() . '/inc/woocommerce.php';

	function sf_child_theme_dequeue_style() {
		wp_dequeue_style( 'storefront-style' );
		wp_dequeue_style( 'storefront-woocommerce-style' );
	}

	add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );
}

function setupTheme() {
	add_theme_support( 'custom-logo' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( [
		'menu-1' => 'Menu 1'
	] );
}

add_action( 'after_setup_theme', 'setupTheme' );

function enqueueScripts() {
	$mix_manifest = (array) json_decode( file_get_contents( __DIR__ . '/mix-manifest.json' ) );

	wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . $mix_manifest['/style.css'] );
	wp_enqueue_style( 'app-css', get_stylesheet_directory_uri() . $mix_manifest['/public/css/app.css'] );
	wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . $mix_manifest['/public/js/app.js'], [], false, true );

	wp_localize_script( 'app-js', 'wp_obj', [
		'wp_nonce' => wp_create_nonce( date( 'YmdHis' ) ),
	] );
}

add_action( 'wp_enqueue_scripts', 'enqueueScripts', 10000 );

function modifyLoginPage() {
	?>
    <style type="text/css">
        body {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/public/images/admin-bg.jpg) !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-position: bottom left !important;
        }

        #login h1 a {
            background-color: #ffffff;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/public/images/admin-logo.png) !important;
            background-size: auto;
            margin: 0;
            width: 100%;
        }
    </style>
	<?php
}

add_action( 'login_enqueue_scripts', 'modifyLoginPage' );

function showAdminBar() {
	add_filter( 'show_admin_bar', '__return_false' );
}

add_action( 'after_setup_theme', 'showAdminBar' );

function insertBodyClass( $classes ) {
	$classes[] = '';

	if ( is_page( 'Contact' ) ) {
		$classes[] = 'contact';
	}

	return $classes;
}

add_filter( 'body_class', 'insertBodyClass' );

function insertMenuActiveClass( $classes ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'insertMenuActiveClass', 10, 2 );

if ( DISABLE_COMMENTS ) {
	function disableCommentsOnBackend() {
		global $pagenow;

		if ( $pagenow === 'edit-comments.php' ) {
			wp_redirect( admin_url() );
			exit;
		}

		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}

	add_action( 'admin_init', 'disableCommentsOnBackend' );

	function hideCommentsOnFrontend() {
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );
	}

	add_action( 'after_setup_theme', 'hideCommentsOnFrontend' );

	function hideExistingComments() {
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );
	}

	add_action( 'after_setup_theme', 'hideExistingComments' );

	function removeCommentsPageOnMenu() {
		remove_menu_page( 'edit-comments.php' );
	}

	add_action( 'admin_menu', 'removeCommentsPageOnMenu' );

	function removeCommentLinksFromAdminBar() {
		if ( is_admin_bar_showing() ) {
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}

	add_action( 'init', 'removeCommentLinksFromAdminBar' );
}
