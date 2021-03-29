<?php

function generateCustomMenu( $location ) {
	return wp_get_nav_menu_items( get_nav_menu_locations()[ $location ] );
}

function getCustomLogo() {
	return wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
}
