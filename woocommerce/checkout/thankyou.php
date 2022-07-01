<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="entry-content">
    <div class="container">
        <svg class="success-thanks" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M50 0C77.6146 0 100 22.3854 100 50C100 77.6146 77.6146 100 50 100C22.3854 100 0 77.6146 0 50C0 22.3854 22.3854 0 50 0ZM27.8792 51.3302C28.55 47.4406 32.9896 45.275 36.4927 47.3823C36.8104 47.5719 37.1135 47.7969 37.3958 48.0552L37.4229 48.0812C38.9948 49.5875 40.7562 51.1552 42.5021 52.7094L44 54.0542L61.774 35.4104C62.8354 34.299 63.6115 33.5802 65.2042 33.2219C70.6573 32.0187 74.4917 38.6844 70.6271 42.7583L48.475 66.0062C46.3885 68.2323 42.6594 68.4354 40.4167 66.3094C39.1312 65.1156 37.7333 63.901 36.3198 62.675C33.8719 60.5479 31.375 58.3781 29.3396 56.2302C28.1177 55.0094 27.5906 53.0104 27.8792 51.3302Z" fill="#194908"/>
        </svg>
        <p class="thank-you-text">
            Dziękujemy za okazane zaufanie. Twoje zamówienie zostało złożone pomyślnie.<br>
            Szczegóły zamówienia wysłane do Ciebie na e-mail (Sprawdź również folder spam)<br>
            <?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
            <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
        </p>
    </div>
</div>



