<?php

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function sf_child_theme_dequeue_style() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

function removeRelatedProducts() {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

//add_action( 'init', 'removeRelatedProducts' );

function removeStorefrontBreadcrumbs() {
	remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}

//add_action( 'init', 'removeStorefrontBreadcrumbs' );

function removeProductMeta() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

//add_action( 'init', 'removeProductMeta' );

function redirectToCheckoutOnAddToCart(): string {
	return wc_get_checkout_url();
}

add_filter( 'woocommerce_add_to_cart_redirect', 'redirectToCheckoutOnAddToCart' );

function hideNotifications() {
	add_filter( 'wc_add_to_cart_message_html', '__return_true' );
}

//add_action( 'init', 'hideNotifications' );
