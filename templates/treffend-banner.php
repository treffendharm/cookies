<?php

/**
 * The Template for the cookie banner structure.
 *
 * This template can be overridden by copying it to yourtheme/treffendcookies/treffend-banner.php.
 *
 * HOWEVER, on occasion Treffend & Co will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * 
 * For the working of the template, please do not remove the lines that have an ID set on it. Because the plugin uses these ID's to interact with the buttons.
 *
 * @see https://trefdev.nl/treffendcookies/docs/templating/ TO DO: add docs
 * @package TreffendCookiess\Templates
 * @version 1.1.0
 */
defined('ABSPATH') || exit;

?>

<div class="cookie <?php the_field('treffend_cookie-banner_style', 'option'); ?>" id="cookie-consent-banner">
    <span class="title"><?= get_field('treffend_cookie-banner_title', 'option'); ?></span>
    <div class="text"><?= get_field('treffend_cookie-banner_text', 'option'); ?></div>
    <div class="buttons">
        <?php do_action('display_cookie_consent_buttons'); ?>
    </div>
</div>