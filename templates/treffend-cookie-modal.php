<?php

/**
 * The Template for the cookie settings modal.
 *
 * This template can be overridden by copying it to yourtheme/treffendcookies/treffend-cookie-modal.php.
 *
 * HOWEVER, on occasion Treffend & Co will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * 
 * For the working of the template, please do not remove the lines that have an ID set on it. 
 * Because the plugin uses these ID's to interact with the elements.
 *
 * @see https://trefdev.nl/treffendcookies/docs/templating/ TO DO: add docs
 * @package TreffendCookiess\Templates
 * @version 1.0.0
 */
defined('ABSPATH') || exit;

// Get ACF fields
$modal_title = get_field('treffend_cookie-modal_title', 'option') ?: 'Cookie Instellingen';
$modal_description = get_field('treffend_cookie-modal_description', 'option') ?: 'Kies welke cookies u wilt accepteren. U kunt uw voorkeuren op elk moment wijzigen.';
$privacy_link_field = get_field('treffend_cookie-privacy_link', 'option');
$cookie_policy_link_field = get_field('treffend_cookie-cookie_policy_link', 'option');
$button_save = get_field('treffend_cookie-button_save', 'option') ?: 'Opslaan';
$button_accept_all = get_field('treffend_cookie-button_accept_all', 'option') ?: 'Alles Accepteren';
$button_reject_all = get_field('treffend_cookie-button_reject_all', 'option') ?: 'Alles Weigeren';

// Handle ACF link field (can be array or string for backwards compatibility)
$privacy_link = is_array($privacy_link_field) ? ($privacy_link_field['url'] ?? '') : ($privacy_link_field ?? '');
$privacy_link_title = is_array($privacy_link_field) ? ($privacy_link_field['title'] ?? 'Privacyverklaring') : 'Privacyverklaring';
$privacy_link_target = is_array($privacy_link_field) ? ($privacy_link_field['target'] ?? '_blank') : '_blank';

$cookie_policy_link = is_array($cookie_policy_link_field) ? ($cookie_policy_link_field['url'] ?? '') : ($cookie_policy_link_field ?? '');
$cookie_policy_link_title = is_array($cookie_policy_link_field) ? ($cookie_policy_link_field['title'] ?? 'Cookiebeleid') : 'Cookiebeleid';
$cookie_policy_link_target = is_array($cookie_policy_link_field) ? ($cookie_policy_link_field['target'] ?? '_blank') : '_blank';

// Get category configurations
$analytics_category = get_field('treffend_cookie-category_analytics', 'option');
$marketing_category = get_field('treffend_cookie-category_marketing', 'option');
$preferences_category = get_field('treffend_cookie-category_preferences', 'option');

// Set defaults if not configured
$analytics_title = $analytics_category['title'] ?? 'Analytics';
$analytics_desc = $analytics_category['description'] ?? 'Deze cookies helpen ons te begrijpen hoe bezoekers onze website gebruiken door informatie te verzamelen en te rapporteren.';

$marketing_title = $marketing_category['title'] ?? 'Marketing';
$marketing_desc = $marketing_category['description'] ?? 'Deze cookies worden gebruikt om advertenties te tonen die relevant zijn voor u en uw interesses.';

$preferences_title = $preferences_category['title'] ?? 'Voorkeuren';
$preferences_desc = $preferences_category['description'] ?? 'Deze cookies onthouden uw voorkeuren en instellingen om uw ervaring te personaliseren.';

?>

