<?php
/**
 * Hana Tsuki Theme Functions
 *
 * @package Hana_Tsuki
 * @version 1.0.9
 */

// Security: Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('HANA_TSUKI_VERSION', '1.0.6');
define('HANA_TSUKI_DIR', get_template_directory());
define('HANA_TSUKI_URI', get_template_directory_uri());

// Custom Post Types - Only Books
if (file_exists(HANA_TSUKI_DIR . '/inc/cpt-book.php')) {
    require_once HANA_TSUKI_DIR . '/inc/cpt-book.php';
}

/**
 * Theme Setup
 */
function hana_tsuki_setup() {
    // Make theme available for translation
    load_theme_textdomain('hana-tsuki', HANA_TSUKI_DIR . '/languages');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 220,
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array('site-title', 'site-description'),
    ));
    
    // Add HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));
    
    // Add automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Add responsive embeds support
    add_theme_support('responsive-embeds');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'hana-tsuki'),
        'footer'  => esc_html__('Footer Menu', 'hana-tsuki'),
    ));
    
    // Add image sizes with descriptive names
    add_image_size('hana-book-thumb', 300, 450, true);
    add_image_size('hana-book-large', 600, 900, true);
    add_image_size('hana-blog-thumb', 400, 300, true);
    
    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'hana_tsuki_setup');

