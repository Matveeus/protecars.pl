<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="container">

<?php
do_action( 'woocommerce_before_cart' ); ?>
<h1 class="page-title"><?php echo get_the_title(); ?></h1>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <thead>
        <tr>
            <th class="product-remove"></th>
            <th class="product-thumbnail"></th>
            <th class="product-name"></th>
            <th class="product-subtotal"></th>
        </tr>
        </thead>
        <tbody>
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                    <td class="product-remove">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"> <svg  class="close-button" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.707106 2.12816C0.316582 1.73763 0.320002 1.10105 0.710526 0.710526V0.710526C1.10105 0.320002 1.73764 0.316582 2.12816 0.707107L8.29289 6.87184C8.68342 7.26237 9.31658 7.26237 9.70711 6.87184L15.8718 0.707106C16.2624 0.316582 16.8989 0.320002 17.2895 0.710526V0.710526C17.68 1.10105 17.6834 1.73764 17.2929 2.12816L11.1282 8.29289C10.7376 8.68342 10.7376 9.31658 11.1282 9.70711L17.2929 15.8718C17.6834 16.2624 17.68 16.8989 17.2895 17.2895V17.2895C16.8989 17.68 16.2624 17.6834 15.8718 17.2929L9.70711 11.1282C9.31658 10.7376 8.68342 10.7376 8.29289 11.1282L2.12816 17.2929C1.73763 17.6834 1.10105 17.68 0.710526 17.2895V17.2895C0.320002 16.8989 0.316582 16.2624 0.707107 15.8718L6.87184 9.70711C7.26237 9.31658 7.26237 8.68342 6.87184 8.29289L0.707106 2.12816Z" fill="#AEAEAE"/>
            </svg></a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                        ?>
                    </td>

                    <td class="product-thumbnail product-thumbnail-block">
                        <div class="product-thumbnail-block-div">
                            <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                            if ( ! $product_permalink ) {
                                echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                            }
                            ?>
                        </div>
                    </td>

                    <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <?php
                        if ( ! $product_permalink ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                        } else {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="#" class="yith-wcqv-button" data-product_id="%s">%s</a>', $_product->get_id(), $_product->get_name() ), $cart_item, $cart_item_key ) );
                        }

                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                        // Meta data.
                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                        // Backorder notification.
                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                        }
                        ?>
                    </td>

                    <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>

        <tr>
            <td colspan="6" class="actions">

<!--                --><?php //if ( wc_coupons_enabled() ) { ?>
<!--                    <div class="coupon">-->
<!--                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Kod rabatowy" />-->
<!--                        <button type="submit" class="button" name="apply_coupon" value="--><?php //esc_attr_e( 'Apply coupon', 'woocommerce' ); ?><!--">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">-->
<!--                                <rect width="45" height="45" rx="5" fill="#022237"/>-->
<!--                                <g clip-path="url(#clip0_246_408)">-->
<!--                                    <path d="M9.27431 24.3641C8.93304 24.0551 8.90655 23.528 9.21532 23.1867C9.52431 22.8452 10.0515 22.819 10.3929 23.1277L17.9736 30.0016L34.9142 12.2596C35.2323 11.9254 35.761 11.9121 36.0952 12.2302C36.4295 12.5481 36.4427 13.0768 36.1248 13.4111L18.6221 31.742L18.6209 31.7409C18.3102 32.0677 17.7937 32.0888 17.4573 31.7845L9.27431 24.3641Z" fill="white"/>-->
<!--                                </g>-->
<!--                                <defs>-->
<!--                                    <clipPath id="clip0_246_408">-->
<!--                                        <rect width="27.3549" height="20" fill="white" transform="translate(9 12)"/>-->
<!--                                    </clipPath>-->
<!--                                </defs>-->
<!--                            </svg>-->
<!--                        </button>-->
<!--                        --><?php //do_action( 'woocommerce_cart_coupon' ); ?>
<!--                    </div>-->
<!--                --><?php //} ?>

                <?php if ( wc_coupons_enabled() ) { ?>
                    <div class="coupon">
                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                        <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"></button>
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                <?php } ?>

                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
            </td>
        </tr>

        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </tbody>
    </table>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

    <div class="addons-and-coupon">

        <?php get_template_part( 'template-parts/content', 'cart-add-ons' ); ?>

        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

        <div class="cart-collaterals animate__animated wow animate__fadeIn">

            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action( 'woocommerce_cart_collaterals' ); ?>

        </div>
    </div>

<?php do_action( 'woocommerce_after_cart' ); ?>
