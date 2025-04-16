<?php
if (!defined('ABSPATH')) exit;
function tarot_enqueue_assets() {
    wp_enqueue_style('tarot-ui', plugins_url('../assets/css/tarot-style.css', __FILE__));
    wp_enqueue_script('tarot-js', plugins_url('../assets/js/tarot.js', __FILE__), ['jquery'], null, true);
    if (is_singular('tarot_fortune')) {
        global $post;
        wp_localize_script('tarot-js', 'tarotAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'post_id' => $post->ID,
            'bg_url' => get_post_meta($post->ID, 'tarot_background_url', true)
        ]);
    }
}
add_action('wp_enqueue_scripts', 'tarot_enqueue_assets');
add_action('wp_ajax_tarot_draw', 'tarot_handle_draw');
add_action('wp_ajax_nopriv_tarot_draw', 'tarot_handle_draw');
function tarot_handle_draw() {
    $jp = ['fool'=>'愚者','magician'=>'魔術師','high_priestess'=>'女教皇','empress'=>'女帝','emperor'=>'皇帝',
           'hierophant'=>'法王','lovers'=>'恋人','chariot'=>'戦車','strength'=>'力','hermit'=>'隠者',
           'wheel_of_fortune'=>'運命の輪','justice'=>'正義','hanged_man'=>'吊るされた男','death'=>'死神',
           'temperance'=>'節制','devil'=>'悪魔','tower'=>'塔','star'=>'星','moon'=>'月','sun'=>'太陽',
           'judgement'=>'審判','world'=>'世界'];
    $post_id = intval($_POST['post_id'] ?? 0);
    $keys = array_keys($jp);
    $selected = $keys[array_rand($keys)];
    $meaning = get_post_meta($post_id, 'tarot_meaning_' . $selected, true);
    $banner = get_post_meta($post_id, 'tarot_affiliate_html', true);
    wp_send_json(['card' => $jp[$selected], 'meaning' => $meaning, 'banner' => $banner]);
}