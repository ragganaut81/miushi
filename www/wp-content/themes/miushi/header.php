<?php

  $theme      = get_template_directory();
  $theme_uri  = get_template_directory_uri();

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0;">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link href="<?php echo $theme_uri; ?>/images/fav/apple-icon-180x180.png" rel="apple-touch-icon" sizes="180x180">
    <link href="<?php echo $theme_uri; ?>/images/favicon.png" rel="icon" type="image/png" sizes="64x64">
    <link href="<?php echo $theme_uri; ?>/images/fav/favicon-16x16.png" rel="icon" type="image/png" sizes="16x16">
    <link href="<?php echo $theme_uri; ?>/images/fav/manifest" rel="manifest">
    <link href="<?php echo $theme_uri; ?>/images/fav/safari-pinned-tab.svg" rel="mask-icon" color="#5bbad5">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:700&display=swap&subset=cyrillic" rel="stylesheet">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <?php wp_head(); ?>
  </head>

  <?php
    $logo        = get_field('logo', 'options');
    $address     = get_field('address', 'options');
    $timetable   = get_field('timetable', 'options');
    $phone       = get_field('phone', 'options');
    $email       = get_field('email', 'options');
  ?>

  <body <?php body_class(); ?>>
    <header class="header">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img class="header__logo" src="<?php echo $logo['url'] ?>" width="190" height="69" alt="<?php echo $logo['alt'] ?>">
          </div>
          <div class="col-3">
            <div class="header__address">
              <span class="header__icon header__icon--address" style="background-image: url(<?php echo $theme_uri; ?>/images/maps-and-flags.png);"></span><?php echo $address ?>
            </div>
          </div>
          <div class="col-3">
            <a class="header__mail" href="mailto:<?php echo $email ?>">
              <span class="header__icon header__icon--mail" style="background-image: url(<?php echo $theme_uri; ?>/images/mail.png);"></span><?php echo $email ?>
            </a>
          </div>
          <div class="col-2 header__tel-container">
            <a class="header__tel" href="tel:<?php echo phone_clear( $phone ) ?>"><?php echo $phone ?></a>
            <div class="header__time"><?php echo $timetable ?></div>
          </div>
          <div class="col-2">
            <a class="header__feedback-button" href="#">Обратный звонок</a>
          </div>
        </div>
        <nav class="header__nav">
          <div class="row justify-content-between">
            <ul class="header__site-list row">
              <li>
                <a class="header__item" href="#">Меню</a>
              </li>
              <li>
                <a class="header__item" href="#">Акции и скидки</a>
              </li>
              <li>
                <a class="header__item" href="#">Доставка и оплата</a>
              </li>
              <li>
                <a class="header__item" href="#">Новости</a>
              </li>
              <li>
                <a class="header__item" href="#">Контакты</a>
              </li>
            </ul>
            <ul class="header__user-list row">
              <li>
                <a class="header__item header__user-item" href="#">
                  <span class="header__icon header__icon--profile" style="background-image: url(<?php echo $theme_uri; ?>/images/user.png);"></span>Кабинет
                </a>
              </li>
              <li>
                <a class="header__item header__user-item" href="#">
                  <span class="header__icon header__icon--cart" style="background-image: url(<?php echo $theme_uri; ?>/images/cart.png);"></span>Корзина
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
