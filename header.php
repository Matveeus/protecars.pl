<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Protecars
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="google-site-verification" content="9cmjvBx2BEdOXRzqL0HnKcDzSbNEaxW08wy2Qtthd2E" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="o3c2byvayzrazbef8ljurg86vspj71" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel=preload as=font href="<?php echo get_template_directory_uri() . '/assets/fonts/roboto-v29-latin-ext_latin-300.woff2'?>" type="font/woff2" as="font" crossorigin>
    <link rel=preload as=font href="<?php echo get_template_directory_uri() . '/assets/fonts/roboto-v29-latin-ext_latin-regular.woff2'?>" type="font/woff2" as="font" crossorigin>
    <link rel=preload as=font href="<?php echo get_template_directory_uri() . '/assets/fonts/asap-v15-latin-ext_latin-regular.woff2'?>" type="font/woff2" as="font" crossorigin>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?php wp_head(); ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(88144025, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/88144025" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header class="header">
        <div class="container">
            <div class="header-wrapper">
                <div class="header-burger">
                    <span></span>
                </div>
                <div class="logo animate__animated animate__fadeInDown" style="background: url('<?php echo get_template_directory_uri() . '/assets/image/general/Protecars_logo.svg' ?>');background-size:contain; background-repeat: no-repeat;"><a href="<?php echo home_url();?>" style="display: block; width: inherit; height: inherit;"> </a></div>
                <ul class="navigation">
                    <li class="first-option"><a class="nav-option" href="/katalog">Katalog</a></li>
                    <li><a class="nav-option" href="/opis-montazu">Opis montażu</a></li>
                    <li><a class="nav-option" href="/o-nas#wspolpraca">Współpraca</a></li>
                    <li class="last-option"><a class="nav-option" href="/o-nas">O nas</a></li>
                </ul>
                <?php protecars_woocommerce_cart_link(); ?>
            </div>
    </header>
