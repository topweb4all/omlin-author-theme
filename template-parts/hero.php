<?php
/**
 * Template Part: Hero Section
 * Displays the latest book
 */

$latest_book = hana_tsuki_get_latest_book();

if ($latest_book->have_posts()) :
    while ($latest_book->have_posts()) : $latest_book->the_post();
        $buy_link = get_post_meta(get_the_ID(), '_book_buy_link', true);
        $preview_link = get_post_meta(get_the_ID(), '_book_preview_link', true);
?>

<section class="hero-section">
    <div class="container">
        <div class="hero-wrapper">
            
            <!-- Book Cover -->
            <div class="hero-image">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="book-cover">
                        <?php the_post_thumbnail('book-large', array('alt' => get_the_title())); ?>
                        <div class="book-shadow"></div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Book Info -->
            <div class="hero-content">
                <span class="hero-label">Latest Release</span>
                <h1 class="hero-title"><?php the_title(); ?></h1>
                
                <!-- Genre Tags -->
                <?php
                $genres = get_the_terms(get_the_ID(), 'genre');
                if ($genres && !is_wp_error($genres)) :
                ?>
                    <div class="book-genres">
                        <?php foreach ($genres as $genre) : ?>
                            <span class="genre-tag"><?php echo esc_html($genre->name); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Excerpt/Description -->
                <div class="hero-description">
                    <?php the_excerpt(); ?>
                </div>

                <!-- CTA Buttons -->
                <div class="hero-actions">
                    <?php if ($buy_link) : ?>
                        <a href="<?php echo esc_url($buy_link); ?>" class="btn btn-primary" target="_blank">
                            Buy Now
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($preview_link) : ?>
                        <a href="<?php echo esc_url($preview_link); ?>" class="btn" target="_blank">
                            Read Sample
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Book Stats (Optional) -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-icon">⭐</span>
                        <span class="stat-text">4.8/5 Rating</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">📚</span>
                        <span class="stat-text">10K+ Readers</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="hero-decoration">
        <svg class="hero-pattern" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="2" fill="currentColor" opacity="0.3"/>
        </svg>
    </div>
</section>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>