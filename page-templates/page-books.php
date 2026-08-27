<?php
/**
 * Template Name: Books Archive
 * Updated: Series + Number overlay on book cards
 */

get_header(); ?>

<style>
/* ============================================
   BOOKS SHOWCASE - OVERLAY DESIGN (UNIQUE CLASSES)
============================================ */

.books-showcase-page .section-padding {
    padding: 100px 0;
    background: transparent;
}

.books-showcase-page .section-inner {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 40px;
    box-sizing: border-box;
}

/* Hero Section */
.books-showcase-hero {
    margin-bottom: 70px;
    text-align: center;
}

.books-showcase-hero .section-title {
    font-size: 4rem;
    color: inherit;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 12px;
    font-weight: 300;
}

.books-showcase-hero .section-subtitle {
    font-family: var(--font-elegant);
    font-size: 1.1rem;
    color: inherit;
    font-style: italic;
    opacity: 0.75;
}

/* Books Grid */
.books-showcase-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 40px;
    margin-bottom: 80px;
}

/* Book Card */
.book-showcase-card {
    position: relative;
    display: block;
    opacity: 0;
    animation: bs-fadeInUp 0.6s ease forwards;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transition: all 0.5s ease;
}

.book-showcase-card:nth-child(1) { animation-delay: 0.1s; }
.book-showcase-card:nth-child(2) { animation-delay: 0.2s; }
.book-showcase-card:nth-child(3) { animation-delay: 0.3s; }
.book-showcase-card:nth-child(4) { animation-delay: 0.4s; }
.book-showcase-card:nth-child(5) { animation-delay: 0.5s; }
.book-showcase-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes bs-fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.book-showcase-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

body.night-mode .book-showcase-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

body.night-mode .book-showcase-card:hover {
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
}

/* Cover Container */
.book-showcase-cover {
    position: relative;
    width: 100%;
    aspect-ratio: 2/3;
    overflow: hidden;
}

/* Image */
.book-showcase-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s ease;
}

.book-showcase-card:hover .book-showcase-cover img {
    transform: scale(1.08);
}

/* Overlay */
.book-showcase-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0) 0%,
        rgba(0, 0, 0, 0.2) 40%,
        rgba(0, 0, 0, 0.7) 85%,
        rgba(0, 0, 0, 0.9) 100%
    );
    z-index: 1;
}

/* Series Label - TOP LEFT (above category) */
.book-showcase-series {
    position: absolute;
    top: 24px;
    left: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-sans);
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: white;
    background: rgba(113, 66, 49, 0.9);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 3;
    transition: all 0.3s ease;
    pointer-events: none;
    margin-bottom: 8px;
}

body.night-mode .book-showcase-series {
    background: rgba(162, 120, 91, 0.9);
}

.book-showcase-card:hover .book-showcase-series {
    background: rgba(113, 66, 49, 1);
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
}

/* Category Button - TOP LEFT (under series) */
.book-showcase-category {
    position: absolute;
    top: 80px;
    left: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-sans);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: white;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 12px 28px;
    border-radius: 50px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    z-index: 3;
    transition: all 0.3s ease;
    pointer-events: none;
}

body.night-mode .book-showcase-category {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.4);
}

.book-showcase-card:hover .book-showcase-category {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
}

/* Content Overlay */
.book-showcase-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 35px 28px;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

