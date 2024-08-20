<?php

/**
 * Class Treffend_Cookies_Public
 *
 * This class handles the public functionality of the Treffend Cookies plugin.
 */
class Treffend_Cookies_Public
{
    public static function init()
    {
        add_action('wp_footer', [__CLASS__, 'display_cookie_banner']);
        add_action('wp_head', [__CLASS__, 'add_header_code']);
        add_action('wp_body_open', [__CLASS__, 'add_body_code']);
    }

    public static function display_cookie_banner()
    {
        // Check if the ACF function exists to avoid errors
        if (function_exists('get_field')) {
            // Use the template loader function
            treffend_cookie_get_template('treffend-banner.php');
        }
    }

    public static function add_header_code()
    {
        if (function_exists('get_field')) {
            treffend_cookie_get_template('treffend-head-code.php');
            $code = get_field('treffend_cookie-code_head', 'option');
            echo $code;
        }
    }

    public static function add_body_code()
    {
        if (function_exists('get_field')) {
            $code = get_field('treffend_cookie-code_top_body', 'option');
            echo $code;
        }
    }
}
