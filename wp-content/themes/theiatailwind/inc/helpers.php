<?php

function generateCustomMenu( $location ) {
	return wp_get_nav_menu_items( get_nav_menu_locations()[ $location ] );
}

function getCustomLogo() {
	return wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
}

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
