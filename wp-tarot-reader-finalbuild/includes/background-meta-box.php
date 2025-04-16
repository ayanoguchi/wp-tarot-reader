<?php
if (!defined('ABSPATH')) exit;
function wp_tarot_add_background_box() {
    add_meta_box('tarot_background', '背景画像', 'wp_tarot_render_background_field', 'tarot_fortune', 'side');
}
add_action('add_meta_boxes', 'wp_tarot_add_background_box');
function wp_tarot_render_background_field($post) {
    $val = get_post_meta($post->ID, 'tarot_background_url', true);
    echo '<input type="text" name="tarot_background_url" id="tarot_background_url" value="' . esc_attr($val) . '" style="width:100%;" />';
    echo '<button type="button" class="button" id="tarot_upload_bg">画像を選択</button>';
    echo '<div style="margin-top:10px;"><img id="tarot_bg_preview" src="' . esc_attr($val) . '" style="max-width:100%;"></div>';
}
function wp_tarot_save_background($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['tarot_background_url'])) {
        update_post_meta($post_id, 'tarot_background_url', esc_url_raw($_POST['tarot_background_url']));
    }
}
add_action('save_post', 'wp_tarot_save_background');
function wp_tarot_enqueue_admin_assets($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_media();
        wp_enqueue_script('tarot-admin', plugin_dir_url(__FILE__) . '../assets/js/tarot-admin.js', ['jquery'], null, true);

    }
}
add_action('admin_enqueue_scripts', 'wp_tarot_enqueue_admin_assets');
