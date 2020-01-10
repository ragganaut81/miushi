<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<main>

  <h1 class="sr-only">Интернет-магазин Миюши</h1>

  <section class="slider">

    <?php
      $slider = get_field("bl-slider");
    ?>

    <h2 class="sr-only">Слайдер</h2>

    <ul class="slider__list">

      <?php foreach ($slider as $item): ?>
        <li class="slider__item" style="background-image: url(<?php echo $item['img']['url'] ?>);">
          <div class="container">
            <div class="row">
              <div class="col-6">
                <h3 class="slider__title"><?php echo $item['title'] ?></h3>
                <p class="slider__text"><?php echo $item['text'] ?></p>
                <a class="slider__button button" href="#">Подробнее</a>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <?php
    $goods = get_field("bl-goods");
    foreach ($goods as $item):
  ?>

  <section class="block">

    <div class="container">

      <div class="block__title-container">
        <span class="block__decor block__decor--left" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
        <h2 class="block__title"><?php echo $item['title'] ?></h2>
        <span class="block__decor block__decor--right" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
      </div>

      <div class="block__slider owl-carousel owl-theme">
        <?php
          $posts = get_posts([
            'numberposts' => 0,
            'orderby'     => 'date',
            'order'       => 'ASC',
            'post_type'   => 'goods',
            'post_status' => 'publish',
            'tag'         => $item['cat-mark'] -> slug,
          ]);
          foreach( $posts as $post ):
          $title = get_the_title( $post );
          $img   = get_field( 'img', $post->ID );
          $text  = get_field( 'text', $post->ID );
          $price = get_field( 'price', $post->ID );
        ?>
        <div class="">
          <?php if (has_tag( 'new' )): ?>
          <div class="card card--new">
          <?php elseif (has_tag( 'stock' )): ?>
          <div class="card card--stock">
          <?php else: ?>
          <div class="card">
          <?php endif; ?>
            <div class="card__img" style="background-image: url(<?php echo $img['url']; ?>);"></div>
            <div class="card__content">
              <h3 class="card__title"><?php echo $title; ?></h3>
              <p class="card__text"><?php echo $text; ?></p>
              <span class="card__price"><?php echo moneyformat($price); ?><sup class="card__price-text"> руб.</sup></span>
              <button class="card__btn button">В корзину
                <div class="card__icon-cart">
                  <?php echo file_get_contents($theme_uri."/images/svg/cart.svg"); ?>
                </div>
              </button>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
  </section>

  <?php endforeach ?>

  <section class="extra">
    <div class="container">
      <?php
        $extra = get_field("bl-extra");
        foreach ($extra as $item):
      ?>
      <span class="extra__title extra__title--active"><?php echo $item['cat-mark'] -> name; ?></span>
      <?php endforeach ?>

      <?php foreach ($extra as $item): ?>
        <div class="extra__slider">
          <div class="owl-carousel owl-theme">
            <?php
              $posts = get_posts([
                'numberposts' => 0,
                'orderby'     => 'date',
                'order'       => 'ASC',
                'post_type'   => 'goods',
                'post_status' => 'publish',
                'tag'         => $item['cat-mark'] -> slug,
              ]);
              foreach( $posts as $post ):
              $title = get_the_title( $post );
              $img   = get_field( 'img', $post->ID );
              $text  = get_field( 'text', $post->ID );
              $price = get_field( 'price', $post->ID );
            ?>
            <div class="">
              <div class="card card--new">
                <div class="card__img" style="background-image: url(<?php echo $img['url']; ?>);"></div>
                <div class="card__content">
                <h3 class="card__title"><?php echo $title; ?></h3>
                <p class="card__text"><?php echo $text; ?></p>
                <span class="card__price"><?php echo moneyformat($price); ?><sup class="card__price-text"> руб.</sup></span>
                <button class="card__btn button">В корзину
                  <div class="card__icon-cart">
                    <?php echo file_get_contents($theme_uri."/images/svg/cart.svg"); ?>
                  </div>
                </button>
              </div>
              </div>
            </div>
            <?php endforeach ?>
            <?php wp_reset_query(); ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </section>


<?php wp_footer(); ?>

