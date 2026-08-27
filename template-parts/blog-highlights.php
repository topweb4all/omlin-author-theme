<?php
/**
 * Template Part: Hana Cinematic Blog Highlights
 * Re-designed from scratch for maximum visual impact
 */

$hana_blog_query = new WP_Query(array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => 1,
    'order'               => 'DESC',
    'orderby'             => 'date'
));

if ($hana_blog_query->have_posts()) :
?>

<section class="hana-blog-section">
    <div class="hana-container">
        
        <!-- Header -->
        <div class="hana-section-header">
            <h2 class="hana-title">Latest Stories</h2>
            <p class="hana-subtitle">Dive into the latest updates from my world</p>
        </div>

        <!-- The Grid -->
        <div class="hana-cards-grid">
            <?php while ($hana_blog_query->have_posts()) : $hana_blog_query->the_post(); ?>
                
                <div class="hana-card">
                    <a href="<?php the_permalink(); ?>" class="hana-card-link">
                        
                        <!-- Image Container -->
                        <div class="hana-image-wrapper">
                            <?php 
                            if (has_post_thumbnail()) {
                                // Force original full size image
                                the_post_thumbnail('full', array('class' => 'hana-img')); 
                            } else {
                                echo '<div class="hana-img-fallback"></div>';
                            }
                            ?>
                            <div class="hana-overlay-gradient"></div>
                        </div>

                        <!-- Content Overlay -->
                        <div class="hana-card-content">
                            <span class="hana-date"><?php echo get_the_date('F j, Y'); ?></span>
                            <h3 class="hana-card-title"><?php the_title(); ?></h3>
                            <span class="hana-read-btn">Read More</span>
                        </div>
                    </a>
                </div>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- Bottom Action -->
        <div class="hana-footer-action">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="hana-view-all-btn">
                Browse All Posts
            </a>
        </div>

    </div>
</section>

<?php endif; ?>
