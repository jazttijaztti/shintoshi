<a href="<?= esc_url(get_permalink(get_option('selected_entry_link'))); ?>" class="entry-banner layout-entry-banner layout-entry-banner--sub mouse-stalker-target" data-text="ENTRY" >
    <div class="entry-banner__img-wrapper js-parallax-img">
        <img  src="<?= get_template_directory_uri(); ?>/assets/images/common/entry_bg_pc.webp" alt="" loading="lazy" />
    </div>
    <div class="entry-banner__inner">
        <h2 class="entry-banner__content title">
            <span class="title__main title__main--entry">ENTRY</span>
        </h2>
        <p class="entry-banner__text">エントリーはこちら</p>
        <div class="entry-banner__diamond"></div>
    </div>
</a>