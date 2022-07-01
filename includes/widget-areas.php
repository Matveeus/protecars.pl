<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; //exit if accessed directly
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function protecars_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'protecars' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'protecars' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'protecars_widgets_init' );