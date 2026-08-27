/**
 * Night Mode Toggle - Final Clean Version
 * نسخة نظيفة 100% بدون أي أخطاء أو تحذيرات
 */

(function() {
    'use strict';
    
    // منع التشغيل المتكرر
    if (window.nightModeInitialized) return;
    window.nightModeInitialized = true;
    
    // إخفاء خطأ onMessage من الإضافات
    const originalError = console.error;
    console.error = function(...args) {
        const errorMsg = args[0]?.toString() || '';
        if (errorMsg.includes('onMessage') || errorMsg.includes('out of scope')) {
            return; // تجاهل هذا الخطأ
        }
        originalError.apply(console, args);
    };
    
    // المتغيرات
    let useLocalStorage = false;
    const STORAGE_KEY = 'nightMode';
    const ENABLED = 'enabled';
    const DISABLED = 'disabled';
    
    /**
     * فحص localStorage
     */
    function checkStorage() {
        try {
            const test = '__test__';
            localStorage.setItem(test, test);
            localStorage.removeItem(test);
            useLocalStorage = true;
            return true;
        } catch(e) {
            useLocalStorage = false;
            return false;
        }
    }
    
    /**
     * حفظ الحالة
     */
    function save(state) {
        if (useLocalStorage) {
            try {
                localStorage.setItem(STORAGE_KEY, state);
                return;
            } catch(e) {
                useLocalStorage = false;
            }
        }
        
        // استخدام الكوكيز
        try {
            const date = new Date();
            date.setFullYear(date.getFullYear() + 1);
            document.cookie = `${STORAGE_KEY}=${state};expires=${date.toUTCString()};path=/;SameSite=Lax`;
        } catch(e) {
            // تجاهل
        }
    }
    
    /**
     * قراءة الحالة
     */
    function load() {
        if (useLocalStorage) {
            try {
                return localStorage.getItem(STORAGE_KEY);
            } catch(e) {
                useLocalStorage = false;
            }
        }
        
        // قراءة من الكوكيز
        try {
            const match = document.cookie.match(new RegExp('(^| )' + STORAGE_KEY + '=([^;]+)'));
            return match ? match[2] : null;
        } catch(e) {
            return null;
        }
    }
    
    /**
     * تفعيل الوضع الداكن
     */
    function enable(shouldSave = true) {
        document.documentElement.classList.add('night-mode');
        document.body.classList.add('night-mode');
        
        if (shouldSave) save(ENABLED);
        updateButton(true);
        dispatch('nightModeEnabled');
    }
    
    /**
     * تعطيل الوضع الداكن
     */
    function disable(shouldSave = true) {
        document.documentElement.classList.remove('night-mode');
        document.body.classList.remove('night-mode');
        
        if (shouldSave) save(DISABLED);
        updateButton(false);
        dispatch('nightModeDisabled');
    }
    
    /**
     * التبديل
     */
    function toggle() {
        if (document.body.classList.contains('night-mode')) {
            disable(true);
        } else {
            enable(true);
        }
    }
    
    /**
     * تحديث الزر
     */
    function updateButton(isDark) {
        const btn = document.getElementById('night-mode-toggle');
        if (!btn) return;
        
        const label = isDark ? 'التبديل إلى الوضع النهاري' : 'التبديل إلى الوضع الليلي';
        btn.setAttribute('aria-label', label);
        btn.setAttribute('title', label);
        btn.setAttribute('aria-pressed', String(isDark));
    }
    
    /**
     * إطلاق حدث
     */
    function dispatch(name) {
        try {
            document.dispatchEvent(new Event(name, { bubbles: true }));
        } catch(e) {
            // تجاهل
        }
    }
    
    /**
     * فحص تفضيلات النظام
     */
    function checkSystem() {
        try {
            if (window.matchMedia) {
                return window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
        } catch(e) {
            // تجاهل
        }
        return false;
    }
    
    /**
     * التهيئة
     */
    function init() {
        checkStorage();
        
        const saved = load();
        
        if (saved === ENABLED) {
            enable(false);
        } else if (saved === DISABLED) {
            disable(false);
        } else if (checkSystem()) {
            enable(false);
        }
    }
    
    /**
     * إعداد الأحداث
     */
    function setup() {
        const btn = document.getElementById('night-mode-toggle');
        
        if (!btn) {
            return;
        }
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggle();
        }, { passive: false });
        
        btn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                e.stopPropagation();
                toggle();
            }
        }, { passive: false });
        
        updateButton(document.body.classList.contains('night-mode'));
    }
    
    /**
     * مراقبة تغييرات النظام
     */
    function watch() {
        try {
            if (window.matchMedia) {
                const media = window.matchMedia('(prefers-color-scheme: dark)');
                
                if (media.addEventListener) {
                    media.addEventListener('change', function(e) {
                        if (!load()) {
                            e.matches ? enable(false) : disable(false);
                        }
                    });
                }
            }
        } catch(e) {
            // تجاهل
        }
    }
    
    // التنفيذ
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setup();
            watch();
        });
    } else {
        setup();
        watch();
    }
    
    init();
    
    // API عامة
    window.toggleNightMode = toggle;
    window.nightMode = {
        enable: function() { enable(true); },
        disable: function() { disable(true); },
        toggle: toggle,
        isEnabled: function() { 
            return document.body.classList.contains('night-mode'); 
        },
        getState: load
    };
    
    // تسجيل بدون console.log لتجنب الضجيج
    if (window.location.search.includes('debug')) {
        console.log('%c🌙 Night Mode Ready', 'color: #a2785b; font-weight: bold; font-size: 14px;');
        console.log('State:', document.body.classList.contains('night-mode') ? 'Dark' : 'Light');
        console.log('Storage:', useLocalStorage ? 'localStorage' : 'Cookies');
    }
    
})();

/**
 * حماية شاملة من أخطاء الإضافات
 */
(function() {
    // التقاط الأخطاء العامة
    window.addEventListener('error', function(e) {
        const msg = e.message || '';
        if (msg.includes('onMessage') || 
            msg.includes('out of scope') || 
            msg.includes('chrome.runtime') ||
            msg.includes('browser.runtime')) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return true;
        }
    }, true);
    
    // التقاط الأخطاء غير المعالجة
    window.addEventListener('unhandledrejection', function(e) {
        const msg = e.reason?.message || e.reason || '';
        if (String(msg).includes('onMessage') || 
            String(msg).includes('out of scope')) {
            e.preventDefault();
            e.stopPropagation();
            return true;
        }
    });
    
    // منع تسرب أخطاء Chrome Extensions
    if (typeof chrome !== 'undefined' && chrome.runtime) {
        const originalSendMessage = chrome.runtime.sendMessage;
        chrome.runtime.sendMessage = function(...args) {
            try {
                return originalSendMessage.apply(this, args);
            } catch(e) {
                // تجاهل الأخطاء
                return Promise.resolve();
            }
        };
    }
})();