
function hideBanner() {
    const banner = document.getElementById('cookie-consent-banner');
    if (banner) {
        banner.style.display = 'none';
    }
}

function handleConsentButtonClick(consentOptions) {
    setConsent(consentOptions);
    hideBanner();
}

function setConsent(consent) {
    const consentMode = {
        'functionality_storage': consent.necessary ? 'granted' : 'denied',
        'security_storage': consent.necessary ? 'granted' : 'denied',
        'ad_storage': consent.marketing ? 'granted' : 'denied',
        'analytics_storage': consent.analytics ? 'granted' : 'denied',
        'personalization_storage': consent.preferences ? 'granted' : 'denied',
    };
    gtag('consent', 'update', consentMode);
    localStorage.setItem('consentMode', JSON.stringify(consentMode));
}

if (localStorage.getItem('consentMode') === null) {
    const banner = document.getElementById('cookie-consent-banner');
    const acceptAllButton = document.getElementById('btn-accept-all');
    const acceptSomeButton = document.getElementById('btn-accept-some');
    const rejectAllButton = document.getElementById('btn-reject-all');

    console.log(acceptAllButton);

    if (banner) {
        banner.style.display = 'flex';
    }

    if (acceptAllButton) {
        acceptAllButton.addEventListener('click', function () {
            handleConsentButtonClick({
                necessary: true,
                analytics: true,
                preferences: true,
                marketing: true
            });
        });
    }

    if (acceptSomeButton) {
        acceptSomeButton.addEventListener('click', function () {
            const analyticsChecked = document.getElementById('consent-analytics')?.checked || false;
            const preferencesChecked = document.getElementById('consent-preferences')?.checked || false;
            const marketingChecked = document.getElementById('consent-marketing')?.checked || false;

            handleConsentButtonClick({
                necessary: true,
                analytics: analyticsChecked,
                preferences: preferencesChecked,
                marketing: marketingChecked
            });
        });
    }

    if (rejectAllButton) {
        rejectAllButton.addEventListener('click', function () {
            handleConsentButtonClick({
                necessary: false,
                analytics: false,
                preferences: false,
                marketing: false
            });
        });
    }
}