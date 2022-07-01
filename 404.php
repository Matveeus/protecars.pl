<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Protecars
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="entry-content">
            <div class="container">
                <div class="not-found-box">
                    <div class="not-found_card">
                        <h1 class="not-found_title">404: nie znaleziono strony</h1>
                        <form action="/shop" class="not-found_button-wrapper"><button class="pc-button">Do katalogu</button></form>
                    </div>
                </div>
            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();
