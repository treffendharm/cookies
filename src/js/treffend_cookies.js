/**
 * Treffend Cookies Plugin
 * Handles cookie consent banner and modal functionality
 * WCAG AA compliant and Dutch law compliant
 */

(function() {
    'use strict';

    // Check if dev mode is enabled (set via PHP)
    const devMode = document.body.getAttribute('data-cookie-dev-mode') === 'true';
    
    // Get elements
    const banner = document.getElementById('cookie-consent-banner');
    const modal = document.getElementById('cookie-settings-modal');
    const modalOverlay = document.getElementById('cookie-modal-overlay');
    const modalClose = document.getElementById('cookie-modal-close');
    const settingsButton = document.getElementById('btn-cookie-settings');
    const acceptAllButton = document.getElementById('btn-accept-all');
    const rejectAllButton = document.getElementById('btn-reject-all');
    const acceptAllModalButton = document.getElementById('btn-accept-all-modal');
    const rejectAllModalButton = document.getElementById('btn-reject-all-modal');
    const savePreferencesButton = document.getElementById('btn-save-preferences');
    const statusRegion = document.getElementById('cookie-modal-status');
    
    // Cookie category checkboxes
    const analyticsCheckbox = document.getElementById('consent-analytics');
    const marketingCheckbox = document.getElementById('consent-marketing');
    const preferencesCheckbox = document.getElementById('consent-preferences');
    
    // Focus trap variables
    let focusableElements = [];
    let firstFocusableElement = null;
    let lastFocusableElement = null;
    
    /**
     * Check if consent has been given
     */
    function hasConsent() {
        return localStorage.getItem('consentMode') !== null;
    }
    
    /**
     * Get current consent from localStorage
     */
    function getCurrentConsent() {
        const stored = localStorage.getItem('consentMode');
        if (!stored) return null;
        
        try {
            return JSON.parse(stored);
        } catch (e) {
            return null;
        }
    }
    
    /**
     * Set consent and update Google Consent Mode
     */
    function setConsent(consent) {
        const consentMode = {
            'functionality_storage': consent.necessary ? 'granted' : 'denied',
            'security_storage': consent.necessary ? 'granted' : 'denied',
            'ad_storage': consent.marketing ? 'granted' : 'denied',
            'ad_user_data': consent.marketing ? 'granted' : 'denied',
            'ad_personalization': consent.marketing ? 'granted' : 'denied',
            'analytics_storage': consent.analytics ? 'granted' : 'denied',
            'personalization_storage': consent.preferences ? 'granted' : 'denied',
        };
        
        // Update Google Consent Mode V2
        if (typeof gtag === 'function') {
            gtag('consent', 'update', consentMode);
        }
        
        // Store consent
        localStorage.setItem('consentMode', JSON.stringify(consentMode));
        localStorage.setItem('consentTimestamp', Date.now().toString());
        
        // Announce to screen readers
        announceStatus('Cookie voorkeuren opgeslagen');
    }
    
    /**
     * Get consent from checkboxes
     */
    function getConsentFromCheckboxes() {
        return {
            necessary: true, // Always true, cannot be disabled
            analytics: analyticsCheckbox ? analyticsCheckbox.checked : false,
            marketing: marketingCheckbox ? marketingCheckbox.checked : false,
            preferences: preferencesCheckbox ? preferencesCheckbox.checked : false
        };
    }
    
    /**
     * Load consent into checkboxes
     */
    function loadConsentIntoCheckboxes() {
        const consent = getCurrentConsent();
        if (!consent) {
            // No consent given yet - all optional cookies should be unchecked (Dutch law)
            if (analyticsCheckbox) analyticsCheckbox.checked = false;
            if (marketingCheckbox) marketingCheckbox.checked = false;
            if (preferencesCheckbox) preferencesCheckbox.checked = false;
            return;
        }
        
        // Load saved preferences
        if (analyticsCheckbox) {
            analyticsCheckbox.checked = consent.analytics_storage === 'granted';
        }
        if (marketingCheckbox) {
            marketingCheckbox.checked = consent.ad_storage === 'granted';
        }
        if (preferencesCheckbox) {
            preferencesCheckbox.checked = consent.personalization_storage === 'granted';
        }
    }
    
    /**
     * Hide banner
     */
    function hideBanner() {
        if (banner) {
            banner.style.display = 'none';
            banner.setAttribute('aria-hidden', 'true');
        }
    }
    
    /**
     * Show banner
     */
    function showBanner() {
        if (banner) {
            banner.style.display = 'flex';
            banner.setAttribute('aria-hidden', 'false');
        }
    }
    
    /**
     * Open modal
     */
    function openModal() {
        if (!modal) return;
        
        // Load current consent into checkboxes
        loadConsentIntoCheckboxes();
        
        // Show modal
        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        modalOverlay.setAttribute('aria-hidden', 'false');
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
        
        // Set up focus trap
        setupFocusTrap();
        
        // Focus first focusable element
        if (firstFocusableElement) {
            firstFocusableElement.focus();
        }
        
        // Announce to screen readers
        announceStatus('Cookie instellingen geopend');
    }
    
    /**
     * Close modal
     */
    function closeModal() {
        if (!modal) return;
        
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        modalOverlay.setAttribute('aria-hidden', 'true');
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Return focus to settings button or banner
        if (settingsButton) {
            settingsButton.focus();
        } else if (banner) {
            const firstButton = banner.querySelector('a, button');
            if (firstButton) firstButton.focus();
        }
        
        // Announce to screen readers
        announceStatus('Cookie instellingen gesloten');
    }
    
    /**
     * Setup focus trap for modal (WCAG requirement)
     */
    function setupFocusTrap() {
        if (!modal) return;
        
        // Get all focusable elements within modal
        const focusableSelectors = [
            'a[href]',
            'button:not([disabled])',
            'input:not([disabled])',
            'select:not([disabled])',
            'textarea:not([disabled])',
            '[tabindex]:not([tabindex="-1"])'
        ].join(', ');
        
        focusableElements = Array.from(modal.querySelectorAll(focusableSelectors));
        
        // Filter out elements that are not visible
        focusableElements = focusableElements.filter(el => {
            const style = window.getComputedStyle(el);
            return style.display !== 'none' && style.visibility !== 'hidden';
        });
        
        if (focusableElements.length > 0) {
            firstFocusableElement = focusableElements[0];
            lastFocusableElement = focusableElements[focusableElements.length - 1];
        }
    }
    
    /**
     * Handle keyboard navigation in modal
     */
    function handleModalKeydown(e) {
        if (!modal || modal.getAttribute('aria-hidden') === 'true') return;
        
        // Close on Escape
        if (e.key === 'Escape') {
            e.preventDefault();
            closeModal();
            return;
        }
        
        // Trap focus with Tab
        if (e.key === 'Tab') {
            if (focusableElements.length === 0) {
                e.preventDefault();
                return;
            }
            
            if (e.shiftKey) {
                // Shift + Tab
                if (document.activeElement === firstFocusableElement) {
                    e.preventDefault();
                    lastFocusableElement.focus();
                }
            } else {
                // Tab
                if (document.activeElement === lastFocusableElement) {
                    e.preventDefault();
                    firstFocusableElement.focus();
                }
            }
        }
    }
    
    /**
     * Announce status to screen readers (WCAG requirement)
     */
    function announceStatus(message) {
        if (statusRegion) {
            statusRegion.textContent = message;
            // Clear after announcement
            setTimeout(() => {
                statusRegion.textContent = '';
            }, 1000);
        }
    }
    
    /**
     * Handle accept all
     */
    function handleAcceptAll() {
        const consent = {
            necessary: true,
            analytics: true,
            marketing: true,
            preferences: true
        };
        
        setConsent(consent);
        hideBanner();
        if (modal && modal.getAttribute('aria-hidden') === 'false') {
            closeModal();
        }
    }
    
    /**
     * Handle reject all
     */
    function handleRejectAll() {
        const consent = {
            necessary: true, // Always true
            analytics: false,
            marketing: false,
            preferences: false
        };
        
        setConsent(consent);
        hideBanner();
        if (modal && modal.getAttribute('aria-hidden') === 'false') {
            closeModal();
        }
    }
    
    /**
     * Handle save preferences
     */
    function handleSavePreferences() {
        const consent = getConsentFromCheckboxes();
        setConsent(consent);
        hideBanner();
        closeModal();
    }
    
    /**
     * Initialize banner visibility
     */
    function initBannerVisibility() {
        const hasStoredConsent = hasConsent();
        
        // Show banner if:
        // 1. Dev mode is enabled, OR
        // 2. No consent has been given yet
        if (devMode || !hasStoredConsent) {
            showBanner();
        } else {
            hideBanner();
        }
    }
    
    /**
     * Initialize event listeners
     */
    function initEventListeners() {
        // Settings button - open modal
        if (settingsButton) {
            settingsButton.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
        }
        
        // Accept all button (banner)
        if (acceptAllButton) {
            acceptAllButton.addEventListener('click', function(e) {
                e.preventDefault();
                handleAcceptAll();
            });
        }
        
        // Reject all button (banner)
        if (rejectAllButton) {
            rejectAllButton.addEventListener('click', function(e) {
                e.preventDefault();
                handleRejectAll();
            });
        }
        
        // Accept all button (modal)
        if (acceptAllModalButton) {
            acceptAllModalButton.addEventListener('click', function(e) {
                e.preventDefault();
                handleAcceptAll();
            });
        }
        
        // Reject all button (modal)
        if (rejectAllModalButton) {
            rejectAllModalButton.addEventListener('click', function(e) {
                e.preventDefault();
                handleRejectAll();
            });
        }
        
        // Save preferences button
        if (savePreferencesButton) {
            savePreferencesButton.addEventListener('click', function(e) {
                e.preventDefault();
                handleSavePreferences();
            });
        }
        
        // Close modal buttons
        if (modalClose) {
            modalClose.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal();
            });
        }
        
        if (modalOverlay) {
            modalOverlay.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal();
            });
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', handleModalKeydown);
        
        // Update focus trap when modal content changes
        if (modal) {
            const observer = new MutationObserver(setupFocusTrap);
            observer.observe(modal, {
                childList: true,
                subtree: true,
                attributes: true,
                attributeFilter: ['style', 'class']
            });
        }
        
        // Listen for clicks on menu links with cookie settings hash
        // This allows site admins to add a custom link in menus with URL: #cookie-settings
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href*="#cookie-settings"], a[href*="#treffend-cookie-settings"]');
            if (link && typeof window.treffendCookiesOpenModal === 'function') {
                e.preventDefault();
                window.treffendCookiesOpenModal();
            }
        });
    }
    
    /**
     * Initialize plugin
     */
    function init() {
        // Initialize banner visibility
        initBannerVisibility();
        
        // Initialize event listeners
        initEventListeners();
        
        // Load consent into checkboxes if modal exists
        if (modal) {
            loadConsentIntoCheckboxes();
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Expose openModal function globally for external use
    window.treffendCookiesOpenModal = openModal;
    
})();
