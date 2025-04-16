<?php
if (!defined('ABSPATH')) exit;

function wp_tarot_register_card_post_type() {
    register_post_type('tarot_card', [
        'labels' => [
            'name' => 'カード管理',
            'singular_name' => 'タロットカード'
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'thumbnail'],
        'rewrite' => ['slug' => 'tarot_card'], // 
        'publicly_queryable' => true,          // 
        'menu_icon' => 'dashicons-images-alt2'
    ]);
}
add_action('init', 'wp_tarot_register_card_post_type');
