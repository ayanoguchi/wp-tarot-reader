<?php
if (!defined('ABSPATH')) exit;
function wp_tarot_register_fortune_post_type() {
register_post_type('tarot_fortune', [
    'labels' => ['name' => 'タロット占い', 'singular_name' => 'タロット占い'],
    'public' => true,
    'has_archive' => true,
    'show_in_rest' => true,
    'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'],
    'taxonomies' => ['category'], // ← これを必ず追加！
    'menu_icon' => 'dashicons-format-status'
]);
}
add_action('init', 'wp_tarot_register_fortune_post_type');
function wp_tarot_add_fortune_meta_boxes() {
    add_meta_box('tarot_meanings', 'カードごとの意味（22枚）', 'wp_tarot_render_meanings', 'tarot_fortune', 'normal');
    add_meta_box('tarot_affiliate', 'アフィリエイトバナー（HTML）', 'wp_tarot_render_affiliate', 'tarot_fortune', 'normal');
}
add_action('add_meta_boxes', 'wp_tarot_add_fortune_meta_boxes');
function wp_tarot_render_meanings($post) {
    $cards = ['fool','magician','high_priestess','empress','emperor','hierophant','lovers',
              'chariot','strength','hermit','wheel_of_fortune','justice','hanged_man','death',
              'temperance','devil','tower','star','moon','sun','judgement','world'];
    foreach ($cards as $card) {
        $val = get_post_meta($post->ID, 'tarot_meaning_' . $card, true);
        echo '<p><label><strong>' . ucfirst(str_replace('_',' ', $card)) . '</strong><br>';
        echo '<textarea name="tarot_meaning_' . $card . '" rows="2" style="width:100%;">' . esc_textarea($val) . '</textarea></label></p>';
    }
}
function wp_tarot_render_affiliate($post) {
    $html = get_post_meta($post->ID, 'tarot_affiliate_html', true);
    echo '<textarea name="tarot_affiliate_html" rows="3" style="width:100%;">' . esc_textarea($html) . '</textarea>';
}
function wp_tarot_save_fortune_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    $cards = ['fool','magician','high_priestess','empress','emperor','hierophant','lovers',
              'chariot','strength','hermit','wheel_of_fortune','justice','hanged_man','death',
              'temperance','devil','tower','star','moon','sun','judgement','world'];
    foreach ($cards as $card) {
        if (isset($_POST['tarot_meaning_' . $card])) {
            update_post_meta($post_id, 'tarot_meaning_' . $card, sanitize_text_field($_POST['tarot_meaning_' . $card]));
        }
    }
    if (isset($_POST['tarot_affiliate_html'])) {
        update_post_meta($post_id, 'tarot_affiliate_html', wp_kses_post($_POST['tarot_affiliate_html']));
    }
}
add_action('save_post', 'wp_tarot_save_fortune_meta');
