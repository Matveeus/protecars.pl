<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
    <div class="entry-content">
        <div class="container">
        <ul>
            <?php
            $categories = get_categories(array(
                'taxonomy'     => 'category',
                'parent'       => 16,
            ));
            foreach ($categories as $cat) {
                $query = '';
                $args = array(
                    'cat' => $cat->term_id,
                );

                $query = new WP_Query( $args );
                print_r($the_query);
                echo "<li>".$cat->cat_name." (".$query->found_posts.")</li>";
                wp_reset_query();
            }

            ?>
        </ul>
    <header class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>
<?php
if ( woocommerce_product_loop() ) {

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action( 'woocommerce_before_shop_loop' );

    $is_set_generation = isset($_GET['generacja']);

    if ($is_set_generation):
        $current_gen_id = $_GET['generacja'];

        $current_gen = get_term_by( 'id', $current_gen_id, 'product_cat' );

        $current_model_id = $current_gen->parent;
        $current_model = get_term_by( 'id', $current_model_id, 'product_cat' );

        $current_marka_id = $current_model->parent;
        $current_marka = get_term_by( 'id', $current_marka_id, 'product_cat' );

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'product_cat'    => $current_gen->slug
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
    endif; ?>

    <form method="GET" id="filterForm" class="demoForm archive-product-form">
    <h2>Samochód, który chcesz zabezpieczyć folią ochronną to:</h2>
    <fieldset>
        <div class="select" id="marka_select">
            <label for="marka_select_input">Marka:</label>
            <input class="select__input" type="hidden" id="marka_select_input" value="<?php echo $is_set_generation ? $current_marka->term_id : 'default'; ?>" name="marka_select_input">
            <div class="select__head"><?php echo $is_set_generation ? $current_marka->name : 'Wybrać'; ?></div>
            <ul class="select__list" style="display: none;">
                <?php
                $terms = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => 0
                ]);
                foreach ($terms as $term){
                    if ($term->term_id === 15) continue;
                    echo '<li class="select__item" product-data="' . $term->term_id . '">' . $term->name . '</li>';
                }
                ?>
            </ul>
        </div>

        <div class="select <?php echo $is_set_generation ? '' : 'disabled'; ?>" id="model_select">
            <label for="model_select_input">Model:</label>
            <input class="select__input" type="hidden" id="model_select_input" value="<?php echo $is_set_generation ? $current_model->term_id : 'default'; ?>" name="model_select_input">
            <div class="select__head"><?php echo $is_set_generation ? $current_model->name : 'Wybrać'; ?></div>
            <ul class="select__list" style="display: none;">
                <?php
                if ($is_set_generation):
                    $terms = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => $current_marka_id
                    ]);
                    foreach ($terms as $term){
                        echo '<li class="select__item" product-data="' . $term->term_id . '">' . $term->name . '</li>';
                    }
                endif;
                ?>
            </ul>
        </div>

        <div class="select <?php echo $is_set_generation ? '' : 'disabled'; ?>" id="gen_select">
            <label for="gen_select_input">Generacja:</label>
            <input class="select__input" type="hidden" id="gen_select_input" value="<?php echo $is_set_generation ? $current_gen->term_id : 'default'; ?>" name="gen_select_input">
            <div class="select__head"><?php echo $is_set_generation ? $current_gen->name : 'Wybrać'; ?></div>
            <ul class="select__list" style="display: none;">
                <?php
                if ($is_set_generation):
                    $terms = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => $current_model_id
                    ]);
                    foreach ($terms as $term){
                        echo '<li class="select__item" product-data="' . $term->term_id . '">' . $term->name . '</li>';
                    }
                endif;
                ?>
            </ul>
        </div>

        <div class="select <?php echo $is_set_generation ? '' : 'disabled'; ?>" id="type_select">
            <label for="gen_select_input">Typ:</label>
            <input class="select__input" type="hidden" id="type" value="default" name="type">
            <div class="select__head">Wybrać</div>
            <ul class="select__list" style="display: none;">
                <?php
                if ($is_set_generation):
                    foreach ($types_array as $key => $value){
                        echo '<li class="select__item" product-data="' . $key . '">' . $value . '</li>';
                    }
                endif;
                ?>
            </ul>
        </div>
    </fieldset>
    <div class="form-buttons-section">
        <div class="filter-star-desc"><p class="filter-star-desc-text">&#8212;&nbsp;&nbsp; złożoność montażu</p></div>
        <input class="pc-secondary-button submit-button <?php echo $is_set_generation ? '' : 'disabled-button'; ?>" type="submit" id="submit_filter" value="Pokaż" <?php echo $is_set_generation ? '' : 'disabled'; ?>/>
        <a class="no-auto-button">Nie znalazłeś swojego modelu?</a>
    </div>
</form>

<?php
//    get_template_part( 'template-parts/content', 'archive-filter' ); ?>

    <div class="lds-dual-ring"></div>
    <?php

    woocommerce_product_loop_start();

    if ($is_set_generation){
    ?>

    <script>
        function anton(){
            if (document.documentElement.clientWidth < 500){
                window.scrollTo({
                    top: 700,
                    behavior: "smooth"
                });
            }
        }
        window.setTimeout(anton, 500);

    </script>

    <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'product_cat'    => $current_gen->slug
        );

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) {
            $loop->the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
        }

        wp_reset_query();





    } else {
        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
            }
        }
    }

    woocommerce_product_loop_end();

    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action( 'woocommerce_after_shop_loop' );
} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>
        </div>
        <?php get_template_part( 'template-parts/content', 'no-auto-modal' ); ?>
    </div>
    <a id="button-up"></a>
<?php

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

<script>
    jQuery(document).ready(function($) {
        $('.select').on('click', '.select__head', function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $(this).next().slideUp();
            } else {
                $('.select__head').removeClass('open');
                $('.select__list').slideUp();
                $(this).addClass('open');
                $(this).next().slideDown();
            }
        });

        $('.select').on('click', '.select__item', function () {
            $('.select__head').removeClass('open');
            $(this).parent().slideUp();
            $(this).parent().prev().text($(this).text());
            $(this).parent().prev().prev().val($(this).attr("product-data"));
        });

        $(document).click(function (e) {
            if (!$(e.target).closest('.select').length) {
                $('.select__head').removeClass('open');
                $('.select__list').slideUp();
            }
        });
    });
</script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous">

        jQuery(document).ready(function() {
            var btn = $('#button-up');
            $(window).scroll(function() {
                if ($(window).scrollTop() > 400) {
                    btn.addClass('show');
                } else {
                    btn.removeClass('show');
                }
            });
            btn.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop:0}, '400');
            });
        });
    </script>
<?php
get_footer( 'shop' );
