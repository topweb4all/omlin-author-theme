<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff" id="theme-color-meta">
    
    <!-- Preload Critical Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Night Mode Flash Prevention - Critical Inline Script -->
    <script id="night-mode-init">
    (function() {
        'use strict';
        
        // Prevent duplicate execution
        if (window.__nightModePreInit) return;
        window.__nightModePreInit = true;
        
        try {
            // Check localStorage first
            var saved = localStorage.getItem('nightMode');
            if (saved === 'enabled') {
                document.documentElement.classList.add('night-mode');
                if (document.body) {
                    document.body.classList.add('night-mode');
                }
                return;
            }
        } catch(e) {
            console.warn('localStorage not available:', e);
        }
        
        // Fallback to system preference
        try {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('night-mode');
                if (document.body) {
                    document.body.classList.add('night-mode');
                }
            }
        } catch(mediaError) {
            console.warn('matchMedia not supported:', mediaError);
        }
    })();
    </script>
    
    <?php if (!WP_DEBUG): ?>
    <!-- Disable Console Logs in Production -->
    <script>
    (function(){
        if (window.location.hostname !== 'localhost' && !window.location.search.includes('debug')) {
            console.log = console.info = console.warn = function(){};
        }
    })();
    </script>
    <?php endif; ?>

    <!-- WordPress Head Hook -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to Main Content (Accessibility) -->
<a href="#main-content" class="skip-to-content">Skip to main content</a>

<header class="site-header" role="banner">
    <div class="container">
        <div class="header-wrapper">
            
            <!-- Site Branding / Logo -->
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo-text" rel="home">
                        <span class="author-label">Author</span>
                        <span class="author-name">Author name</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Primary Navigation -->
            <nav class="main-navigation" role="navigation" aria-label="Primary Navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="primary-menu" class="%2$s">%3$s</ul>',
                ));
                ?>
            </nav>

            <!-- Header Controls (Search, Night Mode, Mobile Menu) -->
            <div class="header-controls">
                
                <!-- 1. Search Toggle Button -->
                <button 
                    class="header-btn search-toggle" 
                    type="button" 
                    aria-label="Open Search"
                    aria-expanded="false"
                    title="Search"
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="screen-reader-text">Search</span>
                </button>

                <!-- 2. Night Mode Toggle Button -->
                <button 
                    id="night-mode-toggle" 
                    class="header-btn night-mode-btn" 
                    type="button"
                    aria-label="Toggle Night Mode"
                    aria-pressed="false"
                    title="Toggle Night Mode"
                >
                    <span class="sun-icon" aria-hidden="true">☀️</span>
                    <span class="moon-icon" aria-hidden="true">🌙</span>
                    <span class="screen-reader-text">Toggle Night Mode</span>
                </button>
                
                <!-- 3. Mobile Menu Toggle -->
                <button 
                    class="mobile-menu-toggle" 
                    type="button"
                    aria-label="Toggle Menu"
                    aria-expanded="false"
                    aria-controls="primary-menu"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                    <span class="screen-reader-text">Menu</span>
                </button>
                
            </div>
            
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobile Navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-nav-menu',
            'container'      => false,
            'fallback_cb'    => '__return_false',
        ));
        ?>
    </div>

    <!-- Mobile Menu Backdrop -->
    <div class="menu-backdrop" id="menu-backdrop"></div>

    <!-- Search Overlay -->
    <div class="search-overlay" role="dialog" aria-modal="true" aria-label="Search">
        <div class="search-overlay-content">
            
            <!-- Close Button -->
            <button class="search-close" type="button" aria-label="Close Search">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                <span class="screen-reader-text">Close</span>
            </button>
            
            <div class="container narrow">
                <form role="search" method="get" class="search-form-custom" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group">
                        
                        <!-- Search Input Field -->
                        <label for="search-field" class="screen-reader-text">Search for:</label>
                        <input 
                            type="search" 
                            id="search-field"
                            class="search-field-custom" 
                            placeholder="Type to search..." 
                            value="<?php echo esc_attr(get_search_query()); ?>" 
                            name="s" 
                            autocomplete="off"
                            required
                        />
                        
                        <!-- Submit Button -->
                        <button type="submit" class="search-submit-custom" aria-label="Submit Search">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                            <span class="screen-reader-text">Search</span>
                        </button>
                    </div>
                </form>
                
                <p class="search-note" aria-live="polite">Press Enter to see results</p>
            </div>
        </div>
    </div>

</header>

<!-- Main Content Area -->
<main class="site-content" id="main-content" role="main">

<!-- Inline Styles for Header Components -->
<style>
/* ========================================
   HEADER CONTROLS
======================================== */
.header-controls {
    display: flex;
    align-items: center;
    gap: 15px;
}

.header-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    color: var(--text-color, #111);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease, opacity 0.2s ease;
    border-radius: 4px;
}

.header-btn:hover {
    transform: scale(1.1);
    opacity: 0.8;
}

