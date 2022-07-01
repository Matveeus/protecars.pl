<?php
/**
 * Template part for displaying modal window(no car) content in main-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Protecars
 */

?>

<div id="no_auto_modal" class="modal-window">
    <div class="modal-container">
        <div class="modal_window_main_page">
            <svg  class="close-button" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.707106 2.12816C0.316582 1.73763 0.320002 1.10105 0.710526 0.710526V0.710526C1.10105 0.320002 1.73764 0.316582 2.12816 0.707107L8.29289 6.87184C8.68342 7.26237 9.31658 7.26237 9.70711 6.87184L15.8718 0.707106C16.2624 0.316582 16.8989 0.320002 17.2895 0.710526V0.710526C17.68 1.10105 17.6834 1.73764 17.2929 2.12816L11.1282 8.29289C10.7376 8.68342 10.7376 9.31658 11.1282 9.70711L17.2929 15.8718C17.6834 16.2624 17.68 16.8989 17.2895 17.2895V17.2895C16.8989 17.68 16.2624 17.6834 15.8718 17.2929L9.70711 11.1282C9.31658 10.7376 8.68342 10.7376 8.29289 11.1282L2.12816 17.2929C1.73763 17.6834 1.10105 17.68 0.710526 17.2895V17.2895C0.320002 16.8989 0.316582 16.2624 0.707107 15.8718L6.87184 9.70711C7.26237 9.31658 7.26237 8.68342 6.87184 8.29289L0.707106 2.12816Z" fill="#AEAEAE"/>
            </svg>
            <h2 class="modal-title-main-page">Nie znalazłeś swojego modelu?</h2>
            <p class="modal-text-main-page">Wypełnij formularz, a my poinformujemy Cię o dostępności folii ochronnej na Twój samochód.</p>
            <?php echo do_shortcode('[contact-form-7 id="50" title="No car"]') ?>
        </div>
    </div>
</div>
