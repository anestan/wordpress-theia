<?php

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

//add_action( 'admin_init', 'disableCommentsOnBackend' );

function hideCommentsOnFrontend() {
	add_filter( 'comments_open', '__return_false', 20, 2 );
	add_filter( 'pings_open', '__return_false', 20, 2 );
}

//add_action( 'after_setup_theme', 'hideCommentsOnFrontend' );

function hideExistingComments() {
	add_filter( 'comments_array', '__return_empty_array', 10, 2 );
}

//add_action( 'after_setup_theme', 'hideExistingComments' );

function removeCommentsPageOnMenu() {
	remove_menu_page( 'edit-comments.php' );
}

//add_action( 'admin_menu', 'removeCommentsPageOnMenu' );

function removeCommentLinksFromAdminBar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}

//add_action( 'init', 'removeCommentLinksFromAdminBar' );
