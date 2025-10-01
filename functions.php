<?php

// ========================
// イメージロゴ / Logo Image
// ========================
function general_image_logo() {
    // register setting
    register_setting('general', 'general_image_logo');

    // add field
    add_settings_field(
        'general_image_logo',
        'イメージロゴ',
        'general_image_logo_render',
        'general'
    );
}
add_action('admin_init', 'general_image_logo');

// render field
function general_image_logo_render() {
    $image_id = get_option('general_image_logo');
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    ?>
    <div>
        <img id="general_image_logo_preview" src="<?= esc_url($image_url); ?>" style="max-width:150px;<?php if(!$image_url) echo 'display:none;'; ?>" />
        <input type="hidden" id="general_image_logo" name="general_image_logo" value="<?= esc_attr($image_id); ?>" />
        <button type="button" class="button" id="general_image_logo_upload">Upload Image</button>
        <button type="button" class="button" id="general_image_logo_remove" <?php if(!$image_id) echo 'style="display:none;"'; ?>>Remove</button>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#general_image_logo_upload').on('click', function(e){
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#general_image_logo').val(attachment.id);
                $('#general_image_logo_preview').attr('src', attachment.url).show();
                $('#general_image_logo_remove').show();
            });
            frame.open();
        });

        $('#general_image_logo_remove').on('click', function(){
            $('#general_image_logo').val('');
            $('#general_image_logo_preview').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

// ======================
// ロゴテキスト/ Logo Text
// ======================
function general_logo_text() {
    // register setting
    register_setting('general', 'general_logo_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_logo_text',        // ID
        'ロゴテキスト',                // Label
        'general_logo_text_render', // Callback
        'general'                   // Page target
    );
}
add_action('admin_init', 'general_logo_text');

// render field
function general_logo_text_render() {
    $value = get_option('general_logo_text', '');
    ?>
    <textarea id="general_logo_text" name="general_logo_text" rows="2" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <?php
}

// ==================================
// フッターロゴ画像 / Footer Logo Image
// ==================================
function general_footer_image_logo() {
    // register setting
    register_setting('general', 'general_footer_image_logo');

    // add field
    add_settings_field(
        'general_footer_image_logo',
        'フッターロゴ画像',
        'general_footer_image_logo_render',
        'general'
    );
}
add_action('admin_init', 'general_footer_image_logo');

// render field
function general_footer_image_logo_render() {
    $image_id = get_option('general_footer_image_logo');
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    ?>
    <div>
        <img id="general_footer_image_logo_preview" src="<?= esc_url($image_url); ?>" style="max-width:150px;<?php if(!$image_url) echo 'display:none;'; ?>" />
        <input type="hidden" id="general_footer_image_logo" name="general_footer_image_logo" value="<?= esc_attr($image_id); ?>" />
        <button type="button" class="button" id="general_footer_image_logo_upload">Upload Image</button>
        <button type="button" class="button" id="general_footer_image_logo_remove" <?php if(!$image_id) echo 'style="display:none;"'; ?>>Remove</button>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#general_footer_image_logo_upload').on('click', function(e){
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#general_footer_image_logo').val(attachment.id);
                $('#general_footer_image_logo_preview').attr('src', attachment.url).show();
                $('#general_footer_image_logo_remove').show();
            });
            frame.open();
        });

        $('#general_footer_image_logo_remove').on('click', function(){
            $('#general_footer_image_logo').val('');
            $('#general_footer_image_logo_preview').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

// ===================================
// フッターロゴテキスト/ Footer Logo Text
// ===================================
function general_footer_logo_text() {
    // register setting
    register_setting('general', 'general_footer_logo_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_footer_logo_text',        // ID
        'フッターロゴテキスト',                // Label
        'general_footer_logo_text_render', // Callback
        'general'                   // Page target
    );
}
add_action('admin_init', 'general_footer_logo_text');

// render field
function general_footer_logo_text_render() {
    $value = get_option('general_footer_logo_text', '');
    ?>
    <textarea id="general_footer_logo_text" name="general_footer_logo_text" rows="2" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <?php
}

// ====================================
// トップタイトルテキスト / Top Title Text
// ====================================
function general_top_title() {
    // register setting
    register_setting('general', 'general_top_title', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_top_title',        // ID
        'トップタイトルテキスト',           // Label
        'general_top_title_render', // Callback
        'general'                   // Page target
    );
}
add_action('admin_init', 'general_top_title');

// render field
function general_top_title_render() {
    $value = get_option('general_top_title', '');
    ?>
    <textarea id="general_top_title" name="general_top_title" rows="10" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <p class="description">Masukkan teks panjang (misalnya footer note atau custom script).</p>
    <?php
}

// ================================
// スライドテキスト / Top Slider Text
// ================================
function general_slide_text() {
    // register setting
    register_setting('general', 'general_slide_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_slide_text',        // ID
        'スライドテキスト',           // Label
        'general_slide_text_render', // Callback
        'general'                   // Page target
    );
}
add_action('admin_init', 'general_slide_text');

// render field
function general_slide_text_render() {
    $value = get_option('general_slide_text', '');
    ?>
    <textarea id="general_slide_text" name="general_slide_text" rows="10" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <?php
}

// ===============================
// スライドリンク / Top Slider Link
// ===============================
function general_slide_link_setting() {
    register_setting('general', 'general_slide_link', array(
        'type'              => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'default'           => '',
    ));

    add_settings_field(
        'general_slide_link',
        'スライドリンク',
        'general_slide_link_render',
        'general'
    );
}
add_action('admin_init', 'general_slide_link_setting');

// Render field input
function general_slide_link_render() {
    $value = get_option('general_slide_link', '');
    echo '<input type="url" id="general_slide_link" name="general_slide_link" value="' . esc_attr($value) . '" class="regular-text ltr" />';
}

// ===========================================
// フッター著作権テキスト / Footer Copyright Text
// ===========================================
function general_footer_text() {
    register_setting('general', 'general_footer_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    add_settings_field(
        'general_footer_text',          // ID field
        'フッター著作権テキスト',        // Label
        'general_footer_text_render',   // Callback
        'general'                       // Page target
    );
}
add_action('admin_init', 'general_footer_text');

// Render input field
function general_footer_text_render() {
    $value = get_option('general_footer_text', '');
    echo '<input type="text" id="general_footer_text" name="general_footer_text" value="' . esc_attr($value) . '" class="regular-text" />';
}

// =======================================================
// トップページのピックアップブログ / Pick Up Blogs on Top Page
// =======================================================
add_action('admin_init', function() {
    // Register setting
    register_setting('general', 'selected_blogs_on_top_page', [
        'sanitize_callback' => 'sanitize_selected_blogs_on_top_page',
        'default'           => []
    ]);

    // Add field
    add_settings_field(
        'selected_blogs_on_top_page_field',
        'トップページのピックアップブログ',
        'render_selected_blogs_on_top_page_field',
        'general'
    );
});

// Sanitize input
function sanitize_selected_blogs_on_top_page($input) {
    return array_map('intval', (array) $input);
}

// Render field
function render_selected_blogs_on_top_page_field() {
    $posts = get_posts([
        'post_type'   => 'post',
        'numberposts' => -1,
    ]);

    $selected = get_option('selected_blogs_on_top_page', []);

    echo '<select name="selected_blogs_on_top_page[]" multiple size="5" style="min-width:300px;">';
    foreach ($posts as $post) {
        $is_selected = in_array($post->ID, (array) $selected) ? 'selected' : '';
        echo '<option value="'. esc_attr($post->ID) .'" '. $is_selected .'>'. esc_html($post->post_title) .'</option>';
    }
    echo '</select>';
}

// ==============================================================
// ビジネスページのピックアップブログ / Pick Up Blogs on Business Page
// ==============================================================
add_action('admin_init', function() {
    // Register setting
    register_setting('general', 'selected_blogs_on_business', [
        'sanitize_callback' => 'sanitize_selected_blogs_on_business',
        'default'           => []
    ]);

    // Add field
    add_settings_field(
        'selected_blogs_on_business_field',
        'ビジネスページのピックアップブログ',
        'render_selected_blogs_on_business_field',
        'general'
    );
});

// Sanitize input
function sanitize_selected_blogs_on_business($input) {
    return array_map('intval', (array) $input);
}

// Render field
function render_selected_blogs_on_business_field() {
    $posts = get_posts([
        'post_type'   => 'post',
        'numberposts' => -1,
    ]);

    $selected = get_option('selected_blogs_on_business', []);

    echo '<select name="selected_blogs_on_business[]" multiple size="5" style="min-width:300px;">';
    foreach ($posts as $post) {
        $is_selected = in_array($post->ID, (array) $selected) ? 'selected' : '';
        echo '<option value="'. esc_attr($post->ID) .'" '. $is_selected .'>'. esc_html($post->post_title) .'</option>';
    }
    echo '</select>';
}

// ====================
// Special Content Text
// ====================
function general_special_content_text() {
    register_setting('general', 'general_special_content_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    add_settings_field(
        'general_special_content_text',          // ID field
        'Special Content',       // Label
        'general_special_content_text_render',   // Callback
        'general'                       // Page target
    );
}
add_action('admin_init', 'general_special_content_text');

// Render input field
function general_special_content_text_render() {
    $value = get_option('general_special_content_text', '');
    echo '<input type="text" id="general_special_content_text" name="general_special_content_text" value="' . esc_attr($value) . '" class="regular-text" />';
}

// ===============================================
// スペシャルコンテンツタイトル / Special Content Title
// ===============================================
function general_special_content_title_text() {
    register_setting('general', 'general_special_content_title_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    add_settings_field(
        'general_special_content_title_text',          // ID field
        'スペシャルコンテンツタイトル',       // Label
        'general_special_content_title_text_render',   // Callback
        'general'                       // Page target
    );
}
add_action('admin_init', 'general_special_content_title_text');

// Render input field
function general_special_content_title_text_render() {
    $value = get_option('general_special_content_title_text', '');
    echo '<input type="text" id="general_special_content_title_text" name="general_special_content_title_text" value="' . esc_attr($value) . '" class="regular-text" />';
}

// ==================================================
// スペシャルコンテンツ説明 / Special Content Description
// ==================================================
function general_special_content_desc_text() {
    // register setting
    register_setting('general', 'general_special_content_desc_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_special_content_desc_text', // ID
        'スペシャルコンテンツ説明',  // Label
        'general_special_content_desc_text_render', // Callback
        'general' // Page target
    );
}
add_action('admin_init', 'general_special_content_desc_text');

// render field
function general_special_content_desc_text_render() {
    $value = get_option('general_special_content_desc_text', '');
    ?>
    <textarea id="general_special_content_desc_text" name="general_special_content_desc_text" rows="2" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <?php
}

// ====================
// culture Content Text
// ====================
function general_culture_content_text() {
    register_setting('general', 'general_culture_content_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    add_settings_field(
        'general_culture_content_text',          // ID field
        'Culture Content',       // Label
        'general_culture_content_text_render',   // Callback
        'general'                       // Page target
    );
}
add_action('admin_init', 'general_culture_content_text');

// Render input field
function general_culture_content_text_render() {
    $value = get_option('general_culture_content_text', '');
    echo '<input type="text" id="general_culture_content_text" name="general_culture_content_text" value="' . esc_attr($value) . '" class="regular-text" />';
}

// ===============================================
// カルチャーや理念 / Culture Content Title
// ===============================================
function general_culture_content_title_text() {
    register_setting('general', 'general_culture_content_title_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    add_settings_field(
        'general_culture_content_title_text',          // ID field
        'カルチャーや理念',       // Label
        'general_culture_content_title_text_render',   // Callback
        'general'                       // Page target
    );
}
add_action('admin_init', 'general_culture_content_title_text');

// Render input field
function general_culture_content_title_text_render() {
    $value = get_option('general_culture_content_title_text', '');
    echo '<input type="text" id="general_culture_content_title_text" name="general_culture_content_title_text" value="' . esc_attr($value) . '" class="regular-text" />';
}

// ==================================================
// カルチャー説明 / Culture Content Description
// ==================================================
function general_culture_content_desc_text() {
    // register setting
    register_setting('general', 'general_culture_content_desc_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default'           => '',
    ));

    // add field
    add_settings_field(
        'general_culture_content_desc_text', // ID
        'カルチャー説明',  // Label
        'general_culture_content_desc_text_render', // Callback
        'general' // Page target
    );
}
add_action('admin_init', 'general_culture_content_desc_text');

// render field
function general_culture_content_desc_text_render() {
    $value = get_option('general_culture_content_desc_text', '');
    ?>
    <textarea id="general_culture_content_desc_text" name="general_culture_content_desc_text" rows="2" cols="20" class="large-text"><?=
        esc_textarea($value);
    ?></textarea>
    <?php
}

// ============================
// エントリーリンク / Entry Link
// ============================

add_action('admin_init', function() {
    // Register setting
    register_setting('general', 'selected_entry_link', [
        'sanitize_callback' => 'sanitize_selected_entry_link',
        'default'           => 0
    ]);

    // Add field
    add_settings_field(
        'selected_entry_link_field',
        'エントリーリンク',
        'render_selected_entry_link_field',
        'general'
    );
});

// Sanitize input (single value)
function sanitize_selected_entry_link($input) {
    return intval($input);
}

// Render field
function render_selected_entry_link_field() {
    $posts = get_posts([
        'post_type'   => 'post',
        'numberposts' => -1,
    ]);

    $selected = get_option('selected_entry_link', 0);

    echo '<select name="selected_entry_link" style="min-width:300px;">';
    foreach ($posts as $post) {
        $is_selected = ($post->ID == $selected) ? 'selected' : '';
        echo '<option value="'. esc_attr($post->ID) .'" '. $is_selected .'>'. esc_html($post->post_title) .'</option>';
    }
    echo '</select>';
}

// ===================================
// カスタム投稿タイプ：ビジネス / business
// ===================================
function create_custom_post_type_business()
{
  $labels = array(
    'name'               => __('ビジネス'),
    'singular_name'      => __('ビジネス'),
    'menu_name'          => __('ビジネス'),
    'add_new'            => __('新規追加'),
    'add_new_item'       => __('新しいビジネスを追加'),
    'edit'               => __('編集'),
    'edit_item'          => __('ビジネスの編集'),
    'new_item'           => __('新しいビジネス'),
    'view'               => __('表示'),
    'view_item'          => __('ビジネスを表示'),
    'search_items'       => __('ビジネスを検索'),
    'not_found'          => __('ビジネスが見つかりません'),
    'not_found_in_trash' => __('ゴミ箱にビジネスが見つかりません'),
  );
  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'has_archive'         => false,
    'menu_position'       => 5,
    'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions'),
    'rewrite'             => array('slug' => 'business'),
    'show_in_rest'        => true
  );
  register_post_type('business', $args);
}
add_action('init', 'create_custom_post_type_business');

