<?php
/*
Plugin Name: WP Tarot Reader Final Build
Description: タロット占い投稿・カード管理・背景設定など全機能対応の完全版
Version: 1.0
Author: Dev
*/
defined('ABSPATH') or die('No script kiddies please!');

// 機能別読み込み
require_once plugin_dir_path(__FILE__) . 'includes/card-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/fortune-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/background-meta-box.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax.php';
require_once plugin_dir_path(__FILE__) . 'includes/hide-date.php';
