<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    // Always set default consent mode (Dutch law: no tracking cookies before consent)
    // This ensures tracking cookies are NOT placed before user gives consent
    if (localStorage.getItem('consentMode') === null) {
        // Default when no consent is given - deny all except necessary
        gtag('consent', 'default', {
            'ad_storage': 'denied',
            'analytics_storage': 'denied',
            'ad_user_data': 'denied',
            'ad_personalization': 'denied',
            'personalization_storage': 'denied',
            'functionality_storage': 'denied',
            'security_storage': 'denied',
        });
    } else {
        // Load saved consent preferences
        try {
            const savedConsent = JSON.parse(localStorage.getItem('consentMode'));
            gtag('consent', 'default', savedConsent);
        } catch (e) {
            // If parsing fails, deny all
            gtag('consent', 'default', {
                'ad_storage': 'denied',
                'analytics_storage': 'denied',
                'ad_user_data': 'denied',
                'ad_personalization': 'denied',
                'personalization_storage': 'denied',
                'functionality_storage': 'denied',
                'security_storage': 'denied',
            });
        }
    }

    if (localStorage.getItem('userId') != null) {
        // Push user id to dataLayer
        window.dataLayer.push({
            'user_id': localStorage.getItem('userId')
        });
    }
</script>