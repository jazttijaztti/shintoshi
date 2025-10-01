<div class="swiper js-people-swiper">
    <div class="swiper-wrapper mouse-stalker-target" data-text="VIEW">
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
            <a class="card swiper-slide" href="<?= the_permalink(); ?>">
                <div class="card__image">
                <img src="<?= the_field('thumbnail') ?>" alt=""/>
                </div>
                <div class="card__content">
                <div class="card__text">
                    <span><?= the_field('subtitle') ?></span>
                </div>
                </div>
            </a>
    <?php endwhile;
    else :
        echo '記事がありません。';
    endif;
    wp_reset_postdata();
    ?>
    </div>
</div>