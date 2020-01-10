<?php

// Определяем глубину ревизий
define('WP_POST_REVISIONS', 1);

// Вспомогательные функции
require_once('includes-php/enqueue-script-style.php');
require_once('includes-php/clear-phone.php');
require_once('includes-php/moneyformat.php');
require_once('includes-php/youtube.php');
require_once('includes-php/number-end.php');
require_once('custom-php/ajax-feedback.php');



// Подгружаем скрипты и стили к теме
add_action('wp_enqueue_scripts', 'my_theme_load_resources');
function my_theme_load_resources() {
    $js_options = array(
        'jquery-version'            =>  1,          // 1;2;3;
        'maps'                      => '2gis',    // yandex;google;'
    );

    load_js_css_resources( $js_options );

    wp_enqueue_style('fonts','https://fonts.googleapis.com/css?family=Roboto+Slab:700&display=swap&subset=cyrillic" rel="stylesheet');
    // wp_enqueue_script('owl-carousel', get_stylesheet_directory_uri() . '/includes-javascripts/owl-carousel/owl.carousel.min.js', array('jquery'), true);
}
