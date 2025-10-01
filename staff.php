<?php
/**
 * Template Name: スタッフ / staff
 */
?>
<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => 'Staff list',
    'description' => 'Staff Desc'
]);
get_header(); ?>
  <body>
  <?php get_sidebar('topmenu'); ?>
    <main>
      <section class="sub-business layout-sub-business">
        <div class="sub-business__inner scroll-target">
          <div class="sub-business__content">
            <h1 class="sub-business__title title">
              <span class="title__sub">member</span><br />
              <span class="title__main">新都市企画で働く人々</span>
            </h1>
          </div>
        </div>
      </section>

      <section class="sub-property layout-sub-property">
          <div class="sub-property__inner scroll-target">
              <div class="line-horizontal"></div>
              <?php
              $args = [
                  'post_type'   => 'staff',
                  'post_status' => 'publish',
                  'order'       => 'DESC',
                  'orderby'     => 'ID',
              ];
              $query = new WP_Query($args);

              if ($query->have_posts()) :
                  while ($query->have_posts()) : $query->the_post();?>
                      <div class="sub-property__gallery slider-gallery">
                          <div class="slider-gallery__swiper">
                              <div class="slider-gallery__wrap">
                                  <div class="swiper js-sub-property-swiper">
                                      <ul class="swiper-wrapper">
                                          <li class="swiper-slide">
                                              <img src="<?= the_field('thumbnail') ?>" alt="" />
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <div class="slider-gallery__content">
                            <div class="slider-gallery__tab">
                                <h3 class="slider-gallery__tab-title">
                                    <?= esc_html(the_title()); ?>
                                </h3>
                            </div>
                            <div class="slider-gallery__logo">
                                <img src="<?= the_field('company_logo') ?>" alt="" />
                            </div>
                            <p class="slider-gallery__text">
                              <?= the_field('subtitle') ?>
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
      <section class="sub-environment layout-sub-environment">
          <div class="sub-environment__inner scroll-target">
              <!-- ボーダー要素を追加 -->
              <div class="sub-environment__content">
                  <div class="line-horizontal"></div>
                  <a class="sub-environment__left" href="#">
                      <div class="sub-environment__image">
                      <img src="<?= get_template_directory_uri(); ?>/assets/images/common/culture_img01.webp" alt="" />
                      </div>
                      <div class="sub-environment__link">
                      <div class="sub-environment__wrap">
                          <div class="sub-environment__text-wrap">
                              <span class="sub-environment__text-sub">事業実績一覧をみるdd</span>
                              <span class="sub-environment__text">実績紹介</span>
                          </div>
                          <span class="sub-environment__icon"></span>
                      </div>
                      </div>
                  </a>

                  <!-- 左右の間の縦線 -->
                  <div class="line-vertical line-vertical--center u-desktop"></div>

                  <a class="sub-environment__right" href="#">
                      <div class="line-horizontal u-mobile"></div>
                      <div class="sub-environment__image">
                      <img
                          src="<?= get_template_directory_uri(); ?>/assets/images/common/culture_img02_coming.webp"
                          alt=""/>
                      </div>

                      <div class="sub-environment__link">
                          <div class="sub-environment__wrap">
                              <div class="sub-environment__text-wrap">
                                <span class="sub-environment__text-sub">個性を、解き放つ。<br class="u-mobile"/>それはプロジェクトを知ればよく分かる。</span>
                                <span class="sub-environment__text">プロジェクトストーリー</span>
                              </div>
                              <span class="sub-environment__icon"></span>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </section>

        <?php
        get_template_part('aside-blog');
        ?>
      <?php get_template_part('aside-entry'); ?>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
