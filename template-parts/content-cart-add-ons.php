<?php
/**
 * Template part for displaying cart add-ons content in cart.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Protecars
 */

?>
<?php
$params = WC()->session->get('skrobak');
?>

<form id="cart_add_ons">
    <h2>Polecamy do montażu:</h2>
    <div class="add-ons-row animate__animated wow animate__fadeIn">
        <input id='raklaCheckbox' name="raklaCheckbox" type='checkbox'  <?php echo in_array("raklaCheckbox", $params) ? 'checked' : ''; ?>/>
        <label for='raklaCheckbox'>
            <span></span>
        </label>
        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/rakla.png" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/rakla.png"></a></div>
        <div>
            <label for="raklaCheckbox" class="unselectable">Rakla (+0zl)</label>
            <p class="add-ons-row-info">Do spłaszczania folii podczas jej montażu</p>
        </div>
    </div>
    <div class="add-ons-row animate__animated wow animate__fadeIn">
        <input id='plynCheckbox' name="plynCheckbox" type='checkbox' <?php echo in_array("plynCheckbox", $params) ? 'checked' : ''; ?>/>
        <label for='plynCheckbox'>
            <span></span>
        </label>
        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/plyn-montaz.png" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/plyn-montaz.png"></a></div>
        <div>
            <label for="plynCheckbox" class="unselectable">Płyn montażowy (+0zl)</label>
            <p class="add-ons-row-info">Zapewni łatwe pozycjonowanie folii bez przyklejania</p>
        </div>
    </div>
    <div class="add-ons-row animate__animated wow animate__fadeIn">
        <input id='odtłuszczającyCheckbox' name="odtłuszczającyCheckbox" type='checkbox' <?php echo in_array("magnesyCheckbox", $params) ? 'checked' : ''; ?>/>
        <label for='odtłuszczającyCheckbox'>
            <span></span>
        </label>
        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/izoz.png" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/izoz.png"></a></div>
        <div>
            <label for="odtłuszczającyCheckbox" class="unselectable">Płyn odtłuszczający (+8zl)</label>
            <p class="add-ons-row-info">Do odtłuszczania i czyszczenia lakieru przed montażem folii ochronnej</p>
        </div>
    </div>
    <div class="add-ons-row animate__animated wow animate__fadeIn">
        <input id='rekawiceCheckbox' name="rekawiceCheckbox" type='checkbox' <?php echo in_array("rekawiceCheckbox", $params) ? 'checked' : ''; ?>/>
        <label for='rekawiceCheckbox'>
            <span></span>
        </label>
        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/rekawiczki.jpg" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/rekawiczki.jpg"></a></div>
        <div>
            <label for="rekawiceCheckbox" class="unselectable">Rękawice (+3zl)</label>
            <p class="add-ons-row-info"></p>
        </div>
    </div>
    <div class="add-ons-row animate__animated wow animate__fadeIn">
        <input id='microfibraCheckbox' name="microfibraCheckbox" type='checkbox'/>
        <label for='microfibraCheckbox'>
            <span></span>
        </label>
        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/micro.png" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/micro.png"></a></div>
        <div>
            <label for="microfibraCheckbox" class="unselectable">Microfibra (+6zl)</label>
            <p class="add-ons-row-info"></p>
        </div>
    </div>
<!--    <div class="add-ons-row animate__animated wow animate__fadeIn">-->
<!--        <input id='strzykawkaCheckbox' name="strzykawkaCheckbox" type='checkbox' --><?php //echo in_array("strzykawkaCheckbox", $params) ? 'checked' : ''; ?><!--/>-->
<!--        <label for='strzykawkaCheckbox'>-->
<!--            <span></span>-->
<!--        </label>-->
<!--        <div class="add-ons-img-block"><a id="gift-tag-popup thickbox" class="add-ons-img-link" data-rel="prettyPhoto" href="http://protecars.pl/wp-content/uploads/2021/12/insulinowa.jpg" title=""><img src="http://protecars.pl/wp-content/uploads/2021/12/insulinowa.jpg"></a></div>-->
<!--        <div>-->
<!--            <label for="strzykawkaCheckbox" class="unselectable">Strzykawka z iglą (+3zl)</label>-->
<!--            <p class="add-ons-row-info">Do usuwania pęcherzyków powietrza pod folią, jeśli są</p>-->
<!--        </div>-->
<!--    </div>-->


</form>
