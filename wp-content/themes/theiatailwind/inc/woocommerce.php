<?php

function addWoocommerceSupport() {
	add_theme_support( 'woocommerce', [
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

		'product_grid' => [
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		],
	] );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'addWoocommerceSupport' );

function dequeueWooCommerceStyles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	unset( $enqueue_styles['woocommerce-layout'] );
	unset( $enqueue_styles['woocommerce-smallscreen'] );

	return $enqueue_styles;
}

function disableSpecificWooCommerceStyle() {
	add_filter( 'woocommerce_enqueue_styles', 'dequeueWooCommerceStyles' );
}

//add_action( 'after_setup_theme', 'disableSpecificWooCommerceStyle' );

function disableAllWooCommerceStyle() {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
}

//add_action( 'after_setup_theme', 'disableAllWooCommerceStyle' );

function wooCommerceOutputContentWrapper() {
	echo "<div class=''>";
}

function wooCommerceOutputContentWrapperEnd() {
	echo "</div>";
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'wooCommerceOutputContentWrapper', 10 );
add_action( 'woocommerce_after_main_content', 'wooCommerceOutputContentWrapperEnd', 10 );

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

function getCheckoutURL() {
	return wc_get_checkout_url();
}

function redirectToCheckoutOnAddToCart() {
	add_filter( 'woocommerce_add_to_cart_redirect', 'getCheckoutURL' );
}

//add_action( 'init', 'redirectToCheckoutOnAddToCart' );

function hideNotifications() {
	add_filter( 'wc_add_to_cart_message_html', '__return_true' );
}

//add_action( 'init', 'hideNotifications' );