/**
 * Enqueue Scripts and Styles
 */

    // ========================================
    // STYLES
    // ========================================
    
  function hana_tsuki_scripts() {
    
    // 1. Google Fonts
    wp_enqueue_style(
        'hana-tsuki-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Alice&family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;700&family=Cormorant+Garamond:wght@300;400;600&display=swap',
        array(),
        null
    );
    
    // 2. Main Stylesheet (style.css) - The Foundation
    wp_enqueue_style(
        'hana-tsuki-style',
        get_stylesheet_uri(),
        array(),
        filemtime( get_template_directory() . '/style.css' ) // Force cache refresh
    );

    // 3. Main Assets CSS (Global styles)
    if (file_exists(get_template_directory() . '/assets/css/main.css')) {
        wp_enqueue_style(
            'hana-tsuki-main-assets',
            get_template_directory_uri() . '/assets/css/main.css',
            array('hana-tsuki-style'),
            filemtime( get_template_directory() . '/assets/css/main.css' )
        );
    }
    
    // 4. Night Mode CSS
    if (file_exists(get_template_directory() . '/assets/css/night-mode.css')) {
        wp_enqueue_style(
            'hana-tsuki-night-mode',
            get_template_directory_uri() . '/assets/css/night-mode.css',
            array('hana-tsuki-style'),
            filemtime( get_template_directory() . '/assets/css/night-mode.css' )
        );
    }
    
    
    // ========================================
    // CONDITIONAL STYLES - Load only when needed
    // ========================================
    
    // Book Showcase CSS - Only on homepage
    if (is_front_page()) {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/book-showcase.css')) {
            wp_enqueue_style(
                'hana-tsuki-book-showcase',
                HANA_TSUKI_URI . '/assets/css/book-showcase.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // Books Archive CSS - Books listing page
    if (is_post_type_archive('book') || is_page_template('page-books.php')) {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/books-archive.css')) {
            wp_enqueue_style(
                'hana-tsuki-books-archive',
                HANA_TSUKI_URI . '/assets/css/books-archive.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // Book Single Page CSS - Individual book page
    if (is_singular('book')) {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/book-single.css')) {
            wp_enqueue_style(
                'hana-tsuki-book-single',
                HANA_TSUKI_URI . '/assets/css/book-single.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // Blog Archive CSS - Blog listing page
    if (is_home() || is_archive() && !is_post_type_archive('book')) {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/blog.css')) {
            wp_enqueue_style(
                'hana-tsuki-blog',
                HANA_TSUKI_URI . '/assets/css/blog.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // ========== BLOG (load always, styles scoped with .blog-page) ==========
if (file_exists(HANA_TSUKI_DIR . '/assets/css/blog.css')) {
    wp_enqueue_style(
        'hana-tsuki-blog',
        HANA_TSUKI_URI . '/assets/css/blog.css',
        array('hana-tsuki-main'),
        HANA_TSUKI_VERSION
    );
}

    // Single Post CSS - Individual blog post (Historical Paper Design)
    if (is_single() && get_post_type() === 'post') {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/single-post.css')) {
            wp_enqueue_style(
                'hana-tsuki-single-post',
                HANA_TSUKI_URI . '/assets/css/single-post.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // About Page CSS
    if (is_page_template('page-about.php') || is_page('about')) {
        if (file_exists(HANA_TSUKI_DIR . '/assets/css/about.css')) {
            wp_enqueue_style(
                'hana-tsuki-about',
                HANA_TSUKI_URI . '/assets/css/about.css',
                array('hana-tsuki-main'),
                HANA_TSUKI_VERSION
            );
        }
    }
    
    // ========================================
    // SCRIPTS
    // ========================================
    
    // Night Mode JS - Critical, load in header with defer
    wp_enqueue_script(
        'hana-tsuki-night-mode',
        HANA_TSUKI_URI . '/assets/js/night-mode.js',
        array(),
        HANA_TSUKI_VERSION,
        array(
            'strategy'  => 'defer',
            'in_footer' => false,
        )
    );
    
    // Mood JS - Load in footer if exists
    if (file_exists(HANA_TSUKI_DIR . '/assets/js/mood.js')) {
        wp_enqueue_script(
            'hana-tsuki-mood',
            HANA_TSUKI_URI . '/assets/js/mood.js',
            array('hana-tsuki-night-mode'),
            HANA_TSUKI_VERSION,
            array(
                'strategy'  => 'defer',
                'in_footer' => true,
            )
        );
    }
    
    // Main JS - Load in footer if exists
    if (file_exists(HANA_TSUKI_DIR . '/assets/js/main.js')) {
        wp_enqueue_script(
            'hana-tsuki-main',
            HANA_TSUKI_URI . '/assets/js/main.js',
            array('hana-tsuki-night-mode'),
            HANA_TSUKI_VERSION,
            array(
                'strategy'  => 'defer',
                'in_footer' => true,
            )
        );
    }
    
    // Add comment reply script on singular posts/pages
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'hana_tsuki_scripts');

/**
 * Add defer/async attributes (fallback for older WP versions)
 */
function hana_tsuki_script_loader_tag($tag, $handle, $src) {
    // Skip if WordPress 6.3+ (has native defer/async support)
    if (function_exists('wp_script_add_data')) {
        return $tag;
    }
    
    // Define scripts that should be deferred
    $defer_scripts = array(
        'hana-tsuki-night-mode',
        'hana-tsuki-mood',
        'hana-tsuki-main',
    );
    
    if (in_array($handle, $defer_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'hana_tsuki_script_loader_tag', 10, 3);

/**
 * Resource Hints - Preconnect to external domains
 */
function hana_tsuki_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'hana_tsuki_resource_hints', 10, 2);

/**
 * Safe fallback - Load only if files exist
 */
function hana_tsuki_safe_enqueue() {
    $theme_uri = get_template_directory_uri();
    $theme_path = get_template_directory();
    
    // Load main CSS (always required)
    wp_enqueue_style('hana-tsuki-main', $theme_uri . '/style.css', array(), '1.0.0');
    
    // Load additional files only if they exist
    if (file_exists($theme_path . '/assets/css/main.css')) {
        wp_enqueue_style('hana-tsuki-main-extra', $theme_uri . '/assets/css/main.css', array(), '1.0.0');
    }
    
    if (file_exists($theme_path . '/assets/css/night-mode.css')) {
        wp_enqueue_style('hana-tsuki-night', $theme_uri . '/assets/css/night-mode.css', array(), '1.0.0');
    }
    
    if (file_exists($theme_path . '/assets/js/night-mode.js')) {
        wp_enqueue_script('hana-tsuki-night-js', $theme_uri . '/assets/js/night-mode.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'hana_tsuki_safe_enqueue', 10);


/**
 * Performance Optimizations
 */
function hana_tsuki_performance_optimizations() {
    // Remove emoji scripts/styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove unnecessary generator tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'hana_tsuki_performance_optimizations');

/**
 * Remove jQuery Migrate on frontend
 */
function hana_tsuki_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'hana_tsuki_remove_jquery_migrate');

/**
 * Limit post revisions to improve database performance
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Increase autosave interval
 */
if (!defined('AUTOSAVE_INTERVAL')) {
    define('AUTOSAVE_INTERVAL', 300); // 5 minutes
}

/**
 * Add custom body classes
 */
function hana_tsuki_body_classes($classes) {
    // Add class for logged-in users
    if (is_user_logged_in()) {
        $classes[] = 'logged-in-user';
    }
    
    // Add page slug to body class
    if (is_page()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Add post type class
    if (is_singular()) {
        $classes[] = 'singular-' . get_post_type();
    }
    
    // Add archive post type class
    if (is_post_type_archive()) {
        $classes[] = 'archive-' . get_post_type();
    }
    
    // Add specific class for blog archive
    if (is_home()) {
        $classes[] = 'blog-archive';
    }
    
    return $classes;
}
add_filter('body_class', 'hana_tsuki_body_classes');

/**
 * Debug info in footer (only when debug mode is active)
 */
function hana_tsuki_footer_debug() {
    if (defined('WP_DEBUG') && WP_DEBUG && isset($_GET['debug'])) {
        ?>
        <script>
        console.log('%c✓ Hana Tsuki Theme Loaded', 'color: green; font-weight: bold; font-size: 14px;');
        console.log('%cTheme Version: <?php echo esc_js(HANA_TSUKI_VERSION); ?>', 'color: blue;');
        console.log('%cPage Type:', '<?php 
            if (is_front_page()) echo "Front Page";
            elseif (is_home()) echo "Blog Archive";
            elseif (is_post_type_archive('book')) echo "Books Archive";
            elseif (is_singular('book')) echo "Single Book";
            elseif (is_single()) echo "Single Post";
            elseif (is_archive()) echo "Archive";
            else echo "Other";
        ?>');
        console.log('%cLoaded Styles:', <?php 
            global $wp_styles;
            $loaded = array();
            foreach ($wp_styles->done as $handle) {
                if (strpos($handle, 'hana-tsuki') !== false) {
                    $loaded[] = $handle;
                }
            }
            echo json_encode($loaded);
        ?>);
        </script>
        <?php
    }
}
add_action('wp_footer', 'hana_tsuki_footer_debug', 999);

/**
 * Security: Disable file editing in dashboard
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

if (is_page_template('page-blog.php') || is_home()) {
    if (file_exists(HANA_TSUKI_DIR . '/assets/css/blog.css')) {
        wp_enqueue_style(
            'hana-tsuki-blog',
            HANA_TSUKI_URI . '/assets/css/blog.css',
            array('hana-tsuki-main'),
            HANA_TSUKI_VERSION
        );
    }
}

function hana_tsuki_enqueue_assets() {
    // Main CSS
    wp_enqueue_style(
        'hana-tsuki-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        '1.0.0',
        'all'
    );
    
    // Night Mode CSS
    wp_enqueue_style(
        'hana-tsuki-night-mode',
        get_template_directory_uri() . '/assets/css/night-mode.css',
        array('hana-tsuki-main'),
        '1.0.0',
        'all'
    );
    
    // Night Mode JS
    wp_enqueue_script(
        'hana-tsuki-night-mode-js',
        get_template_directory_uri() . '/assets/js/night-mode.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'hana_tsuki_enqueue_assets');
/**
 * Helper function to get ALL books
 * Used for archives or listing pages
 */
function hana_tsuki_get_all_books() {
    $args = array(
        'post_type'      => 'book',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    
    return new WP_Query($args);
}

/**
 * Helper function to get ONLY the LATEST book
 * Used for the Homepage Hero section
 * Fixes the "undefined function" warning
 */
function hana_tsuki_get_latest_book() {
    $args = array(
        'post_type'      => 'book',
        'posts_per_page' => 1,      // Limit to 1
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    
    return new WP_Query($args);
}

/**
 * Register Widget/Block Areas for the Homepage
 */
function omlin_register_block_areas() {
    
    // 1. Hero Reviews (Left Side)
    register_sidebar( array(
        'name'          => 'Hero Reviews (Left)',
        'id'            => 'hero-reviews-left',
        'description'   => 'Add Quote blocks here for the left side.',
        'before_widget' => '<div class="review-quote-block">',
        'after_widget'  => '</div>',
    ) );

    // 2. Hero Reviews (Right Side)
    register_sidebar( array(
        'name'          => 'Hero Reviews (Right)',
        'id'            => 'hero-reviews-right',
        'description'   => 'Add Quote blocks here for the right side.',
        'before_widget' => '<div class="review-quote-block">',
        'after_widget'  => '</div>',
    ) );

    // 3. About Section Text
    register_sidebar( array(
        'name'          => 'Homepage About Text',
        'id'            => 'home-about-text',
        'description'   => 'Edit the About section text here.',
        'before_widget' => '<div class="widget-content">',
        'after_widget'  => '</div>',
    ) );

    // 4. Newsletter Section Text
    register_sidebar( array(
        'name'          => 'Newsletter Intro Text',
        'id'            => 'home-newsletter-text',
        'description'   => 'Title and description for the newsletter.',
        'before_widget' => '<div class="widget-content">',
        'after_widget'  => '</div>',
    ) );

    // 5. About Section Image (Fixed placement: Now inside the function)
    register_sidebar( array(
        'name'          => 'About Section Image',
        'id'            => 'home-about-image',
        'description'   => 'Upload the author portrait here using an Image block.',
        'before_widget' => '<div class="author-image-widget">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'omlin_register_block_areas' );
/**
 * Register Widget/Block Areas for the About Page
 */
function omlin_register_about_page_areas() {
    
    // 1. Author Image Area
    register_sidebar( array(
        'name'          => 'About Page: Author Image',
        'id'            => 'about-hero-image',
        'description'   => 'Upload the author portrait here using an Image block.',
        'before_widget' => '<div class="about-image-widget">',
        'after_widget'  => '</div>',
    ) );

    // 2. Hero Text Area (Name, Kicker, Tagline)
    register_sidebar( array(
        'name'          => 'About Page: Hero Text',
        'id'            => 'about-hero-text',
        'description'   => 'Add the "About the Author" kicker, Name (H1), and Tagline here.',
        'before_widget' => '<div class="about-text-widget">',
        'after_widget'  => '</div>',
    ) );

    // 3. Meta Info Area (The list of genres, location, etc.)
    register_sidebar( array(
        'name'          => 'About Page: Meta Info',
        'id'            => 'about-hero-meta',
        'description'   => 'Add a List block here for location, genres, and series.',
        'before_widget' => '<div class="about-meta-widget">',
        'after_widget'  => '</div>',
    ) );

    // 4. Social Media Area (Improved for Icons)
    register_sidebar( array(
        'name'          => 'About Page: Social Media',
        'id'            => 'about-hero-social',
        'description'   => 'Add the "Social Icons" block here.',
        'before_widget' => '<div class="about-social-widget">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'omlin_register_about_page_areas' );
/**
 * Register Widget Areas for the Mood Section
 */
function omlin_register_mood_areas() {
    
    // 1. Mood Section Title/Header
    register_sidebar( array(
        'name'          => 'Mood Section: Header',
        'id'            => 'mood-header-text',
        'description'   => 'Edit the title and subtitle of the mood section.',
        'before_widget' => '<div class="mood-header-widget">',
        'after_widget'  => '</div>',
    ) );

    // 2. Mood: Dark
    register_sidebar( array(
        'name'          => 'Mood: Dark Content',
        'id'            => 'mood-content-dark',
        'description'   => 'Add Quote blocks here. They will appear when "Dark" is clicked.',
        'before_widget' => '<div class="quote-animation">',
        'after_widget'  => '</div>',
    ) );

    // 3. Mood: Romantic
    register_sidebar( array(
        'name'          => 'Mood: Romantic Content',
        'id'            => 'mood-content-romantic',
        'description'   => 'Add Quote blocks here.',
        'before_widget' => '<div class="quote-animation">',
        'after_widget'  => '</div>',
    ) );

    // 4. Mood: Mysterious
    register_sidebar( array(
        'name'          => 'Mood: Mysterious Content',
        'id'            => 'mood-content-mysterious',
        'description'   => 'Add Quote blocks here.',
        'before_widget' => '<div class="quote-animation">',
        'after_widget'  => '</div>',
    ) );

    // 5. Mood: Hopeful
    register_sidebar( array(
        'name'          => 'Mood: Hopeful Content',
        'id'            => 'mood-content-hopeful',
        'description'   => 'Add Quote blocks here.',
        'before_widget' => '<div class="quote-animation">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'omlin_register_mood_areas' );
/**
 * Register Widget Areas for the Footer
 */
function omlin_register_footer_areas() {
    
    // 1. Footer Column 1: Brand & Logo
    register_sidebar( array(
        'name'          => 'Footer: Brand Area',
        'id'            => 'footer-col-brand',
        'description'   => 'Add the Site Logo and Tagline here.',
        'before_widget' => '<div class="footer-brand-widget">',
        'after_widget'  => '</div>',
    ) );

    // 2. Footer Column 2: Social Media
    register_sidebar( array(
        'name'          => 'Footer: Social Area',
        'id'            => 'footer-col-social',
        'description'   => 'Add a Heading and Social Icons block here.',
        'before_widget' => '<div class="footer-social-widget">',
        'after_widget'  => '</div>',
    ) );

    // 3. Footer Bottom: Credits (Optional but recommended)
    register_sidebar( array(
        'name'          => 'Footer: Bottom Credits',
        'id'            => 'footer-bottom-credits',
        'description'   => 'Add copyright text or designer credits here.',
        'before_widget' => '<div class="footer-credits-widget">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'omlin_register_footer_areas' );
/**
 * Register Widget Areas for Single Book Page
 */
function omlin_register_book_areas() {
    
    // 1. Book Info Area (Title, Subtitle, Buttons)
    register_sidebar( array(
        'name'          => 'Book Page: Info Area',
        'id'            => 'book-info-area',
        'description'   => 'Add Title, Subtitle, and Buttons here.',
        'before_widget' => '<div class="book-info-widget">',
        'after_widget'  => '</div>',
    ) );

    // 2. Book Stats Area (Pages, Format, etc.)
    register_sidebar( array(
        'name'          => 'Book Page: Meta Stats',
        'id'            => 'book-meta-stats',
        'description'   => 'Add List or Paragraph blocks for page count/format.',
        'before_widget' => '<div class="book-stats-widget">',
        'after_widget'  => '</div>',
    ) );

    // 3. Goodreads Reviews Section (New!)
    register_sidebar( array(
        'name'          => 'Book Page: Reviews & Ratings',
        'id'            => 'book-reviews-area',
        'description'   => 'Add the 5-star rating image and Goodreads reviews here.',
        'before_widget' => '<div class="book-reviews-widget">',
        'after_widget'  => '</div>',
    ) );
    
    // 4. Comments / Community Section
    register_sidebar( array(
        'name'          => 'Book Page: Bottom Comments',
        'id'            => 'book-comments-area',
        'description'   => 'Add the "Comments" block here.',
        'before_widget' => '<div class="book-comments-widget">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'omlin_register_book_areas' );
/**
 * Force Comment Support for Books and Posts
 */
function hana_enable_comments_support() {
    // 1. تفعيل التعليقات للكتب
    add_post_type_support( 'book', 'comments' );
    
    // 2. تفعيل التعليقات للمقالات (للتأكيد)
    add_post_type_support( 'post', 'comments' );
}
add_action( 'init', 'hana_enable_comments_support', 99 );

/**
 * FIX: Mobile Menu - Force Load Main.js
 */
function hana_tsuki_fix_mobile_menu() {
    wp_dequeue_script('hana-tsuki-main');
    
    if (file_exists(HANA_TSUKI_DIR . '/assets/js/main.js')) {
        wp_enqueue_script(
            'hana-tsuki-main-fixed',
            HANA_TSUKI_URI . '/assets/js/main.js',
            array('jquery'),
            filemtime(HANA_TSUKI_DIR . '/assets/js/main.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'hana_tsuki_fix_mobile_menu', 99);

/**
 * FIX: Force jQuery
 */
function hana_tsuki_force_jquery() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'hana_tsuki_force_jquery', 1);

/**
 * FIX: Mobile Menu - Universal Solution (Works with ANY button class)
 */
function hana_tsuki_mobile_menu_universal_fix() {
    ?>
    <style id="hana-mobile-menu-universal">
        @media (max-width: 768px) {
            /* Target ALL possible mobile menu buttons - FORCE VISIBLE */
            .mobile-menu-toggle,
            .hamburger-menu,
            .menu-toggle,
            .mobile-nav-toggle,
            .nav-toggle,
            button.menu-toggle,
            .mobile-toggle,
            [class*="mobile"][class*="toggle"],
            [class*="hamburger"],
            [class*="menu-toggle"] {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 5px !important;
                visibility: visible !important;
                opacity: 1 !important;
                z-index: 99999 !important;
                pointer-events: auto !important;
                width: 48px !important;
                height: 48px !important;
                min-width: 48px !important;
                min-height: 48px !important;
                position: relative !important;
                background: transparent !important;
                border: 2px solid var(--text-color, #f5eee5) !important;
                border-radius: 6px !important;
                cursor: pointer !important;
                padding: 10px !important;
                margin: 0 !important;
            }
            
            /* Create hamburger lines using pseudo-elements + span */
            .mobile-menu-toggle span,
            .hamburger-menu span,
            .menu-toggle span,
            .mobile-nav-toggle span,
            .nav-toggle span,
            button.menu-toggle span,
            [class*="mobile"][class*="toggle"] span,
            [class*="hamburger"] span {
                display: block !important;
                width: 26px !important;
                height: 2.5px !important;
                background-color: var(--text-color, #f5eee5) !important;
                border-radius: 2px !important;
                transition: all 0.3s ease !important;
                position: relative !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
            
            /* DEFAULT: 3 lines visible */
            .mobile-menu-toggle:not(.active) span:nth-child(1),
            .hamburger-menu:not(.active) span:nth-child(1),
            .menu-toggle:not(.active) span:nth-child(1) {
                transform: translateY(0) rotate(0) !important;
            }
            
            .mobile-menu-toggle:not(.active) span:nth-child(2),
            .hamburger-menu:not(.active) span:nth-child(2),
            .menu-toggle:not(.active) span:nth-child(2) {
                opacity: 1 !important;
                transform: translateX(0) !important;
            }
            
            .mobile-menu-toggle:not(.active) span:nth-child(3),
            .hamburger-menu:not(.active) span:nth-child(3),
            .menu-toggle:not(.active) span:nth-child(3) {
                transform: translateY(0) rotate(0) !important;
            }
            
            /* ACTIVE: Transform to X */
            .mobile-menu-toggle.active span:nth-child(1),
            .hamburger-menu.active span:nth-child(1),
            .menu-toggle.active span:nth-child(1) {
                transform: translateY(10px) rotate(45deg) !important;
            }
            
            .mobile-menu-toggle.active span:nth-child(2),
            .hamburger-menu.active span:nth-child(2),
            .menu-toggle.active span:nth-child(2) {
                opacity: 0 !important;
            }
            
            .mobile-menu-toggle.active span:nth-child(3),
            .hamburger-menu.active span:nth-child(3),
            .menu-toggle.active span:nth-child(3) {
                transform: translateY(-10px) rotate(-45deg) !important;
            }
            
            /* Hover effect */
            .mobile-menu-toggle:hover,
            .hamburger-menu:hover,
            .menu-toggle:hover {
                background: rgba(245, 238, 229, 0.1) !important;
                border-color: var(--accent-color, #714231) !important;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-menu-toggle,
            .hamburger-menu,
            .menu-toggle,
            .mobile-nav-toggle {
                display: none !important;
            }
        }
    </style>
    
    <script id="hana-mobile-menu-universal-script">
    (function() {
        'use strict';
        
        function initMobileMenu() {
            // Try ALL possible selectors
            var selectors = [
                '.mobile-menu-toggle',
                '.hamburger-menu',
                '.menu-toggle',
                '.mobile-nav-toggle',
                '.nav-toggle',
                'button.menu-toggle',
                '.mobile-toggle',
                '[class*="mobile"][class*="toggle"]',
                '[class*="hamburger"]'
            ];
            
            var menuToggle = null;
            for (var i = 0; i < selectors.length; i++) {
                menuToggle = document.querySelector(selectors[i]);
                if (menuToggle) {
                    console.log('✓ Found menu button with selector: ' + selectors[i]);
                    break;
                }
            }
            
            var mobileMenu = document.querySelector('.mobile-menu, .mobile-navigation, .responsive-menu, .primary-menu, nav.mobile-menu, .nav-mobile');
            
            if (!menuToggle) {
                console.warn('⚠ No mobile menu button found. Searched selectors:', selectors);
                return;
            }
            
            if (!mobileMenu) {
                console.warn('⚠ No mobile menu container found');
                return;
            }
            
            // Ensure 3 span elements exist
            var spans = menuToggle.querySelectorAll('span');
            if (spans.length < 3) {
                menuToggle.innerHTML = '';
                for (var j = 0; j < 3; j++) {
                    var span = document.createElement('span');
                    menuToggle.appendChild(span);
                }
                console.log('✓ Added 3 hamburger lines');
            }
            
            // Click handler
            menuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var isActive = this.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                mobileMenu.classList.toggle('open');
                document.body.classList.toggle('mobile-menu-open');
                
                console.log(isActive ? '✓ Menu OPENED (X icon)' : '✓ Menu CLOSED (☰ icon)');
            });
            
            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    if (menuToggle.classList.contains('active')) {
                        menuToggle.classList.remove('active');
                        mobileMenu.classList.remove('active', 'open');
                        document.body.classList.remove('mobile-menu-open');
                    }
                }
            });
            
            // Close on ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && menuToggle.classList.contains('active')) {
                    menuToggle.classList.remove('active');
                    mobileMenu.classList.remove('active', 'open');
                    document.body.classList.remove('mobile-menu-open');
                }
            });
            
            console.log('✓ Mobile menu initialized successfully!');
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileMenu);
        } else {
            initMobileMenu();
        }
    })();
    </script>
    <?php
}
add_action('wp_head', 'hana_tsuki_mobile_menu_universal_fix', 999);

