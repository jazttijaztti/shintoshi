<header class="header layout-header js-header">
    <div class="header__inner">
        <div class="header__logo">
            <a href="<?= home_url(); ?>">
                <img src="<?= wp_get_attachment_url(get_option('general_image_logo')); ?>" alt="" loading="lazy"/>
                <small class="header__logo-text"><?= get_option('general_logo_text'); ?></small>
            </a>
        </div>

        <nav class="header__nav">
            <ul class="header__nav-list">
                <li class="header__nav-item"><a href="<?= home_url() . "/business/"; ?>" class="header__nav-link">事業紹介</a></li>
                <li class="header__nav-item"><a href="<?= home_url() . "/staff/"; ?>" class="header__nav-link">働く人々</a></li>
                <li class="header__nav-item header__nav-item--has-sub js-has-sub"><a href="#" class="header__nav-link header__nav-link--has-sub">スペシャルコンテンツ<span class="header__icon js-toggle-icon">+</span></a>
                    <ul class="header__sublist">
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
                        <li class="header__subitem"><a href="<?= the_permalink(); ?>" class="header__sub-link"><?= the_title(); ?></a></li>
                    <?php endwhile; else : echo '記事がありません。'; endif; wp_reset_postdata(); ?>
                    </ul>
                </li>
                <li class="header__nav-item header__nav-item--has-sub js-has-sub">
                    <a href="#" class="header__nav-link header__nav-link--has-sub">働く環境・カルチャー<span class="header__icon js-toggle-icon">+</span></a>
                    <ul class="header__sublist">
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
                                <li class="header__subitem">
                                    <a href="<?= esc_url(get_permalink($post->ID)); ?>" class="header__sub-link"><?= esc_attr(get_the_title($post->ID)); ?></a>
                                </li>
                        <?php endforeach; wp_reset_postdata(); endif; ?>
                    </ul>
                </li>
                <li class="header__nav-item"><a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="header__nav-link">募集要項</a></li>
                <li class="header__nav-item header__nav-item--entry entry-button"><a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="entry-button__link">ENTRY</a></li>
            </ul>
        </nav>

        <div class="header__buttons">
            <div class="header__nav-item header__nav-item--entry entry-button">
            <a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="entry-button__link">entry</a>
            </div>
            <button class="header__menu-button js-menu-toggle">
            <span class="header__menu-text">MENU</span>
            <span class="header__menu-icon">
                <span class="header__line"></span>
                <span class="header__line"></span>
                <span class="header__line"></span>
            </span>
            </button>
        </div>
    </div>
</header>

<!-- 1240px以下のドロワー -->
<div class="drawer-overlay js-drawer-overlay"></div>
<div class="drawer js-drawer">
    <button class="drawer__close js-drawer-close">
    <span class="drawer__close-text">CLOSE</span>
    <span class="drawer__close-icon">
        <span class="drawer__close-line"></span>
        <span class="drawer__close-line"></span>
    </span>
    </button>

    <nav class="drawer__nav">
    <div class="drawer__logo">
        <div class="drawer__logo-img">
        <img src="<?= wp_get_attachment_url(get_option('general_image_logo')); ?>" alt="" loading="lazy"/>
        </div>
        <small class="drawer__logo-text"><?= get_option('general_logo_text'); ?></small>
    </div>
    <ul class="drawer__list">
        <li class="drawer__item"><a href="<?= home_url(); ?>" class="drawer__link">トップページ</a></li>
        <li class="drawer__item"><a href="<?= home_url() . "/business/"; ?>" class="drawer__link">事業紹介</a></li>
        <li class="drawer__item"><a href="<?= home_url() . "/staff/"; ?>" class="drawer__link">働く人々</a></li>
        <li class="drawer__item">
            <span class="drawer__item-title">スペシャルコンテンツ</span>
            <ul class="drawer__sublist">
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
                    <li class="drawer__subitem"><a href="<?= the_permalink(); ?>" class="drawer__subitem-link"><?= the_title(); ?></a></li>
                <?php endwhile; else : echo '記事がありません。'; endif; wp_reset_postdata(); ?>
            </ul>
        </li>
        <li class="drawer__item drawer__item--margin">
            <span class="drawer__item-title">働く環境・カルチャー</span>
            <ul class="drawer__sublist">
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
                        <li class="drawer__subitem-subitem">
                            <a href="<?= esc_url(get_permalink($post->ID)); ?>" class="drawer__subitem-link"><?= esc_attr(get_the_title($post->ID)); ?></a>
                        </li>
                <?php endforeach; wp_reset_postdata(); endif; ?>
            </ul>
        </li>
        <li class="drawer__item drawer__item--margin"><a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="drawer__link">募集要項・選考フロー</a></li>
        <li class="drawer__item drawer__item--external-link">
            <ul class="drawer__sublist">
                <li class="drawer__subitem"><a href="<?= home_url() . "/corporate/"; ?>" class="drawer__external-link">コーポレートサイト</a></li>
                <li class="drawer__subitem drawer__subitem--margin"><a href="<?= home_url() . "/privacy-policy/"; ?>" class="drawer__external-link">プライバシーポリシー</a></li>
            </ul>
        </li>
    </ul>
    <div class="drawer__entry entry-button">
        <a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="entry-button__link entry-button__link--drawer">entry</a>
    </div>
    </nav>
</div>

<!-- ENTRY & MENU（780px以下のみ）  -->
<div class="sp-buttons js-sp-buttons">
    <a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="sp-buttons__entry">entry</a>
    <button class="sp-buttons__menu js-menu-toggle">
    <span class="sp-buttons__menu-text">MENU</span>
    <span class="sp-buttons__menu-icon">
        <span class="sp-buttons__line"></span>
        <span class="sp-buttons__line"></span>
        <span class="sp-buttons__line"></span>
    </span>
    </button>
</div>