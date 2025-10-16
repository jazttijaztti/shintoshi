<?php
/**
 * Template Name: コーポレートサイト / corporate
 */
?>
<!DOCTYPE html>
<html lang="ja">
<?php
set_query_var('tdk', [
    'title' => 'コーポレートサイト',
    'description' => 'コーポレートサイト Desc'
]);
get_header(); ?>
  <body>
    <?php get_sidebar('topmenu'); ?>
    <main>
        <section class="single-blog layout-single-blog">
          <?= the_content(); ?>
        </section>
        <div class="single-blog layout-single-blog">
          <?php get_template_part('aside-entry'); ?>
        </div>
    </main>
    <!-- フッター -->
    <?php get_footer(); ?>
  </body>
</html>
