<head>
<?php wp_head(); ?>
    <?php
    $tdk = get_query_var('tdk', [
        'title' => 'Shintoshi',
        'description' => 'Shintoshi Desc'
    ]);
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <!-- meta情報 -->
    <title><?= $tdk['title'] ?></title>
    <meta name="description" content="<?= $tdk['description'] ?>" />
    <meta name="keywords" content="" />
    <!-- ogp -->
    <meta property="og:title" content="" />
    <meta property="og:type" content="<?= $tdk['title'] ?>" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="<?= $tdk['description'] ?>" />
    <!-- ファビコン -->
    <link rel="”icon”" href="" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" />
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/css/style.css"/>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="<?= get_template_directory_uri(); ?>/assets/js/swiper.js"></script>
    <script defer src="<?= get_template_directory_uri(); ?>/assets/js/script.js"></script>
</head>