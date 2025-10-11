<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => get_option('blogname'),
    'description' => get_option('blogdescription')
]);
get_header(); ?>
  <body>
    <?php get_sidebar('topmenu'); ?>
    <main>
        <div class="main-mv layout-main-mv">
            <div class="main-mv__inner">
            <h1 class="main-mv__title title">
                <!-- <?= get_option('general_top_title'); ?> -->
                <span class="title__main title__main--catch1"
                    style="-webkit-mask-image: url('<?= wp_get_attachment_url(get_option('general_title_image_above')); ?>');
                        mask-image: url('<?= wp_get_attachment_url(get_option('general_title_image_above')); ?>');">
                    <span>人生を、</span>
                </span>
                <br />
                <span class="title__main title__main--catch2"
                    style="-webkit-mask-image: url('<?= wp_get_attachment_url(get_option('general_title_image_bottom')); ?>');
                        mask-image: url('<?= wp_get_attachment_url(get_option('general_title_image_bottom')); ?>');">
                    <span>最大化する。</span>
                </span>
            </h1>
            </div>
            <div class="main-mv__visual is-show">
                <?php $image_slides = SCF::get('top_slider_images', 25);
                if (!empty($image_slides)) : ?>
                <div class="main-mv__image">
                    <?php foreach ($image_slides as $i => $row) :
                        $pc_image = !empty($row['pc_slider_image']) ? wp_get_attachment_image_url($row['pc_slider_image'], 'full') : '';
                        $sp_image = !empty($row['sp_slider_image']) ? wp_get_attachment_image_url($row['sp_slider_image'], 'full') : '';
                        if (!$pc_image && !$sp_image) continue;
                    ?>
                    <picture class="main-mv__scene main-mv__scene--<?= $i+1; ?>">
                    <source media="(min-width:751px)" srcset="<?= esc_url($pc_image); ?>"/>
                    <img src="<?= esc_url($sp_image); ?>" alt="" loading="lazy"/>
                    </picture>
                    <?php endforeach; ?>
                    <div class="main-mv__shade"></div>
                </div>
                <?php endif; ?>
            <div class="main-mv__text">
                <?= get_option('general_slide_text'); ?>
                <a class="main-mv__link arrow-link arrow-link--white" href="<?= get_option('general_slide_link'); ?>" target="_blank">
                <span class="arrow-link__icon"></span>
                <span class="arrow-link__text">詳しくみる</span>
                </a>
            </div>
            </div>
            <div class="main-mv__height-block"></div>
        </div>
        <section class="business layout-business">
            <div class="business__inner">
            <div class="business__content">
                <div class="business__content-left">
                <h2 class="business__title title">
                    <span class="title__sub">our business</span><br />
                    <span class="title__main">事業紹介</span>
                </h2>
                <p class="business__text">
                    創業当時から変わらないことは、「都市空間のあるべき未来を追求する」という揺るぎない企業姿勢。<br />
                    開発・再生・保有を軸に、レジンデンス・オフィスビル・商業施設・宿泊施設と、幅広く展開している事業についてご紹介します。
                </p>
                <a class="business__link arrow-link" href="<?= home_url() . "/business/"; ?>">
                    <span class="arrow-link__icon"></span>
                    <span class="arrow-link__text">詳しくみる</span>
                </a>
                </div>
                <?php
                $args = [
                    'post_type'      => 'business',
                    'post_status'    => 'publish',
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) : ?>
                    <div class="business__gallery">
                        <div class="business__gallery-image">
                            <?php
                            $scene = 1;
                            while ($query->have_posts()) :
                                $query->the_post();

                                $gallery = SCF::get('business_gallery', get_the_ID());
                                $first_image_url = '';

                                if (!empty($gallery) && !empty($gallery[0]['gallery'])) {
                                    $first_image_url = wp_get_attachment_image_url($gallery[0]['gallery'], 'large');
                                }
                                if (!$first_image_url && has_post_thumbnail()) {
                                    $first_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                }
                                if (!$first_image_url) {
                                    continue;
                                }
                                ?>
                                <div class="business__gallery-scene business__gallery-scene--<?= $scene; ?>">
                                    <img src="<?= esc_url($first_image_url); ?>"
                                        alt="<?= esc_attr(get_the_title()); ?>"
                                        loading="lazy" />
                                </div>
                                <?php
                                $scene++;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            </div>
        </section>

        <section class="people layout-people">
            <div class="people__inner">
            <div class="people__wrap">
                <div class="people__content">
                <h2 class="people__title title">
                    <span class="title__sub">member</span><br />
                    <span class="title__main">新都市企画で働く人々</span>
                </h2>
                <p class="people__text">
                    自らの情熱を原動力に、人生を最大化する変革の機会をつかみ取ってきた新都市企画社員へのインタビューをご紹介します。<br />
                    あなたらしく働く未来をイメージするヒントを見つけてみませんか。
                </p>
                <a class="people__arrow-link arrow-link" href="<?= home_url() . "/staff/"; ?>">
                    <span class="arrow-link__icon"></span>
                    <span class="arrow-link__text">詳しくみる</span>
                </a>
                </div>
                <div class="people__slider people-slider">
                <div class="people-slider__controls">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-navigation">
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                    </div>
                </div>
                <?php get_template_part('aside-staff'); ?>
                </div>
            </div>
            </div>
        </section>

        <div class="special-loop layout-special-loop">
            <div class="special-loop__inner scroll-target">
            <div class="line-horizontal"></div>
            <div class="line-horizontal line-horizontal--bottom"></div>
            <ul class="special-loop__list">
                <?php $logos = SCF::get('company_logos', 90); // ID for "Top Page" page
                if (!empty($logos)) :
                    foreach ($logos as $item) : ?>
                        <li class="special-loop__item">
                        <div class="special-loop__img">
                            <img src="<?= wp_get_attachment_image_url($item['company_logo'], 'large'); ?>" alt="<?= esc_attr($item['company_name']); ?>" />
                        </div>
                        <span class="special-loop__text"><?= esc_attr($item['company_name']); ?></span>
                        </li>
                <?php endforeach; endif; ?>
            </ul>
            </div>
        </div>

        <section class="special layout-special">
            <div class="special__inner">
            <div class="special__wrap">
                <h2 class="special__title title">
                <span class="title__sub"><?= get_option('general_special_content_text'); ?></span><br />
                <span class="title__main"><?= get_option('general_special_content_title_text'); ?></span>
                </h2>
                <p class="special__text">
                    <?= get_option('general_special_content_desc_text'); ?>
                </p>
            </div>
            </div>
            <div class="special__gallery">
            <?php
            $jobs_query = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'order' => 'DESC',
                'orderby' => 'ID',
                'posts_per_page' => 10,
                'meta_query' => [
                    [
                        'key'     => 'special_flg',
                        'value'   => '1',
                        'compare' => '=',
                    ]
                ]
            ]);
            if ($jobs_query->have_posts()) :
                $count = 1;
                while ($jobs_query->have_posts()) : $jobs_query->the_post(); ?>
                    <a class="special__content" href="<?= the_permalink(); ?>">
                        <div class="special__image zoom-in scroll-target">
                        <picture>
                            <source media="(min-width:751px)" srcset="<?= the_field('thumbnail_pc') ?>"/>
                            <img src="<?= the_field('thumbnail_sp') ?>" alt="" loading="lazy"/>
                        </picture>
                        <span class="special__number"><?= str_pad($count, 2, '0', STR_PAD_LEFT); ?></span>
                        </div>
                        <div class="special__arrow-link arrow-link arrow-link--small">
                        <span class="arrow-link__icon arrow-link__icon--small"></span>
                        <span class="arrow-link__text arrow-link__text--large"><?= the_title(); ?>
                            <?php if ($subtitle = get_field('subtitle')) : ?>
                                <small>（<?= esc_html($subtitle); ?>）</small>
                            <?php endif; ?>
                        </span>
                        </div>
                    </a>
            <?php $count++; endwhile;
            else :
                echo '記事がありません。';
            endif;
            wp_reset_postdata();
            ?>
            </div>
        </section>

        <section class="environment layout-environment">
            <div class="environment__inner scroll-target">
                <!-- ボーダー要素を追加 -->
                <div class="line-horizontal"></div>

                <div class="environment__wrap">
                    <h2 class="environment__title title">
                    <span class="title__sub"><?= get_option('general_culture_content_text'); ?></span><br />
                    <span class="title__main"><?= get_option('general_culture_content_title_text'); ?></span>
                    </h2>
                    <p class="environment__text">
                        <?= get_option('general_culture_content_desc_text'); ?>
                    </p>
                </div>

                <!-- environment__wrapの下に線を追加 -->
                <div class="environment__content">
                    <!-- コンテンツ下の線 -->
                    <div class="line-horizontal"></div>
                    <?php
                    $selected_posts = (array) get_option('selected_blogs_on_top_page', []);

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

                            <a class="<?= esc_attr($class); ?>" href="<?= esc_url(get_permalink($post->ID)); ?>">
                                <?php if ($i === 2) : ?>
                                    <div class="line-horizontal u-mobile"></div>
                                <?php endif; ?>

                                <div class="environment__image">
                                    <img src="<?= esc_url(get_field('thumbnail', $post->ID)); ?>"
                                        alt="<?= esc_attr(get_the_title($post->ID)); ?>" />
                                </div>
                                <div class="environment__arrow-link arrow-link arrow-link--environment">
                                    <span class="arrow-link__icon arrow-link__icon--environment"></span>
                                    <span class="arrow-link__text arrow-link__text--environment">
                                        <?= esc_html(get_the_title($post->ID)); ?>
                                    </span>
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
                    <div class="line-horizontal line-horizontal--bottom"></div>
                </div>
            </div>
        </section>
        <?php get_template_part('aside-entry'); ?>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
