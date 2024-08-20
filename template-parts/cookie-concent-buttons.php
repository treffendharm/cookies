<?php
// Default buttons template
?>

<?php if ($button = get_field('treffend_cookie-button_accept', 'option')): ?>
    <a id="btn-accept-all" class="accept" href="#accept">
        <?= $button; ?>
    </a>
<?php endif; ?>

<?php if ($button = get_field('treffend_cookie-button_decline', 'option')): ?>
    <a id="btn-reject-all" class="decline" href="#decline">
        <?= $button; ?>
    </a>
<?php endif; ?>