.header-btn:focus {
    outline: 2px solid var(--accent-color, #714231);
    outline-offset: 2px;
}

/* Screen Reader Only Text (Accessibility) */
.screen-reader-text,
.skip-to-content {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}

.skip-to-content:focus {
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 100000;
    width: auto;
    height: auto;
    padding: 15px 20px;
    clip: auto;
    background: var(--accent-color, #714231);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

/* ========================================
   MOBILE MENU BACKDROP
======================================== */
.mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 280px;
    max-width: 85vw; /* لا تتجاوز 85% من عرض الشاشة */
    height: 100vh; /* ✅ ارتفاع كامل */
    background: var(--bg-color, #f5eee5);
    z-index: 9999;
    padding: 80px 20px 30px; /* مساحة من الأعلى للوجو */
    overflow-y: auto; /* ✅ تفعيل السكرول العمودي */
    overflow-x: hidden; /* منع السكرول الأفقي */
    transition: right 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: -5px 0 20px rgba(0, 0, 0, 0.1);
    -webkit-overflow-scrolling: touch; /* ✅ سكرول سلس على iOS */
}

body.menu-open .mobile-menu {
    right: 0;
}

/* Mobile Menu Items */
.mobile-nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-nav-menu li {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.mobile-nav-menu li a {
    display: block;
    padding: 15px 0;
    color: var(--text-color, #111);
    text-decoration: none;
    font-size: 1.1rem;
    transition: padding-left 0.2s ease, color 0.2s ease;
}

.mobile-nav-menu li a:hover,
.mobile-nav-menu li a:focus {
    padding-left: 10px;
    color: var(--accent-color, #714231);
}

/* Sub-menus (Dropdowns) */
.mobile-nav-menu .sub-menu {
    list-style: none;
    padding-left: 20px;
    margin: 0;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.mobile-nav-menu li.menu-item-has-children > a::after {
    content: " ▼";
    font-size: 0.8em;
    margin-left: 5px;
}

/* Show sub-menu on hover/click */
.mobile-nav-menu li.menu-item-has-children:hover .sub-menu,
.mobile-nav-menu li.menu-item-has-children.active .sub-menu {
    max-height: 500px; /* قيمة كبيرة كفاية */
}

.mobile-nav-menu .sub-menu li {
    border: none;
}

.mobile-nav-menu .sub-menu li a {
    font-size: 0.95rem;
    padding: 10px 0;
    opacity: 0.8;
}

/* Night Mode */
.night-mode .mobile-menu {
    background: var(--bg-color, #050508);
}

.night-mode .mobile-nav-menu li {
    border-bottom-color: rgba(255, 255, 255, 0.05);
}

/* Prevent body scroll when menu is open */
body.menu-open {
    overflow: hidden; /* ✅ منع سكرول الصفحة الرئيسية */
    position: fixed; /* ✅ لأجهزة iOS */
    width: 100%;
}
/* ========================================
   SEARCH OVERLAY
======================================== */
.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.98);
    z-index: 99999;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), 
                visibility 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.night-mode .search-overlay {
    background: rgba(5, 5, 8, 0.98);
}

.search-overlay.active {
    opacity: 1;
    visibility: visible;
}

.search-overlay-content {
    width: 100%;
    max-width: 1200px;
    padding: 20px;
}

/* Close Button */
.search-close {
    position: absolute;
    top: 30px;
    right: 30px;
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-color, #333);
    transition: transform 0.3s ease, opacity 0.2s ease;
    padding: 10px;
}

.search-close:hover {
    transform: rotate(90deg);
    opacity: 0.7;
}

.search-close:focus {
    outline: 2px solid var(--accent-color, #714231);
    outline-offset: 4px;
}

/* Search Form */
.search-form-custom {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.input-group:focus-within {
    border-color: var(--accent-color, #714231);
}

/* Search Input Field */
.search-field-custom {
    width: 100%;
    font-size: 2.5rem;
    font-weight: 300;
    border: none;
    background: transparent;
    padding: 20px 0;
    outline: none;
    color: var(--text-color, #333);
    font-family: inherit;
}

.search-field-custom::placeholder {
    color: rgba(0, 0, 0, 0.3);
    font-weight: 100;
}

.night-mode .search-field-custom::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

/* Submit Button */
.search-submit-custom {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-color, #333);
    padding: 0 15px;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.input-group:focus-within .search-submit-custom {
    opacity: 1;
}

.search-submit-custom:hover {
    transform: translateX(5px);
}

.search-submit-custom:focus {
    outline: 2px solid var(--accent-color, #714231);
    outline-offset: 4px;
}

/* Search Note */
.search-note {
    text-align: center;
    margin-top: 20px;
    color: rgba(0, 0, 0, 0.5);
    font-size: 0.9rem;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.night-mode .search-note {
    color: rgba(255, 255, 255, 0.5);
}

/* ========================================
   RESPONSIVE DESIGN
======================================== */
@media (max-width: 768px) {
    .search-field-custom {
        font-size: 1.8rem;
    }
    
    .search-close {
        top: 15px;
        right: 15px;
    }
    
    .mobile-menu {
        width: 100%;
        max-width: 320px;
    }
}

@media (max-width: 480px) {
    .search-field-custom {
        font-size: 1.5rem;
    }
}
/* إخفاء قائمة الموبايل على الشاشات الكبيرة */
@media (min-width: 993px) {
    .mobile-menu,
    .menu-backdrop {
        display: none !important;
    }
    
    .mobile-menu-toggle {
        display: none !important;
    }
}

/* إخفاء القائمة افتراضيًا على الموبايل */
@media (max-width: 992px) {
    .mobile-menu {
        right: -100%;
        visibility: hidden;
        opacity: 0;
    }
    
    .menu-backdrop {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    
    /* إظهار القائمة عند الفتح */
    body.menu-open .mobile-menu {
        right: 0;
        visibility: visible;
        opacity: 1;
    }
    
    body.menu-open .menu-backdrop {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
}

</style>
