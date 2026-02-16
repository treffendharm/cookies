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
        add_filter('body_class', [__CLASS__, 'add_dev_mode_attribute']);
        add_shortcode('treffend_cookie_settings_link', [__CLASS__, 'cookie_settings_link_shortcode']);
    }
    
    /**
     * Shortcode to display a cookie settings link/button
     * Usage: [treffend_cookie_settings_link] or [treffend_cookie_settings_link text="Cookie Instellingen"]
     */
    public static function cookie_settings_link_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'text' => 'Cookie Instellingen',
            'class' => 'treffend-cookie-settings-link',
            'type' => 'link' // 'link' or 'button'
        ), $atts);
        
        $text = esc_html($atts['text']);
        $class = esc_attr($atts['class']);
        $type = $atts['type'] === 'button' ? 'button' : 'a';
        
        if ($type === 'button') {
            return sprintf(
                '<button type="button" class="%s" onclick="if(typeof window.treffendCookiesOpenModal === \'function\') { window.treffendCookiesOpenModal(); return false; }">%s</button>',
                $class,
                $text
            );
        } else {
            return sprintf(
                '<a href="#" class="%s" onclick="if(typeof window.treffendCookiesOpenModal === \'function\') { window.treffendCookiesOpenModal(); return false; }">%s</a>',
                $class,
                $text
            );
        }
    }
    
    public static function add_dev_mode_attribute($classes)
    {
        if (function_exists('get_field')) {
            $dev_mode = get_field('treffend_cookie-dev_mode', 'option');
            if ($dev_mode) {
                // Add data attribute via inline script in head
                add_action('wp_head', function() {
                    echo '<script>document.body.setAttribute("data-cookie-dev-mode", "true");</script>' . "\n";
                }, 1);
            }
        }
        return $classes;
    }

    public static function display_cookie_banner()
    {
        // Check if the ACF function exists to avoid errors
        if (function_exists('get_field')) {
            // Use the template loader function
            treffend_cookie_get_template('treffend-banner.php');
            // Also load the modal template
            treffend_cookie_get_template('treffend-cookie-modal.php');
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
