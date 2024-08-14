<?php
/*
Plugin Name: Treffend Cookies
Plugin URI: https://treffendenco.nl
Description: This plugin adds a cookie banner to your WordPress site. It works with Google Consent mode v2.
Version: 1.0.0
Author: Harm van de Kraats
Author URI: https://treffendenco.nl
License: GPL2
*/

defined('ABSPATH') || exit;

// Define plugin version
define('TREFFENDCOOKIE_PLUGIN_VERSION', '1.0.0');
define('PLUGIN_DIR', WP_PLUGIN_DIR . '/cookies');

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-assets.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-public.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-acf.php';

// Initialize the plugin
function init_treffend_cookies() {
    Treffend_Cookies_Assets::init();
    Treffend_Cookies_Admin::init();
    Treffend_Cookies_Public::init();
    Treffend_Cookies_ACF::init();
}
add_action('plugins_loaded', 'init_treffend_cookies');
