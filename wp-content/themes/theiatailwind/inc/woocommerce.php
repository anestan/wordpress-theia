<?php

function removeRelatedProducts() {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

add_action( 'init', 'removeRelatedProducts' );

function removeStorefrontBreadcrumbs() {
	remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}

add_action( 'init', 'removeStorefrontBreadcrumbs' );

function removeProductMeta() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

add_action( 'init', 'removeProductMeta' );

function redirectToCheckoutOnAddToCart(): string {
	return wc_get_checkout_url();
}

add_filter( 'woocommerce_add_to_cart_redirect', 'redirectToCheckoutOnAddToCart' );

function hideNotifications() {
	add_filter( 'wc_add_to_cart_message_html', '__return_true' );
}

add_action( 'init', 'hideNotifications' );
