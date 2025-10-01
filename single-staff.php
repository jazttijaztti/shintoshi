<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => get_the_title(),
    'description' => get_the_title().' Desc'
]);
get_header(); ?>
  <body>
    <?php get_sidebar('topmenu'); ?>

    <div class="line-visual line-visual--single">
      <!-- PC -->
      <svg class="u-desktop" viewBox="0 0 100 100">
        <path class="left-line" d="M10 90 L10 10" />
        <!-- 下から上 -->
        <path class="bottom-line" d="M10 90 L90 90" />
        <!-- 左から右 -->
        <path class="right-line" d="M90 90 L90 10" />
        <!-- 下から上 -->
        <path class="top-line" d="M90 10 L10 10" />
        <!-- 右から左 -->
      </svg>

      <!-- SP -->
      <svg class="u-mobile" viewBox="0 0 100 100">
        <path class="bottom-line" d="M10 10 L90 10" />
        <!-- 左から右 -->
        <path class="right-line" d="M90 90 L90 10" />
        <!-- 下から上 -->
        <path class="top-line" d="M10 90 L90 90" />
        <!-- 左から右 -->
        <path class="left-line" d="M10 10 L10 90" />
        <!-- 上から下 -->
      </svg>
    </div>
    <main>
        <section class="single-blog layout-single-blog">
            <div class="single-blog__inner scroll-target">
            <div class="single-blog__mv">
                <div class="single-blog__wrap">
                <h1 class="single-blog__title title">
                    <span class="title__main">
                        <?= the_title() ?>
                    </span>
                </h1>
                <p class="single-blog__text">
                    <?= the_field('subtitle') ?>
                </p>
                </div>

                <div class="single-blog__image">
                <img src="<?= the_field('thumbnail') ?>" alt="" />
                </div>
            </div>
            </div>
            <?= the_content(); ?>
        </section>


      <div class="single-blog__slider people-slider people-slider-single">
        <?php get_template_part('aside-staff'); ?>
      </div>
      <?php get_template_part('aside-entry'); ?>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
