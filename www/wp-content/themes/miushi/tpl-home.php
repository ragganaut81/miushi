<?php /* Template Name: Home */ ?>

<?php
  $theme      = get_template_directory();
  $theme_uri  = get_template_directory_uri();
?>

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
      <div class="extra__content">
        <div class="extra__top-line">
          <?php
            $extra = get_field("bl-extra");
            foreach ($extra as $item):
          ?>
          <button class="extra__title"><?php echo $item['cat-mark'] -> name; ?></button>
          <?php endforeach ?>
        </div>

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
                <div class="card card--<?php echo $item['cat-mark'] -> slug; ?>">
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
    </div>
  </section>

  <?php
    $features = get_field("bl-features");
  ?>

  <section class="block features">

    <div class="container">

      <div class="block__title-container">
        <span class="block__decor block__decor--left" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
        <h2 class="block__title"><?php echo $features['title'] ?></h2>
        <span class="block__decor block__decor--right" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
      </div>

      <ul class="features__list">
        <?php foreach ($features['list'] as $item): ?>
          <li class="features__item">
            <div class="features__icon" style="background-image: url(<?php echo $theme_uri."/images/icons/icon-features-".$item['icon'].".png" ?>);"></div>
            <div class="features__text"><?php echo $item['text'] ?></div>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  </section>

  <?php
    $reviews = get_field("bl-reviews");
  ?>

  <!-- <section class="block reviews">

    <div class="container">

      <div class="block__title-container">
        <span class="block__decor block__decor--left" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
        <h2 class="block__title"><?php echo $reviews['title'] ?></h2>
        <span class="block__decor block__decor--right" style="background-image: url(<?php echo $theme_uri; ?>/images/title-decor.png);"></span>
      </div>

      <div class="row">
        <div class="col-md-4">

        </div>
      </div>
    </div>
  </section> -->

  <?php
    $feedback = get_field("bl-feedback");
  ?>

  <section class="feedback">

    <h2 class="feedback__title sr-only">Обратная связь</h2>
    <div class="container">
      <div class="feedback__content">
        <p class="feedback__small-text"><?php echo $feedback['small-text'] ?></p>
        <p class="feedback__big-text"><?php echo $feedback['big-text'] ?></p>

        <form class="feedback__form">
          <div class="row">
            <input type="text" name="name" placeholder="Имя" required>
            <input type="text" name="telephone" placeholder="Телефон" required>
            <button class="feedback__button button">Отправить</button>
          </div>
        </form>
        <p class="feedback__text">Нажимая на кнопку «Отправить», вы даете согласие на обработку своих персональных данных.</p>
      </div>
    </div>
  </section>


<?php wp_footer(); ?>

