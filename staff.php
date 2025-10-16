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
              <span class="title__sub"><?= get_option('general_member_text'); ?></span><br />
              <span class="title__main"><?= get_option('general_member_title_text'); ?></span>
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
                  <?php
                    $selected_posts = (array) get_option('selected_blogs_on_business', []);

                    if (!empty($selected_posts)) :
                        $posts = get_posts([
                            'post_type' => 'post',
                            'post__in'  => $selected_posts,
                            'orderby'   => 'post__in',
                            'numberposts' => 2
                        ]);

                        $i = 0;
                        foreach ($posts as $post) :
                            setup_postdata($post);
                            $i++;
                            $class = ($i === 1) ? 'environment__left' : 'environment__right';
                            ?>
                            <a class="sub-<?= esc_attr($class); ?>" href="<?= esc_url(get_permalink($post->ID)); ?>">
                                <?php if ($i === 2) : ?>
                                    <div class="line-horizontal u-mobile"></div>
                                <?php endif; ?>

                                <div class="sub-environment__image">
                                    <img src="<?= esc_url(get_field('thumbnail_pc', $post->ID)); ?>"
                                        alt="<?= esc_attr(get_the_title($post->ID)); ?>" />
                                </div>
                                <div class="sub-environment__link">
                                <div class="sub-environment__wrap">
                                    <div class="sub-environment__text-wrap">
                                        <span class="sub-environment__text-sub"><?= esc_html(get_field('subtitle', $post->ID)); ?></span>
                                        <span class="sub-environment__text">
                                            <?= esc_html(get_the_title($post->ID)); ?></span>
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

        <?php
        get_template_part('aside-blog');
        ?>
      <?php get_template_part('aside-entry'); ?>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
