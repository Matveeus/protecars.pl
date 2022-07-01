<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$gallery_products = $product->get_gallery_image_ids();
$product_thumbnail = $product->get_image_id();
$title = $product->get_title();
$attributes = $product->get_attributes();
$product_type = $attributes["pa_typ"]['options'][0];
?>
<div class="entry-content">
<div class="container">
    <?php
    /**
     * Hook: woocommerce_before_single_product.
     *
     * @hooked woocommerce_output_all_notices - 10
     */
    do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
    }
    ?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
//        do_action( 'woocommerce_before_single_product_summary' );
        ?>
        <?php $description = apply_filters( 'product_description', $product_type );
            $short_desc = $product->get_short_description();
        ?>
        <div class="summary entry-summary">
            <div class="summary-content">
                <h1 class="product_title entry-title"><?php echo $title ?></h1>
                <p class="single-product-desc"><?php echo $description; echo !empty($short_desc) ? ' ' . $short_desc : '';  ?></p>
                <div class="product-modal-gallery">
                    <div class="product-modal-photo-block">
                        <?php $full_src = wp_get_attachment_url( $product_thumbnail );
                        echo "<img class='edge' src=" . $full_src . " alt='" . $title . "'>"; ?>
                    </div>
                    <?php if(!empty($gallery_products)): ?>
                        <div class="product-modal-photo-block">
                            <?php
                            $full_src = wp_get_attachment_url( $gallery_products[0] );
                            echo "<img class='edge' src=" . $full_src . " alt='" . $title . "'>";
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-product-end">
                    <div><span class="difficulty-label">złożoność</span></div>
                    <div><?php woocommerce_template_single_price(); ?></div>
                    <div><?php output_product_difficulty(); ?></div>
                    <div><?php woocommerce_template_loop_add_to_cart(); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_single_product' ); ?>

</div>
</div>