<!-- Cookie Settings Modal -->
<div class="cookie-modal" id="cookie-settings-modal" role="dialog" aria-labelledby="cookie-modal-title" aria-describedby="cookie-modal-description" aria-modal="true" aria-hidden="true">
    <div class="cookie-modal__overlay" id="cookie-modal-overlay" aria-hidden="true"></div>
    <div class="cookie-modal__container" role="document">
        <div class="cookie-modal__header">
            <h2 class="cookie-modal__title" id="cookie-modal-title"><?= esc_html($modal_title); ?></h2>
            <button 
                class="cookie-modal__close" 
                id="cookie-modal-close" 
                type="button"
                aria-label="Sluit cookie instellingen"
                title="Sluit cookie instellingen (Escape)">
                <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <div class="cookie-modal__content">
            <p class="cookie-modal__description" id="cookie-modal-description">
                <?= wp_kses_post($modal_description); ?>
            </p>
            
            <?php if ($privacy_link || $cookie_policy_link): ?>
            <div class="cookie-modal__links">
                <?php if ($privacy_link): ?>
                    <a href="<?= esc_url($privacy_link); ?>" class="cookie-modal__link" target="<?= esc_attr($privacy_link_target); ?>" rel="noopener noreferrer">
                        <?= esc_html($privacy_link_title); ?>
                    </a>
                <?php endif; ?>
                <?php if ($cookie_policy_link): ?>
                    <a href="<?= esc_url($cookie_policy_link); ?>" class="cookie-modal__link" target="<?= esc_attr($cookie_policy_link_target); ?>" rel="noopener noreferrer">
                        <?= esc_html($cookie_policy_link_title); ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <div class="cookie-modal__categories" role="group" aria-labelledby="cookie-modal-title">
                <!-- Necessary Category (always enabled, not toggleable) -->
                <div class="cookie-category cookie-category--necessary">
                    <div class="cookie-category__header">
                        <h3 class="cookie-category__title">Noodzakelijk</h3>
                        <span class="cookie-category__badge" aria-label="Altijd ingeschakeld">Altijd ingeschakeld</span>
                    </div>
                    <p class="cookie-category__description">
                        Deze cookies zijn noodzakelijk voor de werking van de website en kunnen niet worden uitgeschakeld.
                    </p>
                </div>
                
                <!-- Analytics Category -->
                <div class="cookie-category">
                    <div class="cookie-category__header">
                        <h3 class="cookie-category__title"><?= esc_html($analytics_title); ?></h3>
                        <label class="cookie-toggle" for="consent-analytics">
                            <input 
                                type="checkbox" 
                                id="consent-analytics" 
                                name="consent-analytics"
                                class="cookie-toggle__input"
                                aria-label="<?= esc_attr($analytics_title); ?> cookies inschakelen"
                            >
                            <span class="cookie-toggle__slider" aria-hidden="true"></span>
                        </label>
                    </div>
                    <p class="cookie-category__description">
                        <?= esc_html($analytics_desc); ?>
                    </p>
                </div>
                
                <!-- Marketing Category -->
                <div class="cookie-category">
                    <div class="cookie-category__header">
                        <h3 class="cookie-category__title"><?= esc_html($marketing_title); ?></h3>
                        <label class="cookie-toggle" for="consent-marketing">
                            <input 
                                type="checkbox" 
                                id="consent-marketing" 
                                name="consent-marketing"
                                class="cookie-toggle__input"
                                aria-label="<?= esc_attr($marketing_title); ?> cookies inschakelen"
                            >
                            <span class="cookie-toggle__slider" aria-hidden="true"></span>
                        </label>
                    </div>
                    <p class="cookie-category__description">
                        <?= esc_html($marketing_desc); ?>
                    </p>
                </div>
                
                <!-- Preferences Category -->
                <div class="cookie-category">
                    <div class="cookie-category__header">
                        <h3 class="cookie-category__title"><?= esc_html($preferences_title); ?></h3>
                        <label class="cookie-toggle" for="consent-preferences">
                            <input 
                                type="checkbox" 
                                id="consent-preferences" 
                                name="consent-preferences"
                                class="cookie-toggle__input"
                                aria-label="<?= esc_attr($preferences_title); ?> cookies inschakelen"
                            >
                            <span class="cookie-toggle__slider" aria-hidden="true"></span>
                        </label>
                    </div>
                    <p class="cookie-category__description">
                        <?= esc_html($preferences_desc); ?>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="cookie-modal__footer">
            <div class="cookie-modal__actions">
                <button 
                    type="button" 
                    class="cookie-modal__button cookie-modal__button--secondary" 
                    id="btn-reject-all-modal"
                    aria-label="Weiger alle optionele cookies">
                    <?= esc_html($button_reject_all); ?>
                </button>
                <button 
                    type="button" 
                    class="cookie-modal__button cookie-modal__button--primary" 
                    id="btn-accept-all-modal"
                    aria-label="Accepteer alle cookies">
                    <?= esc_html($button_accept_all); ?>
                </button>
                <button 
                    type="button" 
                    class="cookie-modal__button cookie-modal__button--primary" 
                    id="btn-save-preferences"
                    aria-label="Sla cookie voorkeuren op">
                    <?= esc_html($button_save); ?>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Screen reader live region for status updates -->
    <div class="sr-only" id="cookie-modal-status" role="status" aria-live="polite" aria-atomic="true"></div>
</div>

