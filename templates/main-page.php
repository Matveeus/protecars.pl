<?php
/**
 * Template name: Главная страница
 */

get_header();
?>

    <div class="entry-content">
        <div class="main-page-background"></div>
        <div class="container">
            <?php get_template_part( 'template-parts/content', 'main-filter' ); ?>
            <h1 class="protecars-info">Protecars produkuje już wycięte,<span> gotowe do samodzielnego montażu</span> zestawy folii ochronnych PPF, aby każdy mógł ochronić własny samochód. Folia ochronna PPF w zestawach protecars.pl jest idealnym sposóbem na <span>łatwe i tanie zabezpieczenie</span> samochodu</h1>
            <h2 class="adv-title">Jak to wygląda</h2>
            <div class="gifs-block animate__animated wow animate__fadeIn">
                <div class="gif_install">
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/gif1.gif"></div>
                    <label>1. Zwilżenie płynem montażowym</label>
                </div>
                <div class="gif_install">
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/gif2.gif"></div>
                    <label>2. Pozycjonowanie folii</label>
                </div>
                <div class="gif_install">
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/gif3.gif"></div>
                    <label>3. Wygładzanie płynu</label>
                </div>
            </div>
            <h2 class="adv-title">Krótka instrukcja</h2>
            <section class="info-section-main-page">
                <?php get_template_part( 'template-parts/content', 'infographic' ); ?>
            </section>
            <h2 class="adv-title">Zalety</h2>
            <section class="adv-section-main-page animate__animated wow animate__fadeIn">

                <?php get_template_part( 'template-parts/content', 'advantages' ); ?>
            </section>
            <h2 class="adv-title">Opinia</h2>
            <div class="opinia-section">
                <div class="opinia-block">
                    <label>Dzmitry</label>
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/opinia.svg"></div>
                </div>
                <div class="opinia-block">
                    <label>Jakub</label>
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/opinia2.svg"></div>
                </div>
                <div class="opinia-block">
                    <label>Przemek</label>
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/opinia3.svg"></div>
                </div>
                <div class="opinia-block">
                    <label>Aleksander</label>
                    <div><img src="http://protecars.pl/wp-content/uploads/2021/12/opinia4.svg"></div>
                </div>




<!--                <div class="opinia">"Całkiem jestem zadowolony, porównując do ceny w detailingach to prawie za darmo, instrukcja i filmiki były bardzo przydatne"</div>-->
<!--                <div class="opinia">"BMW f30, okleiłem reflektory, Z 30 minut roboty, nie 15"</div>-->
<!--                <div class="opinia">"Wszystkie niezbędne narzędzia dostałem razem z folią, rakla mogłaby być lepsza. Chociaż darowanemu koniowi w zęby się nie zagląda"</div>-->
<!--                <div class="opinia">"Bez problemu poradziłem sobie sam z oklejaniem reflektorów, dachu i słupek szyby. Do montażu folii na maskę przydała się pomoc, bo w miarę duży kawałek (audi a4 b9)"</div>-->
            </div>
            <a id="button-up"></a>
        </div>
        <?php get_template_part( 'template-parts/content', 'surprise-modal' ); ?>
        <?php get_template_part( 'template-parts/content', 'no-auto-modal' ); ?>
    </div>


<?php
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 10,
    'product_cat'    => 'audi',
    'tax_query'      => array( array(
        'taxonomy'        => 'pa_model',
        'field'           => 'slug',
        'terms'           =>  array('a5', 'a6', 'a7'),
        'operator'        => 'IN',
    ) )

);

//$loop = new WP_Query( $args );
//
//while ( $loop->have_posts() ) : $loop->the_post();
//    global $product;
//    $product_attributes = $product->get_attributes();
//    $manufacturer_id = $product_attributes['pa_typ']['options']['0']; // returns the ID of the term
//    $manufacturer_name = get_term( $manufacturer_id )->name;
//    $model_id = $product_attributes['pa_model']['options']['0']; // returns the ID of the term
//    $model_name = get_term( $model_id )->name;
//    echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().' (' . wc_get_product_category_list($product->ID) . ')(' . $manufacturer_name . ')(' . $model_name . ')</a><br>';
//endwhile;
//
//wp_reset_query();
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
get_footer();
