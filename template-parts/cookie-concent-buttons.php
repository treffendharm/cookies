<?php
// Default buttons template
?>

<?php
$button_settings = get_field('treffend_cookie-button_settings', 'option') ?: 'Cookie Instellingen';
?>

<div class="inner-buttons">
    <?php if ($button = get_field('treffend_cookie-button_accept', 'option')): ?>
        <a id="btn-accept-all" class="btn btn-accept" href="#accept" role="button" aria-label="Accepteer alle cookies">
            <?= $button; ?>
        </a>
    <?php endif; ?>

    <?php if ($button = get_field('treffend_cookie-button_decline', 'option')): ?>
        <a id="btn-reject-all" class="btn btn-decline" href="#decline" role="button" aria-label="Weiger alle cookies">
            <?= $button; ?>
        </a>
    <?php endif; ?>
</div>

<a id="btn-cookie-settings" class="btn btn-settings" href="#settings" role="button" aria-label="Open cookie instellingen">
    <?= esc_html($button_settings); ?>
</a>