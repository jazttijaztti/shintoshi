<?php
/**
 * Template Name: 事業紹介 / Business
 */
?>
<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => 'Business list',
    'description' => 'Business Desc'
]);
get_header(); ?>
  <body>
  <?php get_sidebar('topmenu'); ?>
    <main>
      <section class="sub-business layout-sub-business">
        <div class="sub-business__inner scroll-target">
          <div class="sub-business__content">
            <h1 class="sub-business__title title">
              <span class="title__sub">our business</span><br />
              <span class="title__main">事業紹介</span>
            </h1>
            <p class="sub-business__text">
              その街のニーズにあったレジデンス、商業施設、ホテル、オフィス開発などを幅広く展開しています。近年では開発した施設に私たちの想いを吹き込むべく、セルフストレージや、シェアオフィス、インドアゴルフレンジ、都市型サウナなど、新規事業にも着手しています。
            </p>
          </div>
        </div>
      </section>

        <?php
        $terms = get_terms([
            'taxonomy'   => 'business_category',
            'hide_empty' => true,
        ]);
        if (!empty($terms) && !is_wp_error($terms)) :
            foreach ($terms as $term) : ?>
                <section class="sub-property layout-sub-property">
                    <div class="sub-property__inner scroll-target">
                        <div class="line-horizontal"></div>
                        <h2 class="sub-property__title title">
                            <span class="title__main title__main--small"><?= esc_html($term->name); ?></span>
                        </h2>
                        <p class="sub-property__text">
                            <?= esc_html($term->description); ?>
                        </p>

                        <?php
                        $args = [
                            'post_type'      => 'business',
                            'post_status' => 'publish',
                            'order' => 'DESC',
                            'orderby' => 'ID',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'business_category',
                                    'field'    => 'term_id',
                                    'terms'    => $term->term_id,
                                ],
                            ],
                        ];
                        $query = new WP_Query($args);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();?>
                                <div class="sub-property__gallery slider-gallery">
                                    <?php $gallery = SCF::get('business_gallery', get_the_ID());
                                    if (!empty($gallery)) : ?>
                                    <div class="slider-gallery__swiper">
                                        <div class="slider-gallery__wrap">
                                            <?php if (count($gallery) > 1) : ?>
                                            <div class="slider-gallery__controls u-desktop">
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-navigation">
                                                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                                                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="swiper js-sub-property-swiper">
                                                <ul class="swiper-wrapper">
                                                    <?php foreach ($gallery as $item) : ?>
                                                        <li class="swiper-slide">
                                                            <img src="<?= wp_get_attachment_image_url($item['gallery'], 'large'); ?>" alt="" />
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="slider-gallery__content">
                                        <div class="slider-gallery__tab">
                                            <h3 class="slider-gallery__tab-title">
                                                <?= esc_html(get_the_title()); ?>
                                            </h3>
                                        </div>
                                        <?php
                                        $company_logo = SCF::get('company_logo', get_the_ID());
                                        if ($company_logo) : ?>
                                            <div class="slider-gallery__logo">
                                                <img src="<?= wp_get_attachment_image_url($company_logo, 'large'); ?>" alt="" />
                                            </div>
                                        <?php endif; ?>
                                        <p class="slider-gallery__text">
                                            <?= esc_html(get_the_excerpt()); ?>
                                        </p>
                                        <a class="business__link arrow-link" href="<?= the_permalink(); ?>">
                                            <span class="arrow-link__icon"></span>
                                            <span class="arrow-link__text">詳しくみる</span>
                                        </a>
                                    </div>
                                </div>
                        <?php endwhile;
                        else :
                            echo '記事がありません。';
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
        <?php endforeach; endif; ?>

      <!-- <section class="sub-property-renewal layout-sub-property-renewal">
        <div class="sub-property-renewal__inner scroll-target">
          <div class="line-horizontal"></div>
          <h2 class="sub-property-renewal__title title">
            <span class="title__main title__main--small">不動産再生事業</span>
          </h2>

          <div class="sub-property-renewal__gallery">
            <div class="sub-property-renewal__image">
              <img src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp" alt="" />
            </div>
            <div class="sub-property-renewal__content">
              <div class="sub-property-renewal__logo">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/home/logo_standz.webp" alt="" />
              </div>
              <p class="sub-property-renewal__text">
                歴史を受け継ぎながら、人に優しい都市環境、空間を創造する不動産再生を提案します。既存の不動産に対して開発事業で蓄積したノウハウを活かし、快適で機能性の高いリノベーションを施すことで、収益性に優れた収益不動産を提供します。
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="sub-property-holding layout-sub-property-holding">
        <div class="sub-property-holding__inner scroll-target">
          <div class="line-horizontal"></div>
          <h2 class="sub-property-holding__title title">
            <span class="title__main title__main--small">不動産保有事業</span>
          </h2>

          <div class="sub-property__gallery slider-gallery">
            <div class="slider-gallery__swiper">
              <div class="slider-gallery__wrap">
                <div class="slider-gallery__controls u-desktop">
                  <div class="swiper-pagination"></div>
                  <div class="swiper-navigation">
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                  </div>
                </div>
                <div class="swiper js-sub-property-swiper">
                  <ul class="swiper-wrapper">
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-2.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-3.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-4.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-5.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-7.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-8.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-9.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-10.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-11.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-12.webp"
                        alt=""
                      />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="slider-gallery__content">
              <p class="slider-gallery__text slider-gallery__text--margin">
                都心好立地を厳選し、高品質かつ高収益性を強みとした都市型収益レジデンス『STANDZ（スタンズ）』シリーズの開発を手掛けています。
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="sub-property-new layout-sub-property-new">
        <div class="sub-property-new__inner scroll-target">
          <div class="line-horizontal"></div>
          <h2 class="sub-property-new__title title">
            <span class="title__main title__main--small">新規事業</span>
          </h2>
          <p class="sub-property-new__text">
            その都市に暮らす人、働く人、訪れる人、社会に対して新しい価値提供をしていくことで、不動産開発の新しいビジネスモデルを追求したい、そう考える新都市企画では、時代のニーズを先取る新たな事業領域への挑戦を、創業以来続けてきました。近年も新たな事業がスタートしています。
          </p>
          <div class="sub-property-new__gallery slider-gallery">
            <div class="slider-gallery__swiper">
              <div class="slider-gallery__wrap">
                <div class="slider-gallery__controls u-desktop">
                  <div class="swiper-pagination"></div>
                  <div class="swiper-navigation">
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                  </div>
                </div>
                <div class="swiper js-sub-property-swiper">
                  <ul class="swiper-wrapper">
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-2.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-3.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-4.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-5.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-7.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-8.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-9.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-10.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-11.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-12.webp"
                        alt=""
                      />
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="slider-gallery__content">
              <div class="slider-gallery__tab">
                <h3 class="slider-gallery__tab-title">
                  都市型収益レジデンス開発
                </h3>
              </div>
              <div class="slider-gallery__logo">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/home/logo_standz.webp" alt="" />
              </div>
              <p class="slider-gallery__text">
                都心好立地を厳選し、高品質かつ高収益性を強みとした都市型収益レジデンス『STANDZ（スタンズ）』シリーズの開発を手掛けています。
              </p>
            </div>
          </div>
          <div class="sub-property-new__gallery slider-gallery">
            <div class="slider-gallery__swiper">
              <div class="slider-gallery__wrap">
                <div class="slider-gallery__controls u-desktop">
                  <div class="swiper-pagination"></div>
                  <div class="swiper-navigation">
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                  </div>
                </div>
                <div class="swiper js-sub-property-swiper">
                  <ul class="swiper-wrapper">
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-2.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-3.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-4.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-5.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-7.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-8.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-9.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-10.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-6.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-11.webp"
                        alt=""
                      />
                    </li>
                    <li class="swiper-slide">
                      <img
                        src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-12.webp"
                        alt=""
                      />
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="slider-gallery__content">
              <div class="slider-gallery__tab">
                <h3 class="slider-gallery__tab-title">
                  都市型収益レジデンス開発
                </h3>
              </div>
              <div class="slider-gallery__logo">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/home/logo_standz.webp" alt="" />
              </div>
              <p class="slider-gallery__text">
                都心好立地を厳選し、高品質かつ高収益性を強みとした都市型収益レジデンス『STANDZ（スタンズ）』シリーズの開発を手掛けています。
              </p>
            </div>
          </div>
          <div class="sub-property-new__gallery">
            <div class="sub-property-new__image">
              <img src="<?= get_template_directory_uri(); ?>/assets/images/home/development_img1-1.webp" alt="" />
            </div>
            <div class="sub-property-new__content">
              <div class="sub-property-new__logo">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/home/logo_standz.webp" alt="" />
              </div>
              <p class="sub-property-new__text">
                歴史を受け継ぎながら、人に優しい都市環境、空間を創造する不動産再生を提案します。既存の不動産に対して開発事業で蓄積したノウハウを活かし、快適で機能性の高いリノベーションを施すことで、収益性に優れた収益不動産を提供します。
              </p>
            </div>
          </div>
        </div>
      </section> -->

    <section class="sub-environment layout-sub-environment">
        <div class="sub-environment__inner scroll-target">
            <!-- ボーダー要素を追加 -->

            <div class="sub-environment__content">
                <div class="line-horizontal"></div>

                <?php
                $selected_business_posts = (array) get_option('selected_blogs_on_business', []);

                if (!empty($selected_business_posts)) :
                    $posts = get_posts([
                        'post_type'   => 'post',
                        'post__in'    => $selected_business_posts,
                        'orderby'     => 'post__in',
                        'numberposts' => 2
                    ]);

                    $i = 0;
                    foreach ($posts as $post) :
                        setup_postdata($post);
                        $i++;
                        $class = ($i === 1) ? 'sub-environment__left' : 'sub-environment__right';
                        ?>

                        <a class="<?= esc_attr($class); ?>" href="<?= esc_url(get_permalink($post->ID)); ?>">
                            <?php if ($i === 2) : ?>
                                <div class="line-horizontal u-mobile"></div>
                            <?php endif; ?>

                            <div class="sub-environment__image">
                                <img src="<?= esc_url(get_field('thumbnail', $post->ID)); ?>"
                                    alt="<?= esc_attr(get_the_title($post->ID)); ?>" />
                            </div>

                            <div class="sub-environment__link">
                                <div class="sub-environment__wrap">
                                    <div class="sub-environment__text-wrap">
                                        <span class="sub-environment__text-sub">
                                            <?= esc_html(get_field('subtitle', $post->ID)); ?>
                                        </span>
                                        <span class="sub-environment__text">
                                            <?= esc_html(get_the_title($post->ID)); ?>
                                        </span>
                                    </div>
                                    <span class="sub-environment__icon"></span>
                                </div>
                            </div>
                        </a>

                        <?php if ($i === 1) : ?>
                            <!-- 左右の間の縦線 -->
                            <div class="line-vertical line-vertical--center u-desktop"></div>
                        <?php endif; ?>

                    <?php endforeach;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php get_template_part('aside-entry'); ?>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
