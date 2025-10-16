<?php
/**
 * Template Name: プライバシーポリシー / Privacy Policy
 */
?>
<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => 'プライバシーポリシー',
    'description' => 'プライバシーポリシー Desc'
]);
get_header(); ?>
  <body>
    <?php get_sidebar('topmenu'); ?>
    <main>
        <section class="single-blog layout-single-blog">
          <div class="sub-business__inner scroll-target">
            <div class="sub-business__content">
              <h1 class="sub-business__title title">
                <span class="title__sub">Privacy Policy</span><br />
                <span class="title__main">プライバシーポリシー</span>
              </h1>
            </div>
          </div>
          <div class="single-blog__content-wrap single-blog__content-wrap--margin">
            <div class="single-blog__content">
              <?= the_content(); ?>
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
