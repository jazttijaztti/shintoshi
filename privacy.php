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
              <h3 class="single-blog__content-catch">
                「求められていること」を、<br />
                先回りしてサポートしたい。
              </h3>
              <p class="single-blog__content-text">
                穏やかな風景に囲まれて育った私は、幼少期から「自分の気持ち」に素直に生きてきたように思います。人との関係を大切にしながらも、興味を持ったことには自分なりにこだわる。自分より年少の家族である弟が生まれてからは、「見守るのは私の役割」と勝手にあれこれ世話をやきたがる子供だったようです。いつからか「人が求めていること」を先回りしてサポートすることに、自身の喜びを感じるようになっていました。こうした原体験が、私の価値観を形成する土台になっているのかも知れません。<br />
                高校を卒業した後、ブライダル系の学校に通うために、私は地元を離れることになりました。お客さまに最高の一日を提供できるウェディングプランナーになりたい。華やかな世界に憧れを持ちつつも、仕事として向き合う上での厳しさも知った日々でした。結果としては全くの異業界である当社に入社しましたが、身につけたホスピタリティやマナーに関する知識は無駄ではないと思っています。その当時に取得した秘書検定や色彩検定の資格も、「もしかしたら活かせる場面もあるかも知れない」と今でも思っています。
              </p>
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
