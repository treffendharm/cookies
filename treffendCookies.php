<?php
/*
Plugin Name: Treffend Cookies
Plugin URI: https://github.com/treffendharm/cookies
Description: This plugin adds a cookie banner to your WordPress site. It works with Google Consent mode v2.
Version: 2.0.0
Author: Treffend & Co - Harm van de Kraats
Author URI: https://treffendenco.nl
License: GPL2
*/

defined('ABSPATH') || exit;

// Define plugin version
define('TREFFENDCOOKIE_PLUGIN_VERSION', '2.0.0');
define('TREFFENDCOOKIES_PLUGIN_DIR', WP_PLUGIN_DIR . '/cookies');
define('TREFFENDCOOKIE_TEMPLATES_DIR', TREFFENDCOOKIES_PLUGIN_DIR . '/templates/');
define('TREFFENDCOOKIE_TEMPLATEPART_DIR', TREFFENDCOOKIES_PLUGIN_DIR . '/template-parts/');


/**
 * Retrieves and includes a template file for the treffend_cookie_get_template function.
 *
 * @param string $template_name The name of the template file to retrieve.
 * @param array $args Optional. An array of arguments to pass to the template file.
 * @return void
 */
function treffend_cookie_get_template($template_name, $args = array())
{
    if (! empty($args) && is_array($args)) {
        extract($args);
    }

    $theme_template = locate_template("treffendcookies/{$template_name}");

    if ($theme_template) {
        include $theme_template;
    } else {
        include TREFFENDCOOKIE_TEMPLATES_DIR . $template_name;
    }
}




// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-assets.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-public.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-treffend-cookies-acf.php';
// actions
require_once plugin_dir_path(__FILE__) . 'includes/actions.php';

// Initialize the plugin
function init_treffend_cookies()
{
    Treffend_Cookies_Assets::init();
    Treffend_Cookies_Admin::init();
    Treffend_Cookies_Public::init();
    Treffend_Cookies_ACF::init();
}
add_action('plugins_loaded', 'init_treffend_cookies');


// Add settings link to the plugin
function my_plugin_settings($settings)
{
    $settings[] = '<a href="' . get_admin_url(null, 'options-general.php?page=cookie-options') . '">Settings</a>';
    $settings[] = '<a href="https://github.com/treffendharm/cookies/issues" target="_blank">Bugs</a>';
    return $settings;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_settings');


// TODO: add docs
// TODO: add automatic updater