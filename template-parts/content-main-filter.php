<?php
/**
 * Template part for displaying filter content in main-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Protecars
 */

?>


<form action="/katalog" method="GET" id="filterForm" class="demoForm animate__animated wow animate__fadeIn">
    <h1 class="form-title">Samochód, który chcesz zabezpieczyć folią ochronną to:</h1>
    <fieldset>
        <div class="select" id="marka_select">
            <label>Marka:</label>
            <input class="select__input" type="hidden" id="marka" name="marka">
            <div class="select__head">Wybrać</div>
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
        <div class="select disabled" id="model_select">
            <label>Model:</label>
            <input class="select__input" type="hidden" id="model" name="model">
            <div class="select__head">Wybrać</div>
            <ul class="select__list" style="display: none;">
            </ul>
        </div>
        <div class="select disabled" id="gen_select">
            <label class="">Generacja:</label>
            <input class="select__input" type="hidden" id="generacja" name="generacja">
            <div class="select__head">Wybrać</div>
            <ul class="select__list" style="display: none;">
            </ul>
        </div>
    </fieldset>
    <div class="form-buttons-section">
        <a class="no-auto-button">Nie znalazłeś swojego modelu?</a>
        <input class="pc-button disabled-button" disabled type="submit" id="submit_filter" value="Pokaż"/>
    </div>

</form>