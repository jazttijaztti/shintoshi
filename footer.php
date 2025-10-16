<footer class="footer">
    <div class="footer__inner">
        <nav class="footer__nav">
            <div class="footer__logo">
            <img src="<?= wp_get_attachment_url(get_option('general_footer_image_logo')); ?>" alt="" loading="lazy"/>
            <small class="footer__logo-text" ><?= get_option('general_footer_logo_text'); ?></small>
            </div>

            <div class="footer__nav-block">
                <ul class="footer__nav-list">
                    <li class="footer__nav-item"><a href="<?= home_url(); ?>"><?= get_option('general_footer_menu_1_text'); ?></a></li>
                </ul>
                <ul class="footer__nav-list">
                    <li class="footer__nav-item"><a href="<?= home_url() . "/business/"; ?>"><?= get_option('general_footer_menu_2_text'); ?></a></li>
                    <li class="footer__nav-item"><a href="<?= home_url() . "/staff/"; ?>"><?= get_option('general_footer_menu_3_text'); ?></a></li>
                </ul>
            </div>

            <div class="footer__nav-block">
                <ul class="footer__nav-list">
                    <li class="footer__nav-item"><?= get_option('general_footer_menu_4_text'); ?></li>
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
                        while ($jobs_query->have_posts()) : $jobs_query->the_post(); ?>
                        <li class="footer__nav-subitem"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></li>
                    <?php endwhile; else : echo '記事がありません。'; endif; wp_reset_postdata(); ?>
                </ul>
                <ul class="footer__nav-list">
                    <li class="footer__nav-item"><?= get_option('general_footer_menu_5_text'); ?></li>
                    <?php
                    $selected_posts = (array) get_option('selected_blogs_on_top_page', []);
                    if (!empty($selected_posts)) :
                        $posts = get_posts([
                            'post_type' => 'post',
                            'post__in'  => $selected_posts,
                            'orderby'   => 'post__in',
                            'numberposts' => 2
                        ]);
                        foreach ($posts as $post) : ?>
                            <li class="footer__nav-subitem">
                                <a href="<?= esc_url(get_permalink($post->ID)); ?>"><?= esc_attr(get_the_title($post->ID)); ?></a>
                            </li>
                    <?php endforeach; wp_reset_postdata(); endif; ?>
                </ul>
            </div>
            <ul class="footer__nav-list">
                <li class="footer__nav-item">
                    <a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>"><?= get_option('general_footer_menu_6_text'); ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="footer__bottom">
        <div class="footer__link-group">
            <a href="<?= home_url() . "/corporate/"; ?>" class="footer__link"><?= get_option('general_footer_menu_7_text'); ?></a>
            <a href="<?= home_url() . "/privacy-policy/"; ?>" class="footer__link"><?= get_option('general_footer_menu_8_text'); ?></a>
        </div>
        <small class="footer__copyright"><?= get_option('general_footer_text'); ?></small>
    </div>
    <div class="footer__line">
        <svg viewBox="0 0 934 934">
            <path class="footer__line-top" d="M0 0 L934 0" />
            <path class="footer__line-left" d="M0 934 L0 0" />
        </svg>
    </div>
</footer>