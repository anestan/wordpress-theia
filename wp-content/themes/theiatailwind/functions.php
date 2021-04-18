<?php

if ( class_exists( 'WooCommerce' ) ) {
	require get_stylesheet_directory() . '/inc/woocommerce.php';
}

function getNavMenuItems( $location ) {
	return wp_get_nav_menu_items( get_nav_menu_locations()[ $location ] );
}

function getCustomLogo() {
	return wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
}

function showAdminBar() {
	add_filter( 'show_admin_bar', '__return_false' );
}

add_action( 'after_setup_theme', 'showAdminBar' );

function printTemplate() {
	global $template;
	print_r( $template );
}

//add_action('wp_head', 'printTemplate');

function setupTheme() {
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	register_nav_menus( [
		'menu-1' => 'Menu 1'
	] );
}

add_action( 'after_setup_theme', 'setupTheme' );

function switchTheme() {
	foreach ( [ 'Carousels', 'Contact', 'How To', 'Mansory', 'Parallax Scrolltrigger' ] as $page_title ) {
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

function setupWidgets() {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		]
	);
}

add_action( 'widgets_init', 'setupWidgets' );

function enqueueScripts() {
	$mix_manifest = (array) json_decode( file_get_contents( __DIR__ . '/mix-manifest.json' ) );

	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . $mix_manifest['/style.css'] );

	wp_enqueue_style( 'app', get_stylesheet_directory_uri() . $mix_manifest['/public/css/app.css'] );
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() . $mix_manifest['/public/js/app.js'], [], false,
		true );

	if ( is_page( 'carousels' ) ) {
		wp_enqueue_script( 'carousels', get_stylesheet_directory_uri() . $mix_manifest['/public/js/carousels.js'], [],
			false,
			true );
	}

	if ( is_page( 'contact' ) ) {
		wp_enqueue_script( 'google-maps', get_stylesheet_directory_uri() . $mix_manifest['/public/js/google-maps.js'],
			[],
			false,
			true );
		wp_localize_script( 'google-maps', 'wp_obj', [
			'google_maps_api_key' => GOOGLE_MAPS_API_KEY,
		] );

		wp_enqueue_script( 'contact-form', get_stylesheet_directory_uri() . $mix_manifest['/public/js/contact-form.js'],
			[],
			false,
			true );
		wp_localize_script( 'contact-form', 'wp_obj', [
			'wp_nonce'                  => wp_create_nonce( 'wp-nonce' ),
			'wp_ajax'                   => admin_url( 'admin-ajax.php' ),
			'wp_action'                 => 'contactFormMail',
			'google_recaptcha_site_key' => GOOGLE_RECAPTCHA_SITE_KEY,
		] );
	}

	if ( is_page( 'parallax-scrolltrigger' ) ) {
		wp_enqueue_script( 'gsap-3.6.2', get_stylesheet_directory_uri() . '/vendor/js/gsap-3.6.2.min.js', [],
			false,
			true );

		wp_enqueue_script( 'gsap-scrolltrigger-3.6.2',
			get_stylesheet_directory_uri() . '/vendor/js/gsap-scrolltrigger-3.6.2.min.js',
			[],
			false,
			true );

		wp_enqueue_style( 'parallax-scrolltrigger',
			get_stylesheet_directory_uri() . $mix_manifest['/public/css/parallax-scrolltrigger.css'] );
		wp_enqueue_script( 'parallax-scrolltrigger',
			get_stylesheet_directory_uri() . $mix_manifest['/public/js/parallax-scrolltrigger.js'], [],
			false,
			true );
	}
}

add_action( 'wp_enqueue_scripts', 'enqueueScripts', 10000 );

function dequeueScripts() {

}

add_action( 'wp_print_scripts', 'dequeueScripts', 100 );

function bodyClass( $classes ) {
	$classes[] = '';

	if ( is_page( 'Contact' ) ) {
		$classes[] = 'contact';
	}

	return $classes;
}

