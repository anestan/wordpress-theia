<?php

function wooCommerceAddThemeSupport() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

//add_action( 'after_setup_theme', 'wooCommerceAddThemeSupport' );

function wooCommerceGetSpecificStyles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	unset( $enqueue_styles['woocommerce-layout'] );
	unset( $enqueue_styles['woocommerce-smallscreen'] );

	return $enqueue_styles;
}

function wooCommerceEnqueueSpecificStyles() {
	add_filter( 'woocommerce_enqueue_styles', 'wooCommerceGetSpecificStyles' );
}

//add_action( 'after_setup_theme', 'wooCommerceEnqueueSpecificStyles' );

function wooCommerceEnqueueAllStyles() {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
}

//add_action( 'after_setup_theme', 'wooCommerceEnqueueAllStyles' );

function wooCommerceEditContentWrapperStart() {
	echo "<div class=''>";
}

function wooCommerceEditContentWrapperEnd() {
	echo "</div>";
}

//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//add_action( 'woocommerce_before_main_content', 'wooCommerceEditContentWrapperStart', 10 );
//add_action( 'woocommerce_after_main_content', 'wooCommerceEditContentWrapperEnd', 10 );

function wooCommerceRemoveRelatedProducts() {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

//add_action( 'init', 'wooCommerceRemoveRelatedProducts' );

function wooCommerceRemoveProductMeta() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

//add_action( 'init', 'wooCommerceRemoveProductMeta' );

function wooCommerceGetCheckoutUrl(): string {
	return wc_get_checkout_url();
}

function wooCommerceAddToCartRedirect() {
	add_filter( 'woocommerce_add_to_cart_redirect', 'wooCommerceGetCheckoutUrl' );
}

//add_action( 'init', 'wooCommerceAddToCartRedirect' );

function wooCommerceAddToCartMessage() {
	add_filter( 'wc_add_to_cart_message_html', '__return_false' );
}

//add_action( 'init', 'wooCommerceAddToCartMessage' );

function wooCommerceDequeueStorefrontStyles() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

//add_action( 'wp_enqueue_scripts', 'wooCommerceDequeueStorefrontStyles', 999 );

function wooCommerceRemoveStorefrontBreadcrumb() {
	remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}

//add_action( 'init', 'wooCommerceRemoveStorefrontBreadcrumb' );
