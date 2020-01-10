<?php

function load_js_css_resources( $options ){
    $theme_uri = get_template_directory_uri();

    $domen =  substr($_SERVER['SERVER_NAME'], strpos($_SERVER['SERVER_NAME'], '.') + 1, strlen($_SERVER['SERVER_NAME']));
    
    switch ( $options['jquery-version'] ){
        case 1:
            $locJqueryJsPath = $theme_uri.'/includes-javascripts/jquery/jquery.1.12.4.min.js';
            $remJqueryJsPath = 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?v=1.12.4';
            break;
        case 2:
            $locJqueryJsPath = $theme_uri.'/includes-javascripts/jquery/jquery.2.2.4.min.js';
            $remJqueryJsPath = 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js?v=2.2.4';
            break;
        case 3:
            $locJqueryJsPath = $theme_uri.'/includes-javascripts/jquery/jquery.3.1.1.min.js';
            $remJqueryJsPath = 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js?v=3.1.1';
            break;
    }

    switch ( $options['maps'] ){
        case 'yandex':
            $locYandexMapJsPath = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU';
            $remYandexMapJsPath = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU';
            break;
        case 'google':
            //$locGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB4PUChbUnsjeORqBw0OIet_uSSHVG9lYA&callback=initMap';
            //$remGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB4PUChbUnsjeORqBw0OIet_uSSHVG9lYA&callback=initMap';
	        $locGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgCx3FFQORdFUNwqCS7J25uRq1BgvG8T0&callback=initMap&language=en';
            $remGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgCx3FFQORdFUNwqCS7J25uRq1BgvG8T0&callback=initMap&language=en';
	        add_filter('script_loader_tag', 'add_async_defer_attribute', 10, 2);
            break;
      case '2gis':
        //$locGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB4PUChbUnsjeORqBw0OIet_uSSHVG9lYA&callback=initMap';
        //$remGoogleMapJsPath = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB4PUChbUnsjeORqBw0OIet_uSSHVG9lYA&callback=initMap';
        $loc2gisMapJsPath = 'https://maps.api.2gis.ru/2.0/loader.js?pkg=full';
        $rem2giseMapJsPath = 'https://maps.api.2gis.ru/2.0/loader.js?pkg=full';
        break;
    }

    if ( $domen == 'localhost' ):
        $jquery_js_path     = $locJqueryJsPath;
        $jquery_ui_js_path  = $theme_uri.'/includes-javascripts/jqueryUi/jquery-ui-1.11.0.min.js';
        $jquery_ui_css_path = $theme_uri.'/includes-javascripts/jqueryUi/jquery-ui-1.11.0.css';
        $yandex_map_js_path = $locYandexMapJsPath;
        $google_map_js_path = $loc2gisMapJsPath;
        $gis_map_js_path = $locGoogleMapJsPath;
        $gis_map_js_path = $rem2giseMapJsPath;
    else:
        $jquery_js_path     = $remJqueryJsPath;
        $jquery_ui_js_path  = 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js';
        $jquery_ui_css_path = 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css';
        $yandex_map_js_path = $remYandexMapJsPath;
        $google_map_js_path = $remGoogleMapJsPath;
        $gis_map_js_path = $locGoogleMapJsPath;
        $gis_map_js_path = $rem2giseMapJsPath;
    endif;

    // Подключаем jquery
    wp_deregister_script('jquery');
    wp_register_script('jquery', ($jquery_js_path), false, $options['jquery-version'], true);
    wp_enqueue_script('jquery');

	// мой скрипт
	wp_enqueue_script( 'custom-srcipt', $theme_uri.'/javascripts/script.js', ['jquery'], false, true );

	// мои стили
	wp_enqueue_style( 'scss-style', $theme_uri.'/css/style.css' );




    if ( $options['jquery-ui'] ):
        // jquery-ui
        wp_enqueue_style('jquery-ui-css',$jquery_ui_css_path);
        wp_enqueue_script( 'jquery-ui', $jquery_ui_js_path, false, false, true );
    endif;

    if ( $options['maps'] == 'yandex' ):
        // API Яндекс карт
        wp_enqueue_script( 'yandex-map', $yandex_map_js_path, false, false, true );
    endif;

    if ( $options['maps'] == 'google' ):
        // API Яндекс карт
        wp_enqueue_script( 'google-map', $google_map_js_path, false, false, true );
    endif;

  if ( $options['maps'] == '2gis' ):
    // API 2GIS карт
    wp_enqueue_script( '2gis-map', $gis_map_js_path, false, false, true );
  endif;

}

function add_async_defer_attribute($tag, $handle) {
    if ( 'google-map' !== $handle )
        return $tag;
    return str_replace( ' src', ' async="async" defer="defer" src', $tag );
}


