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
              <span class="title__sub"><?= get_option('general_business_text'); ?></span><br />
              <span class="title__main"><?= get_option('general_business_title_text'); ?></span>
            </h1>
            <p class="sub-business__text">
              <?= get_option('general_business_desc_text'); ?>
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
