<?php

if ( ! defined( 'DISABLE_COMMENTS' ) ) {
	define( 'DISABLE_COMMENTS', false );
}

define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyDp6zzKdaW3XaW2SZSp_IeOhxDslNolOAk' );
define( 'GOOGLE_RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI' );
define( 'GOOGLE_RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe' );

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
	wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . $mix_manifest['/public/js/app.js'], [], false,
		true );

	wp_localize_script( 'app-js', 'wp_obj', [
		'wp_nonce'                  => wp_create_nonce( 'wp-nonce' ),
		'wp_ajax'                   => admin_url( 'admin-ajax.php' ),
		'wp_action'                 => 'sendContactFormApplication',
		'google_maps_api_key'       => GOOGLE_MAPS_API_KEY,
		'google_recaptcha_site_key' => GOOGLE_RECAPTCHA_SITE_KEY,
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

function sendContactFormApplication() {
	if ( ! wp_verify_nonce( $_POST['wp_nonce'], 'wp-nonce' ) ) {
		echo json_encode( [ 'status' => 0, 'message' => 'Invalid nonce.' ] );
		die();
	}

	if ( ! validateRecaptcha( $_POST['g_recaptcha_response'] ) ) {
		echo json_encode( [ 'status' => 2, 'message' => 'Failed to validate recaptcha.' ] );
		die();
	}

	$to      = [];
	$to[]    = get_option( 'admin_email' );
	$subject = 'Contact Form Application';
	$headers = '';

	if ( count( $_FILES ) ) {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		$attachment_id = media_handle_upload( 'photo_id', 0 );
		$attachments   = [ wp_get_attachment_url( $attachment_id ) ];
	} else {
		$attachments = [];
	}

	ob_start();

	echo '
        <p>Name: ' . $_POST["name"] . '</p>
        <p>Phone: ' . $_POST["phone"] . '</p>
        <p>Email: ' . $_POST["email"] . '</p>
        <p>Date: ' . $_POST["date"] . '</p>
        <p>Message: ' . $_POST["message"] . '</p>
        <p>Tnc: ' . $_POST["tnc"] . '</p>
        ';

	$message = ob_get_contents();

	ob_end_clean();

	$mail = wp_mail( $to, $subject, $message, $headers, $attachments );

	if ( ! $mail ) {
		echo json_encode( [ 'status' => 3, 'message' => 'Failed to send application.' ] );
		die();
	}

	echo json_encode( [ 'status' => 1, 'message' => 'Application has been sent.' ] );
	die();
}

function sendContactFormApplicationContentType() {
	return 'text/html';
}

add_action( 'wp_ajax_sendContactFormApplication', 'sendContactFormApplication' );
add_action( 'wp_ajax_nopriv_sendContactFormApplication', 'sendContactFormApplication' );
add_filter( 'wp_mail_content_type', 'sendContactFormApplicationContentType' );
