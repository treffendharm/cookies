<?php

class Treffend_Cookies_Admin
{

    public static function init()
    {
        add_action('admin_notices', [__CLASS__, 'acf_notice']);
    }

    public static function acf_notice()
    {
        $plugin = 'advanced-custom-fields-pro/acf.php';
        if (file_exists(TREFFENDCOOKIES_PLUGIN_DIR . '/' . $plugin) && !is_plugin_active($plugin)) {
            $activation_url = wp_nonce_url('plugins.php?action=activate&plugin=' . $plugin . '&plugin_status=all&paged=1&s', 'activate-plugin_' . $plugin);
?>
            <div class="notice notice-error is-dismissible">
                <p><?php _e('Treffend Cookies plugin requires Advanced Custom Fields Pro to be installed and activated. It is mainly used for configuring this plugin.', 'treffend-cookies'); ?></p>
                <p><a href="<?= esc_url($activation_url); ?>"><?php _e('Click here to activate Advanced Custom Fields Pro.', 'treffend-cookies'); ?></a></p>
            </div>
        <?php
        }
    }
}
