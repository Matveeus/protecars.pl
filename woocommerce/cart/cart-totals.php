<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<table cellspacing="0" class="shop_table shop_table_responsive cart-totals-table">

		<tr class="cart-subtotal">
			<th>Razem:</th>
			<td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

        <?php if (count(WC()->cart->get_coupons()) === 0): ?>
        <tr class="cart-discount">
            <th>Zniżka:</th>
            <td><span class="woocommerce-Price-amount amount"><bdi>0&nbsp;<span class="woocommerce-Price-currencySymbol">zł</span></bdi></span></td>
        </tr>
        <?php else: ?>
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <th>Zniżka:</th>
                    <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ( WC()->cart->needs_shipping() ) : ?>

            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

            <tr class="woocommerce-shipping-totals shipping">
                <th>Dostawa:</th>
                <td data-title="Wysyłka"><?php echo WC()->cart->show_shipping() ? WC()->cart->get_cart_shipping_total() : '&#8212;'; ?></td>
            </tr>

            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
						<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total">
			<th>Do zapłaty</th>
			<td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>


        <div class="under-order-total">
<!--            --><?php //if ( wc_coupons_enabled() ): ?>
<!--                <div class="coupon-block">-->
<!--                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Kupon rabatowy" />-->
<!--                    <button type="submit" class="button" name="apply_coupon" value="--><?php //esc_attr_e( 'Apply coupon', 'woocommerce' ); ?><!--">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">-->
<!--                        <rect width="45" height="45" rx="5" fill="#022237"/>-->
<!--                        <g clip-path="url(#clip0_246_408)">-->
<!--                            <path d="M9.27431 24.3641C8.93304 24.0551 8.90655 23.528 9.21532 23.1867C9.52431 22.8452 10.0515 22.819 10.3929 23.1277L17.9736 30.0016L34.9142 12.2596C35.2323 11.9254 35.761 11.9121 36.0952 12.2302C36.4295 12.5481 36.4427 13.0768 36.1248 13.4111L18.6221 31.742L18.6209 31.7409C18.3102 32.0677 17.7937 32.0888 17.4573 31.7845L9.27431 24.3641Z" fill="white"/>-->
<!--                        </g>-->
<!--                        <defs>-->
<!--                            <clipPath id="clip0_246_408">-->
<!--                                <rect width="27.3549" height="20" fill="white" transform="translate(9 12)"/>-->
<!--                            </clipPath>-->
<!--                        </defs>-->
<!--                        </svg>-->
<!--                    </button>-->
<!--                </div>-->
<!--                --><?php //do_action( 'woocommerce_cart_coupon' ); ?>
<!--            --><?php //endif; ?>

            <div class="wc-proceed-to-checkout">
                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
            </div>
        </div>



	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
