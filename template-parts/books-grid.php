<?php
/**
 * Template Part: Books Grid
 * Display all books in a grid layout with improved structure
 */

// Get all books
$books_query = hana_tsuki_get_all_books();
?>

<section class="books-grid-section section">
    <div class="container">
        
        <!-- Section Header -->
        <div class="section-header text-center">
            <h2>My Books</h2>
            <p>Explore my collection of stories that will transport you to different worlds</p>
        </div>

        <?php if ($books_query->have_posts()) : ?>
            
            <!-- Books Grid -->
            <div class="books-grid">
                <?php 
                while ($books_query->have_posts()) : 
                    $books_query->the_post();
                    
                    // Get book metadata
                    $book_id = get_the_ID();
                    $buy_link = get_post_meta($book_id, '_book_buy_link', true);
                    $preview_link = get_post_meta($book_id, '_book_preview_link', true);
                    $genres = get_the_terms($book_id, 'genre');
                    $has_thumbnail = has_post_thumbnail();
                ?>
                
                <!-- Book Card -->
                <article class="book-card" itemscope itemtype="http://schema.org/Book">
                    
                    <?php if ($has_thumbnail) : ?>
                        <!-- Book Cover with Overlay -->
                        <div class="book-card-image">
                            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <?php 
                                the_post_thumbnail('book-thumbnail', [
                                    'alt' => get_the_title(),
                                    'itemprop' => 'image'
                                ]); 
                                ?>
                            </a>
                            
                            <!-- Hover Overlay with Action Buttons -->
                            <div class="book-overlay">
                                <div class="book-overlay-buttons">
                                    <?php if ($buy_link) : ?>
                                        <a href="<?php echo esc_url($buy_link); ?>" 
                                           class="overlay-btn btn-primary" 
                                           target="_blank" 
                                           rel="noopener noreferrer">
                                            <span>Buy Now</span>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($preview_link) : ?>
                                        <a href="<?php echo esc_url($preview_link); ?>" 
                                           class="overlay-btn btn-secondary" 
                                           target="_blank" 
                                           rel="noopener noreferrer">
                                            <span>Preview</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Book Content -->
                    <div class="book-card-content">
                        
                        <!-- Genre Tags -->
                        <?php if ($genres && !is_wp_error($genres)) : ?>
                            <div class="book-card-genres">
                                <?php foreach ($genres as $genre) : ?>
                                    <span class="genre-tag-small" itemprop="genre">
                                        <?php echo esc_html($genre->name); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Book Title -->
                        <h3 class="book-card-title" itemprop="name">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <!-- Book Excerpt -->
                        <div class="book-card-excerpt" itemprop="description">
                            <?php 
                            $excerpt = get_the_excerpt();
                            echo wp_trim_words($excerpt, 20, '...');
                            ?>
                        </div>

                        <!-- Action Links -->
                        <?php if ($buy_link) : ?>
                            <div class="book-card-actions">
                                <a href="<?php echo esc_url($buy_link); ?>" 
                                   class="btn-text" 
                                   target="_blank" 
                                   rel="noopener noreferrer">
                                    Buy Now →
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </article>

                <?php endwhile; ?>
                
            </div>

            <!-- View All Books Button -->
            <div class="section-footer text-center">
                <?php 
                $books_page = get_page_by_path('books');
                if ($books_page) :
                ?>
                    <a href="<?php echo esc_url(get_permalink($books_page)); ?>" class="btn btn-primary">
                        View All Books
                    </a>
                <?php endif; ?>
            </div>

        <?php else : ?>
            
            <!-- No Books Message -->
            <div class="no-books-message text-center">
                <div class="empty-state">
                    <p>No books available at the moment.</p>
                    <p class="text-muted">Stay tuned for upcoming releases!</p>
                </div>
            </div>

        <?php endif; ?>

        <?php 
        // Reset post data
        wp_reset_postdata(); 
        ?>

    </div>
</section>