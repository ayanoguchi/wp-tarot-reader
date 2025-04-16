<?php
if (!defined('ABSPATH')) exit;
function wp_tarot_hide_date_for_fortune($content) {
    if (is_singular('tarot_fortune')) {
        add_filter('the_date', '__return_empty_string');
        add_filter('get_the_date', '__return_empty_string');
    }
    return $content;
}
add_filter('the_content', 'wp_tarot_hide_date_for_fortune', 1);