// Handling the business pagination
add_rewrite_rule('business/page/([0-9]+)/?$', 'index.php?pagename=business&paged=$matches[1]', 'top');

// カスタムタクソノミー：ビジネスのカテゴリー / business_category
function create_custom_taxonomy_business_category()
{
  $labels = array(
    'name'              => __('ビジネスカテゴリー'),
    'singular_name'     => __('ビジネスカテゴリー'),
    'search_items'      => __('ビジネスカテゴリーを検索'),
    'all_items'         => __('すべてのビジネスカテゴリー'),
    'parent_item'       => __('親カテゴリー'),
    'parent_item_colon' => __('親カテゴリー:'),
    'edit_item'         => __('ビジネスカテゴリーを編集'),
    'update_item'       => __('ビジネスカテゴリーを更新'),
    'add_new_item'      => __('ビジネスカテゴリーを追加'),
    'new_item_name'     => __('新しいビジネスカテゴリー'),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'business-category'),
    'show_in_rest'      => true
  );
  register_taxonomy('business_category', array('business'), $args);
}
add_action('init', 'create_custom_taxonomy_business_category');

// ================================
// カスタム投稿タイプ：スタッフ / staff
// ================================
function create_custom_post_type_staff()
{
  $labels = array(
    'name'               => __('スタッフ'),
    'singular_name'      => __('スタッフ'),
    'menu_name'          => __('スタッフ'),
    'add_new'            => __('新規追加'),
    'add_new_item'       => __('新しいスタッフを追加'),
    'edit'               => __('編集'),
    'edit_item'          => __('スタッフの編集'),
    'new_item'           => __('新しいスタッフ'),
    'view'               => __('表示'),
    'view_item'          => __('スタッフを表示'),
    'search_items'       => __('スタッフを検索'),
    'not_found'          => __('スタッフが見つかりません'),
    'not_found_in_trash' => __('ゴミ箱にスタッフが見つかりません'),
  );
  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'has_archive'         => false,
    'menu_position'       => 5,
    'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions'),
    'rewrite'             => array('slug' => 'staff'),
    'show_in_rest'        => true
  );
  register_post_type('staff', $args);
}
add_action('init', 'create_custom_post_type_staff');

// Handling the staff pagination
add_rewrite_rule('staff/page/([0-9]+)/?$', 'index.php?pagename=staff&paged=$matches[1]', 'top');