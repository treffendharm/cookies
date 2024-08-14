<div class="cookie load-from-right load-in-offset-20" id="cookie-consent-banner">
    <span class="title"><?php the_field('treffend_cookie-banner_title', 'option'); ?></span>
    <div><?php the_field('treffend_cookie-banner_text', 'option'); ?></div>
    <div class="buttons">
        <a id="btn-accept-all" class="accept" href="#accept"><?php the_field('treffend_cookie-button_accept', 'option'); ?></a>
        <a id="btn-accept-all" class="decline" href="#decline"><?php the_field('treffend_cookie-button_decline', 'option'); ?></a>
    </div>
</div>


<script>
    function hideBanner() {
        document.getElementById('cookie-consent-banner').style.display = 'none';
    }

    if (localStorage.getItem('consentMode') === null) {

        document.getElementById('btn-accept-all').addEventListener('click', function() {
            setConsent({
                necessary: true,
                analytics: true,
                preferences: true,
                marketing: true
            });
            hideBanner();
        });
        // document.getElementById('btn-accept-some').addEventListener('click', function() {
        //     setConsent({
        //         necessary: true,
        //         analytics: document.getElementById('consent-analytics').checked,
        //         preferences: document.getElementById('consent-preferences').checked,
        //         marketing: document.getElementById('consent-marketing').checked,
        //     });
        //     hideBanner();
        // });
        document.getElementById('btn-reject-all').addEventListener('click', function() {
            setConsent({
                necessary: false,
                analytics: false,
                preferences: false,
                marketing: false
            });
            hideBanner();
        });
        document.getElementById('cookie-consent-banner').style.display = 'block';
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
</script>