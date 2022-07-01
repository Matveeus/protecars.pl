<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$label = '';
$text = 'Kupić';
if ( $product->get_type() == 'simple' && $product->is_purchasable() && $product->is_in_stock() ) {
    if ( WC()->cart && ! WC()->cart->is_empty() ) {
        foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
            $_product = $values['data'];
            if ( get_the_ID() == $_product->get_id() ) {
                $label = 'added';
                $text = 'Dodany';
                break;
            }
        }
    }
}

echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="pc-button %s archive-product-buy-button %s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr($label ?? ''),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $text )
	),
	$product,
	$args
);
