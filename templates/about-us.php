<?php
/**
 * Template name: О нас
 */

get_header();
?>
    <div class="entry-content">
        <div class="container">
            <h1 class="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
            <p class="o-nas-info">Protecars to zespół ludzi, dla których samochód to coś więcej niż tylko środek transportu. Kamienie i piasek często uszkadzają lakier. Nawet drobne zadrapania spowodowane nieostrożnym parkowaniem mogprzeą prowadzić do kosztownych napraw. To nie tylko przyspiesza proces starzenia samochodu, ale także obniża jego wartość. Dla nas ważne jest, aby każdy podzielający naszą pasję miał możliwość zabezpieczenia swojego samochodu przed uszkodzeniami przy wysokiej jakości i niskiej cenie. Przy wyborze folii kierujemy się nie tylko jej ceną i trwałością, ale także łatwością montażu.</p>
            <p class="o-nas-info">W naszym asortymencie z pewnością znajdziesz nie tylko folię do swojego auta, ale również narzędzia oraz szczegółową instrukcję montażu. (Jeśli nie znajdziesz swojego modelu w naszym katalogu, zrobimy go specjalnie dla Ciebie)</p>
            <div class="o-nas-contacts">
                <a class="o-nas-email" href="mailto:info@protecars.pl">info@protecars.pl</a>
                <a class="o-nas-tel" href="tel:+48730730730">+48732678490</a>
                <a class="o-nas-insta" href="https://www.instagram.com/protecars_pl/">protecars_pl</a>
            </div>
            <h2  class="page-title">Dostawa</h2>
            <p class="o-nas-info">Aby zapewnić, że nasze produkty dotrą do klienta tak szybko, jak to możliwe, wysyłamy je:<br>
                <br>-za pośrednictwem firmy kurierskiej - maksymalnie 2 dni robocze.
            </p>
            <h2 id="wspolpraca" class="page-title">Współpraca</h2>
            <ul class="o-nas-info">
                <li>Zapraszamy do współpracy:</li>
                <li>-Autokomisy</li>
                <li>-Myjnie samochodowe</li>
                <li>-Warsztaty i salony samochodowe</li>
                <li>-Agencje Ubezpieczeniowe</li>
                <li>-Firmy importujące samochody</li>
            </ul>
            <p class="after-o-nas-info">Nasz program referalny ma na celu współpracę ze wszystkimi zainteresowanymi działającymi na rynku motoryzacyjnym. Otrzymasz unikalny kod, po wpisaniu którego na naszej stronie Twój klient otrzyma zniżkę, a Ty otrzymasz (%) od kwoty jego zamówienia.</p>
        </div>
    </div>

<script>
    jQuery(document).ready(function($) {
        function sclrollTo(){
            if (window.location.href.includes('https://protecars.pl/o-nas/#wspolpraca')){
                var headerHeight = $('header.header')[0].clientHeight;
                var top = $('#wspolpraca').offset().top - headerHeight - 15;
                var body = jQuery("html, body");
                body.animate({scrollTop:top}, 500, 'swing');
            }
        }
        setTimeout(sclrollTo, 400);
    });

</script>
<?php
get_footer();
