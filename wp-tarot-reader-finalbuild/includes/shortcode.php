<?php
if (!defined('ABSPATH')) exit;
function tarot_draw_shortcode($atts) {
    ob_start(); ?>
    <div class="tarot-wrap" id="tarot-wrap">
        <h3 class="tarot-title">カードを1枚引いてみましょう</h3>
        <button class="tarot-button" id="draw-tarot">🔮 占う</button>
        <div id="tarot-result"></div>
    </div>
<?php return ob_get_clean(); }
add_shortcode('tarot_draw', 'tarot_draw_shortcode');
function tarot_auto_insert_shortcode($content) {
    if (is_singular('tarot_fortune')) {
        return $content . do_shortcode('[tarot_draw]');
    }
    return $content;
}
add_filter('the_content', 'tarot_auto_insert_shortcode');