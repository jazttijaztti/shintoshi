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
        <section class="single-blog layout-single-blog">
          <div class="sub-business__inner scroll-target">
            <div class="sub-business__content">
              <h1 class="sub-business__title title">
                <span class="title__sub">404</span><br />
                <span class="title__main">お探しのページが 見つかりませんでした</span>
              </h1>
            </div>
          </div>
          <div class="single-blog__content-wrap single-blog__content-wrap--margin">
            <div class="single-blog__content">
              <p class="single-blog__content-text">
              お探しのページは見つかりませんでした。一時的にアクセスできない状況にあるか、移動もしくは削除された可能性があります。恐れ入りますが、トップページから目的のページをお探しください。
              </p>
              <a class="business__link arrow-link" href="<?= home_url(); ?>">
                <span class="arrow-link__icon"></span>
                <span class="arrow-link__text">トップページに戻る</span>
              </a>
            </div>
          </div>
        </section>
        <div class="single-blog layout-single-blog">
          <?php get_template_part('aside-entry'); ?>
        </div>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
