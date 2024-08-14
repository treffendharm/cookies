<?php

class Treffend_Cookies_Assets {

    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
        add_action('wp_head', [__CLASS__, 'add_header_code']);
    }

    public static function enqueue_scripts() {
        wp_enqueue_style('treffend_cookies-style', plugin_dir_url(__FILE__) . '../main.css');
        wp_enqueue_script('treffend_cookies-script', plugin_dir_url(__FILE__) . '../src/js/treffend_cookies.js', ['jquery'], TREFFENDCOOKIE_PLUGIN_VERSION, true);
    }

    public static function add_header_code() {
        echo '<!-- This code is added by the Treffend Cookies plugin -->';
    }
}
