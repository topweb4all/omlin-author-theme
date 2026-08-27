/**
 * Omlin Author Theme - Main JavaScript
 * 
 * @package Omlin_Author_Theme
 * @version 1.0.7
 * @author Omnia Ahmed
 * @link https://github.com/topweb4all
 */

(function() {
    'use strict';
    
    console.log('✓ Omlin Author Theme JavaScript Loaded');
    
    // ========================================
    // 1. MOBILE MENU FUNCTIONALITY
    // ========================================
    
    // 1. MOBILE MENU FUNCTIONALITY
function initMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const menuBackdrop = document.getElementById('menu-backdrop');
    const menuLinks = document.querySelectorAll('.mobile-menu a');
    
    if (!menuToggle || !mobileMenu) {
        console.warn('Mobile menu elements not found');
        return;
    }
    
    // Toggle menu open/close
    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        const isOpen = document.body.classList.toggle('menu-open');
        menuToggle.setAttribute('aria-expanded', isOpen);
        menuToggle.setAttribute('aria-label', isOpen ? 'Close Menu' : 'Open Menu');
        
        // Prevent body scroll when menu is open
        if (isOpen) {
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
        } else {
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
        }
        
        console.log('Mobile menu', isOpen ? 'Opened' : 'Closed');
    });
    
    // Close menu when clicking backdrop
    if (menuBackdrop) {
        menuBackdrop.addEventListener('click', function() {
            closeMenu();
        });
    }
    
    // Close menu when clicking a link
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });
    
    // Close menu on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.body.classList.contains('menu-open')) {
            closeMenu();
        }
    });
    
    // Helper function to close menu
    function closeMenu() {
        document.body.classList.remove('menu-open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open Menu');
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.width = '';
    }
}

    
    // ========================================
    // 2. SEARCH OVERLAY FUNCTIONALITY
    // ========================================
    
    function initSearchOverlay() {
        const searchToggle = document.querySelector('.search-toggle');
        const searchOverlay = document.querySelector('.search-overlay');
        const searchClose = document.querySelector('.search-close');
        const searchField = document.querySelector('.search-field-custom');
        
        if (!searchToggle || !searchOverlay) {
            return;
        }
        
        // Open search overlay
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            searchOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus on search field after animation
            setTimeout(function() {
                if (searchField) searchField.focus();
            }, 300);
            
            console.log('Search overlay opened');
        });
        
        // Close search overlay
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                closeSearchOverlay();
            });
        }
        
        // Close on backdrop click
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                closeSearchOverlay();
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                closeSearchOverlay();
            }
        });
        
        function closeSearchOverlay() {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
            console.log('Search overlay closed');
        }
    }
    
    
    // ========================================
    // 3. SMOOTH SCROLL FOR ANCHOR LINKS
    // ========================================
    
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 100;
                    
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                    
                    // Update URL without jumping
                    history.pushState(null, null, targetId);
                }
            });
        });
    }
    
    
    // ========================================
    // 4. LAZY LOADING FOR IMAGES
    // ========================================
    
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            lazyImages.forEach(function(img) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    }
    
    
    // ========================================
    // 5. SCROLL TO TOP BUTTON
    // ========================================
    
    function initScrollToTop() {
        const scrollBtn = document.getElementById('scroll-to-top');
        
        if (!scrollBtn) return;
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        });
        
        scrollBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    
    // ========================================
    // 6. EXTERNAL LINKS - OPEN IN NEW TAB
    // ========================================
    
    function initExternalLinks() {
        const externalLinks = document.querySelectorAll('a[href^="http"]:not([href*="' + window.location.hostname + '"])');
        
        externalLinks.forEach(function(link) {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        });
    }
    
    
    // ========================================
    // 7. ACCESSIBILITY ENHANCEMENTS
    // ========================================
    
    function initAccessibility() {
        // Skip to main content
        const skipLink = document.querySelector('.skip-to-content');
        if (skipLink) {
            skipLink.addEventListener('click', function(e) {
                e.preventDefault();
                const mainContent = document.querySelector('main') || document.querySelector('#main');
                if (mainContent) {
                    mainContent.setAttribute('tabindex', '-1');
                    mainContent.focus();
                }
            });
        }
        
        // Focus management for modals
        document.querySelectorAll('[aria-modal="true"]').forEach(function(modal) {
            const focusableElements = modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            
            if (focusableElements.length > 0) {
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                modal.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab') {
                        if (e.shiftKey && document.activeElement === firstElement) {
                            e.preventDefault();
                            lastElement.focus();
                        } else if (!e.shiftKey && document.activeElement === lastElement) {
                            e.preventDefault();
                            firstElement.focus();
                        }
                    }
                });
            }
        });
    }
    
    
    // ========================================
    // INITIALIZE ALL FEATURES
    // ========================================
    
    function init() {
        initMobileMenu();
        initSearchOverlay();
        initSmoothScroll();
        initLazyLoading();
        initScrollToTop();
        initExternalLinks();
        initAccessibility();
        
        console.log('✓ All theme features initialized');
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
})();
