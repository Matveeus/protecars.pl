<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; //exit if accessed directly
}

/**
 * Enqueue scripts.
 */
function protecars_scripts() {
    wp_enqueue_script( 'afterlag', get_template_directory_uri() . '/assets/js/jquery.afterlag.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true );
    wp_localize_script('main', 'filter', array(
        'ajaxurl'=>admin_url('admin-ajax.php'),
        'nonce'=>wp_create_nonce('filter-nonce')
    ));
    wp_enqueue_script( 'protecars-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'burger-menu', get_template_directory_uri() . '/assets/js/burger_menu.js', array(), null, true );
    wp_enqueue_script( 'events', get_template_directory_uri() . '/assets/js/event_listeners.js', array('jquery'), null, true );
    wp_localize_script('events', 'addons', array(
        'ajaxurl'=>admin_url('admin-ajax.php'),
        'nonce'=>wp_create_nonce('addons-nonce')
    ));
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), null, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'prettyPhoto' );
    wp_enqueue_script( 'prettyPhoto-init' );
}
add_action( 'wp_enqueue_scripts', 'protecars_scripts' );

/**
 * Enqueue styles.
 */
function protecars_styles() {
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
    wp_enqueue_style( 'protecars-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'protecars-style', 'rtl', 'replace' );
    wp_enqueue_style( 'style-media', get_template_directory_uri() . '/assets/css/media/style-media.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );


    if (is_front_page()){
        wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
        wp_enqueue_style( 'main-media', get_template_directory_uri() . '/assets/css/media/main-media.css' );
        return;
    } elseif ( is_cart() ){
        wp_enqueue_style( 'cart', get_template_directory_uri() . '/assets/css/cart.css' );
        wp_enqueue_style( 'cart-media', get_template_directory_uri() . '/assets/css/media/cart-media.css' );
        wp_enqueue_style( 'product-modal', get_template_directory_uri() . '/assets/css/product-modal.css' );
        wp_enqueue_style( 'product-modal-media', get_template_directory_uri() . '/assets/css/media/product-modal-media.css' );
        wp_enqueue_style( 'woocommerce_prettyPhoto_css' );
        return;
    } elseif ( is_checkout() ){
        wp_enqueue_style( 'checkout', get_template_directory_uri() . '/assets/css/checkout.css' );
        wp_enqueue_style( 'checkout-media', get_template_directory_uri() . '/assets/css/media/checkout-media.css' );
        return;
    } elseif (is_404()){
        wp_enqueue_style( '404', get_template_directory_uri() . '/assets/css/404.css' );
        wp_enqueue_style( '404-media', get_template_directory_uri() . '/assets/css/media/404-media.css' );
        return;
    } elseif (is_shop() || is_product_category() || is_product_tag() || is_product()){
        wp_enqueue_style( 'catalog', get_template_directory_uri() . '/assets/css/catalog.css' );
        wp_enqueue_style( 'catalog-media', get_template_directory_uri() . '/assets/css/media/catalog-media.css' );
        wp_enqueue_style( 'product-modal', get_template_directory_uri() . '/assets/css/product-modal.css' );
        wp_enqueue_style( 'product-modal-media', get_template_directory_uri() . '/assets/css/media/product-modal-media.css' );
        return;
    }

    global $post;
    $page_id = $post->ID;

    switch ($page_id) {
        case 12: //O nas
        {
            wp_enqueue_style( 'about-us', get_template_directory_uri() . '/assets/css/about-us.css' );
            wp_enqueue_style( 'about-us-media', get_template_directory_uri() . '/assets/css/media/about-us-media.css' );
            break;
        }
        case 31: //Opis montażu
        {
            wp_enqueue_style( 'opis-instalacji', get_template_directory_uri() . '/assets/css/opis-instalacji.css' );
            break;
        }
        case 27: //Regulamin & Polityka prywatności
        case 29:
        {
            wp_enqueue_style( 'policy-regulamin', get_template_directory_uri() . '/assets/css/policy-regulamin.css' );
            break;
        }
    }

}
add_action( 'wp_enqueue_scripts', 'protecars_styles' );