add_filter( 'body_class', 'bodyClass' );

function navMenuClass( $classes ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'navMenuClass', 10, 2 );

function enqueueLoginScripts() {
	?>
    <style type="text/css">
        body {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/public/imgs/admin-bg.jpg) !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-position: bottom left !important;
        }

        #login h1 a {
            background-color: #ffffff;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/public/imgs/admin-logo.png) !important;
            background-size: auto;
            margin: 0;
            width: 100%;
        }
    </style>
	<?php
}

add_action( 'login_enqueue_scripts', 'enqueueLoginScripts' );

function removeCommentsBackend() {
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

//add_action( 'admin_init', 'removeCommentsBackend' );

function removeCommentsFrontend() {
	add_filter( 'comments_open', '__return_false', 20, 2 );
	add_filter( 'pings_open', '__return_false', 20, 2 );
}

//add_action( 'after_setup_theme', 'removeCommentsFrontend' );

function removeCommentsExisting() {
	add_filter( 'comments_array', '__return_empty_array', 10, 2 );
}

//add_action( 'after_setup_theme', 'removeCommentsExisting' );

function removeCommentsSideMenu() {
	remove_menu_page( 'edit-comments.php' );
}

//add_action( 'admin_menu', 'removeCommentsSideMenu' );

function removeCommentsAdminBarMenu() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}

//add_action( 'init', 'removeCommentsAdminBarMenu' );

function validateRecaptcha( $g_recaptcha_response ) {
	if ( ! isset( $g_recaptcha_response ) ) {
		return false;
	}

	$siteverify = 'https://www.google.com/recaptcha/api/siteverify';
	$secret_key = GOOGLE_RECAPTCHA_SECRET_KEY;
	$response   = file_get_contents( $siteverify . '?secret=' . $secret_key . '&response=' . $g_recaptcha_response );
	$response   = json_decode( $response, true );

	return $response['success'];
}

function contactFormMail() {
	if ( ! wp_verify_nonce( $_POST['wp_nonce'], 'wp-nonce' ) ) {
		echo json_encode( [ 'status' => 0, 'message' => 'Invalid nonce.' ] );
		die();
	}

	if ( ! validateRecaptcha( $_POST['g_recaptcha_response'] ) ) {
		echo json_encode( [ 'status' => 2, 'message' => 'Failed to validate recaptcha.' ] );
		die();
	}

	$to   = [];
	$to[] = get_option( 'admin_email' );

	$subject = 'Contact Form Application';

	$headers   = [];
	$headers[] = 'From: ' . $_POST['name'] . ' <' . $_POST['email'] . '>';

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
        <p>Name: ' . $_POST['name'] . '</p>
        <p>Phone: ' . $_POST['phone'] . '</p>
        <p>Email: ' . $_POST['email'] . '</p>
        <p>Date: ' . $_POST['date'] . '</p>
        <p>Message: ' . $_POST['message'] . '</p>
        <p>Tnc: ' . $_POST['tnc'] . '</p>
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

add_action( 'wp_ajax_contactFormMail', 'contactFormMail' );
add_action( 'wp_ajax_nopriv_contactFormMail', 'contactFormMail' );

function contactFormMailContentType() {
	return 'text/html';
}

add_filter( 'wp_mail_content_type', 'contactFormMailContentType' );

function debugMailFailed( $wp_error ) {
	echo "<pre>" . print_r( $wp_error ) . "</pre>";
	die();
}

add_action( 'wp_mail_failed', 'debugMailFailed', 10, 1 );

function setPostsOrder($query)
{
	if ($query->is_admin) {

		if ($query->get('post_type') == 'customs') {
			$query->set('orderby', 'modified');
			$query->set('order', 'DESC');
		}
	}
	return $query;
}

//add_filter('pre_get_posts', 'setPostsOrder');
