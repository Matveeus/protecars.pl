<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; //exit if accessed directly
}


add_filter('product_description', 'output_single_product_desc');
function output_single_product_desc( $product_type ){
    switch ($product_type) {
        case 73: // Багажник
        {
            return 'Gotowe wykroje folii ochronnej <span class="modal-span-text">na bagażnik</span> zapewnią Twojemu autu najwyższy poziom ochrony i będą idealnym dodatkiem do wcześniej chronionych elementów.';
        }
        case 78: // Крылья
        {
            return 'Parkowanie i manewrowanie w ciasnych warunkach może prowadzić do kosztownych napraw. Gotowe wykroje folii ochronnej <span class="modal-span-text">na błotniki</span> pomogą zadbać o samochód oraz zaoszczędzić pieniądze.';
        }
        case 72: // Крыша перед
        {
            return 'Przednia część dachu i słupki przedniej szyby są najbardziej narażone na uszkodzenia podczas jazdy po autostradzie. Z czasem wyszczerbione miejsca zaczynają rdzewieć. Gotowe wykroje folii ochronnej  <span class="modal-span-text">na przód dachu oraz słupki szyby</span> pomogą Ci uniknąć kosztownych napraw i utrzymać maksymalną cenę sprzedaży.';
        }
        case 74: // Решетка радиатора
        {
            return 'Nowoczesne trendy w projektowaniu sprawiają, że producenci zwiększają rozmiar grilla. Gotowe wykroje folii ochronnej <span class="modal-span-text">na kratkę chłodnicy (grill)</span> będą idealnym dodatkiem do ochrony zderzaka i reflektorów.';
        }
        case 81: // Зеркала
        {
            return 'Koperta wykonywana w zbyt wąskiej przestrzeni może przynieść jedynie kłopoty, w postaci przerysowania samochodu. Gotowe wykroje folii ochronnej <span class="modal-span-text">na lusterki</span> pomogą utrzymać samochód w idealnym stanie.';
        }
        case 69: // Капот30
        {
            return 'Maska samochodu ulega największym uszkodzeniom podczas szybkiej jazdy. Z czasem wyszczerbione miejsca zaczynają rdzewieć. Gotowe wykroje folii ochronnej <span class="modal-span-text">na maskę + lusterka</span> pomogą Ci uniknąć kosztownych napraw i utrzymać maksymalną cenę sprzedaży.';
        }
        case 70: // Капот45
        {
            return 'Maska samochodu ulega największym uszkodzeniom podczas szybkiej jazdy. Z czasem wyszczerbione miejsca zaczynają rdzewieć. Gotowe wykroje folii ochronnej <span class="modal-span-text">na maskę + lusterka + błotniki część</span> pomogą Ci uniknąć kosztownych napraw i utrzymać maksymalną cenę sprzedaży.';
        }
        case 71: // Капот60
        {
            return 'Maska samochodu ulega największym uszkodzeniom podczas szybkiej jazdy. Z czasem wyszczerbione miejsca zaczynają rdzewieć. Gotowe wykroje folii ochronnej <span class="modal-span-text">na maskę + lusterka + błotniki część</span> pomogą Ci uniknąć kosztownych napraw i utrzymać maksymalną cenę sprzedaży.';
        }
        case 79: // Место загрузки багажника
        {
            return 'Nieostrożne pakowanie bagażu może pozostawić rysy oraz zarysowania na bagażniku. Gotowe wykroje folii ochronnej <span class="modal-span-text">do miejsca załadunku bagażnika</span> pomogą utrzymać samochód w stanie fabrycznym.';
        }
        case 76: // Пороги
        {
            return 'Kurz i brud bardzo szybko zaczynają pozostawiać lekkie zadrapania, dzięki czemu nawet nowy samochód wygląda na stary. Gotowe wykroje folii ochronnej <span class="modal-span-text">na progi</span> pomogą zachować zadbany wygląd i maksymalną cenę przy sprzedaży.';
        }
        case 67: // Фары передние
        {
            return 'Nowoczesne reflektory zapewniają najwyższą jakość oświetlenia, ale mogą kosztować kilkadziesiąt tysięcy złotych. Gotowe wykroje folii ochronnej <span class="modal-span-text">na reflektory</span> pomogą nie tylko ochronić jakość oświetlenia, ale także zaoszczędzić pieniądze.';
        }
        case 75: // Стойки Б
        {
            return 'Gotowe wykroje folii ochronnej <span class="modal-span-text">na słupki B</span> zapewnią Twojemu samochodowi najwyższy poziom ochrony i będą idealnym dodatkiem do wcześniej chronionych elementów.';
        }
        case 80: // Ручки дверей
        {
            return 'Regularne otwieranie/zamykanie drzwi samochodu bardzo szybko prowadzi do powstawania rys pod klamkami, które są szczególnie widoczne na ciemniejszych kolorach. Gotowe wykroje folii ochronnej <span class="modal-span-text">na klamki drzwi</span>, pomogą utrzymać Twój samochód w stanie fabrycznym.';
        }
        case 68: // Бампер
        {
            return 'Podczas eksploatacji zderzak auta cierpi nie tylko na odpryski, ale również czesto ulega uszkodzeniu w wyniku nieostrożnego parkowania. Gotowe wykroje folii ochronnej <span class="modal-span-text">na zderzak</span> pomogą Ci zaoszczędzić nie tylko pieniądze, ale także nerwy.';
        }
        case 77: // Бампер задний
        {
            return 'Tylny zderzak ulega największym uszkodzeniom na parkingach i w korkach (przypadkowe uderzenie w tył pojazdu). Gotowe wykroje folii ochronnej <span class="modal-span-text">na tylny zderzak</span>, pozwolą Ci uniknąć niepotrzebnych kłopotów i zachować oryginalny wygląd Twojego samochodu.';
        }
        case 82: // Наборы
        {
            return 'Różne zestawy <span class="modal-span-text">gotowych wykrojów folii ochronnej</span> (mogą zawierać : lusterka, klamki drzwi, krawędzie drzwi, próg załadunkowy bagażnika) dla Twojego samochodu, pomogą utrzymać Twój samochód w doskonałym stanie.';
        }
    }
}


add_action('woocommerce_after_single_product', 'after_single_product_text');
function after_single_product_text(){
    echo '<p class="single-prod-info">Aby chronić pojazd w każdych warunkach drogowych (odpryski, zarysowania, drobne wypadki), oferujemy właścicielom samochodów gotowe wykroje folii ochronnej do samodzielnego montażu.
        W naszym <a href="/katalog">katalogu</a> znajdą Państwo gotowe wykroje folii ochronnej na: reflektory, maskę, błotniki, progi, klamki drzwi itp.
        Folia idealnie przylega do laminowanych elementów samochodu, dopasowując się do ich konturów, a zastosowanie wykrojów pozwala uniknąć konieczności przycinania folii bezpośrednio na samochodzie, umożliwiając montaż folii bez doświadczenia.<br>Do każdego zamówienia dołączamy szczegółową instrukcję montażu, którą można znaleźć również na stronie <a href="/opis-montazu">opis montażu</a>.
        Nasz katalog jest stale uzupełniany o nowe wykoje dla różnych marek pojazdów, w tym najnowszych modeli. Jeżeli Państwa pojazdu nie ma w katalogu, wykroje mogą być wykonane i dodane na życzenie.</p>';
}