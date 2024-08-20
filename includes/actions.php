<?php

function default_cookie_consent_buttons()
{
    include TREFFENDCOOKIE_TEMPLATEPART_DIR . 'cookie-concent-buttons.php';
}

// Hook the default implementation to the action
add_action('display_cookie_consent_buttons', 'default_cookie_consent_buttons');
