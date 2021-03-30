<?php

function generateCustomMenu( $location ) {
	return wp_get_nav_menu_items( get_nav_menu_locations()[ $location ] );
}

function getCustomLogo() {
	return wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
}

//if ( ! recaptcha_validate( $_POST['token'] ) ) {
//	http_response_code( 400 );
//	echo "Spam check fails. Please contact us.";
//
//	exit;
//}
//
//function recaptcha_validate( $token ) {
//	if ( ! isset( $token ) ) {
//		return false;
//	}
//
//	$siteverify = 'https://www.google.com/recaptcha/api/siteverify';
//	$secret     = GOOGLE_RECAPTCHA_SECRET_KEY;
//	$response   = file_get_contents( $siteverify . '?secret=' . $secret . '&response=' . $token );
//	$response   = json_decode( $response, true );
//
//	return $response['success'];
//}
