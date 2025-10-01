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
          <div class="sub-business__inner scroll-target">
            <div class="sub-business__content">
              <h1 class="sub-business__title title">
                <span class="title__sub">corporate</span><br />
                <span class="title__main">コーポレートサイト</span>
              </h1>
            </div>
          </div>
          <div class="single-blog__content-wrap single-blog__content-wrap--margin">
            <h2 class="single-blog__content-title">私の「これまで」</h2>
            <div class="single-blog__content">
              <h3 class="single-blog__content-catch">
                「求められていること」を、<br />
                先回りしてサポートしたい。
              </h3>
            </div>
          </div>

          <div class="single-blog__content-wrap">
            <h2 class="single-blog__content-title">私の「いま」</h2>
            <div class="single-blog__content">
              <h3 class="single-blog__content-catch">
                小さな挑戦を、みんなとともに。<br />
                事業の広がりが、仕事の広がりに。
              </h3>
            </div>
          </div>
          <div class="single-blog__content-wrap">
            <h2 class="single-blog__content-title">私の「これから」</h2>
            <div class="single-blog__content">
              <h3 class="single-blog__content-catch">
                創業時から見てきた、<br />
                自分だからできることを。
              </h3>
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
