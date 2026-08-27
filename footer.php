<?php
/**
 * The template for displaying the footer
 * Fully Widgetized
 *
 * @package Omlin_Author_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

</main><!-- .site-content -->

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            
            <!-- Column 1: Logo/Brand (Editable) -->
            <div class="footer-brand">
                <?php if ( is_active_sidebar( 'footer-col-brand' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-col-brand' ); ?>
                <?php else : ?>
                    <!-- Fallback if widget is empty -->
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php 
                            // Try to get custom logo, or show site title
                            if ( has_custom_logo() ) {
                                the_custom_logo();
                            } else {
                                echo '<h1>' . get_bloginfo('name') . '</h1>';
                            }
                            ?>
                        </a>
                    </div>
                    <p class="footer-tagline"><?php bloginfo('description'); ?></p>
                <?php endif; ?>
            </div>

            <!-- Column 2: Navigation (Menu) -->
            <!-- This remains a Menu location, controlled via Appearance > Menus -->
            <div class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </div>

            <!-- Column 3: Social Links (Editable via Widgets) -->
            <div class="footer-social">
                <?php if ( is_active_sidebar( 'footer-col-social' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-col-social' ); ?>
                <?php else : ?>
                    <h4>Connect With Me</h4>
                    <p>Add Social Icons via Appearance > Widgets</p>
                <?php endif; ?>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <?php if ( is_active_sidebar( 'footer-bottom-credits' ) ) : ?>
                 <!-- Allows full text editing including links -->
                <?php dynamic_sidebar( 'footer-bottom-credits' ); ?>
            <?php else : ?>
                <!-- Default / Fallback Content -->
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
                <p class="site-credit">
                    Designed by 
                    <a href="https://github.com/topweb4all" target="_blank" rel="noopener">
                        Omnia Ahmed
                    </a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<!-- Scroll to Top Button -->
<button id="scroll-to-top" class="scroll-to-top" aria-label="Scroll to top" title="Back to Top">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<script>
// سكربت إظهار وإخفاء الزر وتشغيل الصعود
document.addEventListener('DOMContentLoaded', function() {
    const scrollBtn = document.getElementById('scroll-to-top');
    
    // 1. إظهار الزر عند النزول للأسفل
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) { // يظهر بعد نزول 300px
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }
    });

    // 2. الصعود للأعلى عند الضغط
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // صعود ناعم
        });
    });
});
</script>

<style>
/* تنسيق زر الصعود */
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background-color: #333; /* لون الخلفية */
    color: #fff; /* لون السهم */
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999; /* لضمان ظهوره فوق العناصر */
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* تأثير الظهور */
.scroll-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* تأثير التحويم (Hover) */
.scroll-to-top:hover {
    background-color: #000;
    transform: translateY(-5px); /* يرتفع قليلاً للأعلى */
}

/* دعم الوضع الليلي (إذا كنتِ تستخدمين كلاس night-mode) */
.night-mode .scroll-to-top {
    background-color: #fff;
    color: #333;
}
.night-mode .scroll-to-top:hover {
    background-color: #f0f0f0;
}
</style>

<?php wp_footer(); ?>
</body>
</html>


</body>
</html>
