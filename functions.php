<?php
/**
 * Protecars functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Protecars
 */


/**
 * Load theme settings.
 * Load widgets.
 * Load scripts & styles.
 */
require get_template_directory() . '/includes/theme-settings.php';
require get_template_directory() . '/includes/widget-areas.php';
require get_template_directory() . '/includes/enqueue-script-style.php';


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

require get_template_directory() . '/includes/custom-header.php';
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/template-functions.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/woocommerce/includes/single-product-info.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
}


/**
 * Allow upload svg files.
 */
add_filter( 'upload_mimes', 'extra_mime_types' );
function extra_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

/**
 * Disable the default WooCommerce stylesheet.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


add_action( 'wp_ajax_nopriv_upload_next_select', 'upload_next_select');
add_action( 'wp_ajax_upload_next_select', 'upload_next_select');

function upload_next_select(){
//    if (!wp_verify_nonce($_POST['nonce'], 'filter-nonce')){
//        wp_die('Даннные отправленны со стороннего ресурса');
//    }
    $category_id = $_POST['category'];
    $terms = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => $category_id
    ]);
//    add_product_count_view();
    $array = array();
    foreach ($terms as $term) {
        $array[$term->term_id] = $term->name;
    }
    echo json_encode($array);
    exit();
}


add_action( 'wp_ajax_nopriv_upload_types', 'upload_types');
add_action( 'wp_ajax_upload_types', 'upload_types');

function upload_types(){
//    if (!wp_verify_nonce($_POST['nonce'], 'filter-nonce')){
//        wp_die('Даннные отправленны со стороннего ресурса');
//    }
    $category_id = $_POST['category'];
    $category = get_term_by( 'id', $category_id, 'product_cat' );
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
        'product_cat'    => $category->slug
    );
    $loop = new WP_Query( $args );
    $types_array = array();

    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) : $loop->the_post();
            global $product;
            $product_attributes = $product->get_attributes();
            $types_ids = $product_attributes['pa_typ']['options'];
            foreach ($types_ids as $types_id){
                $types_array[get_term( $types_id )->slug] = get_term( $types_id )->name;
            }
        endwhile;
    }
    wp_reset_postdata();
    echo json_encode($types_array);
    exit();
}


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 7 );


add_action( 'woocommerce_after_shop_loop_item_title', 'price_and_buy_button_block_open', 9 );
add_action( 'woocommerce_after_shop_loop_item', 'div_close', 15 );
function price_and_buy_button_block_open(){
    echo '<div class="price-and-buy-block">';
}

function div_close(){
    echo '</div>';
}

add_action( 'woocommerce_before_shop_loop_item_title', 'thumb_block_open', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'div_close', 15 );
function thumb_block_open(){
    echo '<div class="archive-product-thumb-block">';
}

add_action( 'woocommerce_shop_loop_item_title', 'title_block_open', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'div_close', 15 );
function title_block_open(){
    echo '<div class="archive-product-title-block">';
}



remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );



add_filter( 'woocommerce_get_image_size_thumbnail', 'vz_custom_thumbnail_size', 10, 1 );
function vz_custom_thumbnail_size( $size ){
    return array(
        'width'  => 0,
        'height' => 0,
        'crop'   => false,
    );
}


add_action( 'woocommerce_product_options_general_product_data', 'add_product_difficulty' );
function add_product_difficulty(){
    echo '<div class="options_group">';// Группировка полей
    woocommerce_wp_select( array(
        'id'                => '_difficulty',
        'label'             => __( 'Сложность', 'woocommerce' ),
        'desc_tip'          => 'true',
        'description'       => __( 'Введите сложность нанесения пленки', 'woocommerce' ),
        'options'     => array(
            ''        => __( 'Выберите сложность', 'woocommerce' ),
            '0.5' => __('0.5', 'woocommerce' ),
            '1' => __('1', 'woocommerce' ),
            '1.5' => __('1.5', 'woocommerce' ),
            '2' => __('2', 'woocommerce' ),
            '2.5' => __('2.5', 'woocommerce' ),
            '3' => __('3', 'woocommerce' ),
            '3.5' => __('3.5', 'woocommerce' ),
            '4' => __('4', 'woocommerce' ),
            '4.5' => __('4.5', 'woocommerce' ),
            '5' => __('5', 'woocommerce' ),
        )
    ) );
    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'save_product_difficulty', 10, 1 );
function save_product_difficulty( $post_id ){
    $text_field = isset( $_POST['_difficulty'] ) ? sanitize_text_field( $_POST['_difficulty'] ) : '0';
    update_post_meta($post_id,'_difficulty', $text_field );
}

add_action( 'woocommerce_before_shop_loop_item_title', 'output_product_difficulty_title', 15 );
function output_product_difficulty_title() {
    echo '<h3 class="difficulty-title">złożoność</h3>';
}

add_action( 'woocommerce_before_shop_loop_item_title', 'output_product_difficulty', 20 );
function output_product_difficulty() {
    global $product;
    $difficulty = get_post_meta( $product->get_id(), '_difficulty', true );
    $difficulty = floatval($difficulty);
    echo '<ul class="difficulty-rating">';
    for ($i = 0; $i < 5; $i++){
        if ($difficulty >= 1){
            echo '<li><div class="difficulty-star full-star"></div></li>';
        } elseif ($difficulty > 0 && $difficulty < 1){
            echo '<li><div class="difficulty-star half-star"></div></li>';
        } elseif ($difficulty <= 0){
            echo '<li><div class="difficulty-star empty-star"></div></li>';
        }
        $difficulty--;

    }
    echo '</ul>';
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


add_filter( 'woocommerce_get_script_data', 'change_view_cart',10,2 );
function change_view_cart( $params, $handle )
{
    switch ($handle) {
        case 'wc-add-to-cart':
            $params['i18n_view_cart'] = ""; //chnage Name of view cart button
            $params['cart_url'] = ""; //change URL of view cart button
            break;
    }
    return $params;
}


add_action( 'wp_ajax_nopriv_load_products', 'load_products');
add_action( 'wp_ajax_load_products', 'load_products');

function load_products(){
//    if (!wp_verify_nonce($_POST['nonce'], 'filter-nonce')){
//        wp_die('Даннные отправленны со стороннего ресурса');
//    }
    if (isset($_POST['category'])):
        $category_id = $_POST['category'];
        $type_slug = $_POST['type'] ?? 'default';
        $category = get_term_by( 'id', $category_id, 'product_cat' );
        if ($type_slug !== 'default'):
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 10,
                'product_cat'    => $category->slug,
                'tax_query'      => array( array(
                    'taxonomy'        => 'pa_typ',
                    'field'           => 'slug',
                    'terms'           =>  array($type_slug),
                    'operator'        => 'IN',
                ) )
            );
        else:
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 10,
                'product_cat'    => $category->slug
            );
        endif;
        $loop = new WP_Query( $args );
        ob_start();
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) :
                $loop->the_post();
                do_action( 'woocommerce_shop_loop' );
                wc_get_template_part( 'content', 'product' );
            endwhile;
        }
        wp_reset_postdata();
        $products_total = ob_get_clean();
        echo $products_total;
        exit();
    else :
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: text/html; charset=UTF-8');
        die(json_encode(array('message' => 'Missing category', 'code' => 500)));
    endif;
}

if ( ! function_exists( 'protecars_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function protecars_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        protecars_woocommerce_cart_link();
        $fragments['a.header-cart'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'protecars_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'protecars_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function protecars_woocommerce_cart_link() {
        ?>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart">
            <span id="cart-counter"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'protecars_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function protecars_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php protecars_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
    $price = '';
    $price .= wc_price($product->get_price());
    return $price;
}

remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );


/////////////////////////////////////
///
add_action( 'wp_ajax_nopriv_set_skrobak', 'set_skrobak');
add_action( 'wp_ajax_set_skrobak', 'set_skrobak');
function set_skrobak(){
//    if (!wp_verify_nonce($_POST['nonce'], 'addons-nonce')){
//        wp_die('Даннные отправленны со стороннего ресурса');
//    }
    if (!isset($_POST['add_ons'])){
        WC()->session->set('skrobak', array());
        exit();
    }
    $params = $_POST['add_ons'];
    WC()->session->set('skrobak', $params);
    exit();
}


add_action('woocommerce_cart_calculate_fees' , 'woo_discount_total');
function woo_discount_total(WC_Cart $cart) {
    if ( ( is_admin() && ! defined( 'DOING_AJAX' ) ) ) return;
    $params = WC()->session->get('skrobak');
    if ($params === null){
        $params = array("raklaCheckbox", "plynCheckbox");
        WC()->session->set('skrobak', $params);
//        $cart->add_fee('Rakla', 0);
//        $cart->add_fee('Płyn montażowy', 0);
//        return;
    }
    if (count($params) === 0) return;
    if(in_array("strzykawkaCheckbox", $params)) $cart->add_fee('Strzykawka insulinowa', 3);
    if(in_array("raklaCheckbox", $params)) $cart->add_fee('Rakla', 0);
    if(in_array("odtłuszczającyCheckbox", $params)) $cart->add_fee('Płyn odtłuszczający', 8);
    if(in_array("plynCheckbox", $params)) $cart->add_fee('Płyn montażowy', 0);
    if(in_array("microfibraCheckbox", $params)) $cart->add_fee('Microfibra', 6);
    if(in_array("rekawiceCheckbox", $params)) $cart->add_fee('Rękawice', 3);

}

add_action('wp_footer','custom_jquery_add_to_cart_script');
function custom_jquery_add_to_cart_script(){
    if ( is_shop() || is_product_category() || is_product_tag() || is_product()): // Only for archives pages?>
        <script type="text/javascript">
            // Ready state
            (function($){
                $('a.add_to_cart_button').click( function(){
                    $this = $('a.add_to_cart_button[data-product_id="' + $(this).attr('data-product_id') + '"]');
                    $( document.body ).on( 'added_to_cart', function(){
                        $($this).each(function (){
                            $(this).text('Dodany');
                            $(this).css('background', 'var(--secondary-color)');
                        })
                    });
                });

            })(jQuery); // "jQuery" Working with WP (added the $ alias as argument)
        </script>
    <?php
    endif;
}


add_action('woocommerce_after_cart_item_name', 'output_optional_cart_item_name', 10, 2);
function output_optional_cart_item_name($cart_item, $cart_item_key){
    $product = $cart_item['data'];
    $product_attributes = $product->get_attributes();
    $product_type = $product_attributes['pa_typ']['options'][0];
    $description = apply_filters( 'product_description', $product_type );
    echo '<p class="additional-cart-item-name">' . $description . '</p>';
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['order']['order_comments']);
    $fields['billing']['billing_first_name']['priority'] = 1;
    $fields['billing']['billing_last_name']['priority'] = 2;
    $fields['billing']['billing_email']['priority'] = 3;
    $fields['billing']['billing_phone']['priority'] = 4;
    $fields['billing']['billing_country']['type'] = 'hidden';

    return $fields;
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
add_action( 'woocommerce_checkout_before_order_review', 'woocommerce_order_review', 10 );

function filter_woocommerce_cart_totals_coupon_html( $coupon_html, $coupon, $discount_amount_html ) {
    $coupon_html = $discount_amount_html . '<a href="http://protecars.pl/cart/?remove_coupon=' . $coupon->code . '" class="woocommerce-remove-coupon" data-coupon="' . $coupon->code . '"></a>';

    return $coupon_html;
}
add_filter( 'woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3 );

add_filter( 'woocommerce_form_field' , 'elex_remove_checkout_optional_text', 10, 4 );
function elex_remove_checkout_optional_text( $field, $key, $args, $value ) {
    if( is_checkout() && ! is_wc_endpoint_url() ) {
        $optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
        $field = str_replace( $optional, '', $field );
    }
    return $field;
}



add_action( 'woocommerce_checkout_order_processed', 'is_express_delivery',  1, 1  );
function is_express_delivery( $order_id ){
    WC()->session->set('skrobak', array());
}

function pc_disable_woocommerce_block_styles() {
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'pc_disable_woocommerce_block_styles' );

add_filter('post_class', 'pc_add_class_loop_item');
function pc_add_class_loop_item ( $classes ){
    if ( wp_doing_ajax() || is_shop())
    {
        $classes[] = 'animate__animated wow animate__fadeIn';
    }
    return $classes;
}

add_filter('wpseo_opengraph_desc', 'edit_op_meta_desc');
add_filter('wpseo_metadesc', 'edit_op_meta_desc');
function edit_op_meta_desc( $meta_description ){
    if (is_product()):
        global $product;
        $attributes = $product->get_attributes();
        $product_type = $attributes["pa_typ"]['options'][0];
        $description = apply_filters( 'product_description', $product_type );
        $short_desc = $product->get_short_description();
        if (!empty($short_desc)) {
            return strip_tags( $description ) . ' ' . strip_tags( $short_desc );
        }
        else {
            return strip_tags( $description );
        }
    else:
        return $meta_description;
    endif;
}

add_filter( 'woocommerce_cart_totals_coupon_html', 'filter_function_name_9974', 10, 3 );
function filter_function_name_9974( $coupon_html, $coupon, $discount_amount_html ){
    $amount = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
    if ( $coupon->get_free_shipping() && empty( $amount ) ) {
        return "Darmowa wysyłka";
    } else {
        return '-' . wc_price( $amount );
    }
}