/* Script watermark */
.book-showcase-script {
    font-family: var(--font-elegant);
    font-size: 3.8rem;
    font-weight: 400;
    font-style: italic;
    color: rgba(255, 255, 255, 0.12);
    line-height: 0.9;
    margin-bottom: -25px;
    letter-spacing: 3px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Title */
.book-showcase-title {
    margin: 0;
    text-align: center;
    width: 100%;
}

.book-showcase-title a {
    font-family: var(--font-heading);
    font-size: 1.9rem;
    font-weight: 500;
    line-height: 1.3;
    color: white;
    text-decoration: none;
    display: block;
    letter-spacing: 1px;
    transition: opacity 0.3s ease;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.book-showcase-title a:hover {
    opacity: 0.8;
}

/* Read More button */
.book-showcase-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: var(--font-sans);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: white;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 12px 28px;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.book-showcase-button::after {
    content: '→';
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.book-showcase-button:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateX(3px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
}

.book-showcase-button:hover::after {
    transform: translateX(4px);
}

/* Empty */
.books-showcase-list > p {
    text-align: center;
    font-family: var(--font-elegant);
    font-size: 1.4rem;
    color: inherit;
    padding: 100px 20px;
    font-style: italic;
    opacity: 0.7;
}

/* Responsive (مختصر) */
@media (max-width: 1024px) {
    .books-showcase-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 35px;
    }
    .books-showcase-hero .section-title { font-size: 3rem; }
    .book-showcase-script { font-size: 3rem; }
    .book-showcase-title a { font-size: 1.6rem; }
}

@media (max-width: 768px) {
    .books-showcase-page .section-padding { padding: 80px 0; }
    .books-showcase-page .section-inner { padding: 0 24px; }
    .books-showcase-hero .section-title {
        font-size: 2.5rem;
        letter-spacing: 6px;
    }
    .books-showcase-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    .book-showcase-script {
        font-size: 2.5rem;
        margin-bottom: -15px;
    }
    .book-showcase-title a { font-size: 1.4rem; }
    .book-showcase-content {
        padding: 25px 20px;
        gap: 16px;
    }
    .book-showcase-series {
        top: 18px;
        left: 18px;
        font-size: 0.6rem;
        padding: 6px 16px;
    }
    .book-showcase-category {
        top: 64px;
        font-size: 0.65rem;
        padding: 10px 22px;
    }
    .book-showcase-button {
        font-size: 0.65rem;
        padding: 10px 24px;
    }
}

@media (max-width: 600px) {
    .book-showcase-script { font-size: 2rem; }
    .book-showcase-title a { font-size: 1.25rem; }
}

@media (max-width: 480px) {
    .books-showcase-page .section-padding { padding: 60px 0; }
    .books-showcase-page .section-inner { padding: 0 20px; }
    .books-showcase-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto 60px;
        gap: 30px;
    }
    .books-showcase-hero .section-title {
        font-size: 1.8rem;
        letter-spacing: 3px;
    }
    .book-showcase-script {
        font-size: 1.8rem;
        margin-bottom: -10px;
    }
    .book-showcase-title a { font-size: 1.2rem; }
    .book-showcase-button {
        width: calc(100% - 40px);
        justify-content: center;
    }
    .book-showcase-series {
        top: 16px;
        left: 16px;
        padding: 6px 14px;
    }
    .book-showcase-category {
        top: 56px;
        padding: 8px 20px;
    }
}
</style>

<main class="books-showcase-page">
    <div class="section-padding">
        <div class="section-inner">
            
            <div class="books-showcase-hero">
                <h1 class="section-title">Books</h1>
                <p class="section-subtitle">Explore my collection of dark, twisted, and beautiful stories.</p>
            </div>

            <div class="books-showcase-list">
                <?php
                $books_query = new WP_Query(array(
                    'post_type'      => 'book',
                    'posts_per_page' => 12,
                    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));

                if ($books_query->have_posts()) : ?>
                    <div class="books-showcase-grid">
                        <?php while ($books_query->have_posts()) : $books_query->the_post(); 

                            // === جلب بيانات السلسلة + الكاتيجري ===
                            $series_name  = get_post_meta(get_the_ID(), '_book_series_name', true);
                            $series_num   = get_post_meta(get_the_ID(), '_book_series_number', true);
                            $category_name = '';
                            $taxonomies    = get_object_taxonomies( 'book', 'names' );

                            if ( ! empty( $taxonomies ) && is_array( $taxonomies ) ) {
                                foreach ( $taxonomies as $tax_slug ) {
                                    $terms = get_the_terms( get_the_ID(), $tax_slug );
                                    if ( $terms && ! is_wp_error( $terms ) ) {
                                        $category_name = $terms[0]->name;
                                        break;
                                    }
                                }
                            }

                            // نص السلسلة
                            $series_label = '';
                            if ($series_name && $series_num) {
                                $series_label = $series_name . ' #' . $series_num;
                            } elseif ($series_name) {
                                $series_label = $series_name;
                            } elseif ($series_num) {
                                $series_label = 'Book #' . $series_num;
                            }

                            // Script watermark (أول كلمة من العنوان)
                            $title        = get_the_title();
                            $parts        = explode(' ', $title);
                            $script_title = $parts[0] ?? $title;
                        ?>
                            <article class="book-showcase-card">
                                <div class="book-showcase-cover">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-book-cover.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>

                                    <div class="book-showcase-overlay"></div>

                                    <!-- Series Label - TOP LEFT -->
                                    <?php if ($series_label) : ?>
                                        <span class="book-showcase-series"><?php echo esc_html($series_label); ?></span>
                                    <?php endif; ?>

                                    <!-- Category - TOP LEFT (under series) -->
                                    <?php if ($category_name) : ?>
                                        <span class="book-showcase-category"><?php echo esc_html($category_name); ?></span>
                                    <?php endif; ?>

                                    <div class="book-showcase-content">
                                        <div class="book-showcase-script">
                                            <?php echo esc_html($script_title); ?>
                                        </div>

                                        <h2 class="book-showcase-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <a href="<?php the_permalink(); ?>" class="book-showcase-button">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php if ($books_query->max_num_pages > 1) : ?>
                        <div class="books-showcase-pagination">
                            <?php
                            echo paginate_links(array(
                                'total'     => $books_query->max_num_pages,
                                'prev_text' => '←',
                                'next_text' => '→',
                                'type'      => 'list'
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <p>No books found. Check back soon for new releases!</p>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
