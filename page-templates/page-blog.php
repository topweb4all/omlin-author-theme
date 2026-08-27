<?php
/**
 * Template Name: Blog Page
 * 
 * @package Hana_Tsuki
 */

get_header();
?>

<!-- Blog Styles - Inline to ensure loading -->
<style>
/* Blog Page Styles */
.blog-page { background: transparent; min-height: 100vh; }

/* Page Header */
.blog-hero { text-align: center; padding: 80px 0 60px; max-width: 800px; margin: 0 auto; }
.blog-hero .page-title { font-family: var(--font-decorative, "Cinzel Decorative", serif); font-size: 3.5rem; letter-spacing: 0.15em; text-transform: uppercase; margin: 0 0 24px 0; color: var(--text-color, #f5eee5); text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); }
.blog-hero-text { font-family: var(--font-elegant, "Cormorant Garamond", serif); font-size: 1.3rem; line-height: 1.8; color: var(--text-color, #f5eee5); opacity: 0.85; font-style: italic; max-width: 600px; margin: 0 auto; }
.blog-hero-divider { width: 80px; height: 1px; background: var(--accent-color, #714231); margin: 40px auto 0; opacity: 0.5; }

/* Blog Section */
.blog-section { max-width: 1100px; margin: 0 auto; padding: 40px 24px 80px; }

/* Featured Post Card */
.blog-featured-post { background: linear-gradient(145deg, color-mix(in srgb, var(--bg-color, #050508) 90%, #ffffff 10%), color-mix(in srgb, var(--bg-color, #050508) 95%, #ffffff 5%)); border: 1px solid color-mix(in srgb, var(--text-color, #f5eee5) 10%, transparent); border-radius: 20px; overflow: hidden; box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6); transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
.blog-featured-post:hover { transform: translateY(-6px); box-shadow: 0 35px 90px rgba(0, 0, 0, 0.7); }

/* Featured Image */
.blog-featured-image { position: relative; width: 100%; height: 0; padding-bottom: 50%; overflow: hidden; background: linear-gradient(135deg, rgba(113, 66, 49, 0.2) 0%, rgba(0, 0, 0, 0.8) 100%); }
.blog-featured-image img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform 0.8s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.4s ease; opacity: 0.9; }
.blog-featured-post:hover .blog-featured-image img { transform: scale(1.08); opacity: 1; }
.blog-image-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.3) 50%, rgba(5, 5, 8, 0.85) 100%); z-index: 1; }
.blog-featured-image::before { content: ''; position: absolute; top: 20px; left: 20px; width: 60px; height: 60px; border-top: 2px solid var(--accent-color, #714231); border-left: 2px solid var(--accent-color, #714231); opacity: 0.6; z-index: 2; transition: opacity 0.3s ease; }
.blog-featured-post:hover .blog-featured-image::before { opacity: 1; }

/* Post Content */
.blog-featured-content { padding: 50px 45px 45px; }
.blog-post-category { display: inline-block; padding: 8px 20px; background: var(--accent-color, #714231); color: var(--accent-text, #f5eee5); border-radius: 4px; font-family: var(--font-sans, "DM Sans", sans-serif); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.18em; font-weight: 700; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(113, 66, 49, 0.3); }
.blog-post-title { font-family: var(--font-elegant, "Playfair Display", serif); font-size: 2.8rem; line-height: 1.25; margin: 0 0 20px 0; color: var(--text-color, #f5eee5); letter-spacing: 0.02em; font-weight: 600; }
.blog-post-title a { color: inherit; text-decoration: none; transition: color 0.3s ease; }
.blog-post-title a:hover { color: var(--accent-color, #714231); }
.blog-post-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 20px; font-family: var(--font-sans, "DM Sans", sans-serif); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.15em; color: var(--text-color, #f5eee5); opacity: 0.6; margin-bottom: 28px; }
.blog-post-meta span { display: flex; align-items: center; gap: 8px; }
.blog-post-meta svg { opacity: 0.7; }
.meta-separator { width: 3px; height: 3px; background: var(--accent-color, #714231); border-radius: 50%; margin: 0; }
.blog-post-excerpt { font-family: var(--font-body, "Alice", serif); font-size: 1.15rem; line-height: 1.9; color: var(--text-color, #f5eee5); opacity: 0.88; margin: 0 0 40px 0; max-width: 900px; }
.blog-read-more { display: inline-flex; align-items: center; gap: 12px; padding: 16px 40px; background: var(--accent-color, #714231); color: var(--accent-text, #f5eee5); text-decoration: none; font-family: var(--font-sans, "DM Sans", sans-serif); font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; border-radius: 4px; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); box-shadow: 0 8px 20px rgba(113, 66, 49, 0.4); border: 1px solid transparent; }
.blog-read-more:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(113, 66, 49, 0.6); }
.blog-read-more svg { width: 16px; height: 16px; transition: transform 0.3s ease; }
.blog-read-more:hover svg { transform: translateX(5px); }

/* Pagination */
.blog-pagination { margin-top: 70px; padding-top: 45px; border-top: 1px solid color-mix(in srgb, var(--text-color, #f5eee5) 8%, transparent); }
.blog-pagination .nav-links, .blog-pagination ul.page-numbers { list-style: none !important; padding: 0 !important; margin: 0 !important; display: flex !important; flex-direction: row !important; justify-content: center !important; align-items: center !important; gap: 10px !important; flex-wrap: wrap; }
.blog-pagination ul.page-numbers li { list-style: none !important; margin: 0 !important; padding: 0 !important; display: inline-flex !important; }
.blog-pagination a.page-numbers, .blog-pagination span.page-numbers, .blog-pagination .page-numbers { display: inline-flex !important; align-items: center !important; justify-content: center !important; min-width: 48px; height: 48px; padding: 0 18px; text-align: center; border-radius: 8px; text-decoration: none; font-family: var(--font-sans, "DM Sans", sans-serif); font-size: 0.95rem; font-weight: 600; letter-spacing: 0.03em; color: var(--text-color, #f5eee5); background: color-mix(in srgb, var(--bg-color, #050508) 88%, #ffffff 12%); border: 1px solid color-mix(in srgb, var(--text-color, #f5eee5) 15%, transparent); transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); box-sizing: border-box; }
a.page-numbers:hover { background: var(--accent-color, #714231) !important; border-color: var(--accent-color, #714231) !important; color: var(--accent-text, #f5eee5) !important; transform: translateY(-2px); box-shadow: 0 8px 22px rgba(113, 66, 49, 0.45); }
span.page-numbers.current { background: var(--accent-color, #714231) !important; border-color: var(--accent-color, #714231) !important; color: var(--accent-text, #f5eee5) !important; box-shadow: 0 5px 15px rgba(113, 66, 49, 0.4); cursor: default; font-weight: 700; }
.page-numbers.prev, .page-numbers.next { min-width: auto !important; padding: 0 28px !important; font-weight: 700; font-size: 0.9rem; }
span.page-numbers.dots { background: transparent !important; border: none !important; color: var(--text-color, #f5eee5); opacity: 0.4; cursor: default; min-width: 35px !important; box-shadow: none !important; }

/* Empty State */
.blog-empty-state { text-align: center; padding: 100px 20px; max-width: 600px; margin: 0 auto; }
.blog-empty-state h2 { font-family: var(--font-elegant, "Playfair Display", serif); font-size: 2.5rem; margin-bottom: 20px; color: var(--text-color, #f5eee5); }
.blog-empty-state p { font-family: var(--font-body, "Alice", serif); font-size: 1.2rem; line-height: 1.8; color: var(--text-color, #f5eee5); opacity: 0.7; }

/* Responsive */
@media (max-width: 992px) {
    .blog-hero .page-title { font-size: 2.8rem; }
    .blog-featured-image { padding-bottom: 55%; }
    .blog-featured-content { padding: 40px 35px; }
    .blog-post-title { font-size: 2.2rem; }
    .blog-post-excerpt { font-size: 1.05rem; }
    .blog-pagination .page-numbers { min-width: 44px; height: 44px; padding: 0 16px; font-size: 0.9rem; }
}

@media (max-width: 768px) {
    .blog-hero { padding: 60px 20px 40px; }
    .blog-hero .page-title { font-size: 2.2rem; letter-spacing: 0.1em; }
    .blog-hero-text { font-size: 1.1rem; }
    .blog-section { padding: 30px 18px 60px; }
    .blog-featured-post { border-radius: 16px; }
    .blog-featured-image { padding-bottom: 65%; }
    .blog-featured-image::before { width: 40px; height: 40px; top: 15px; left: 15px; }
    .blog-featured-content { padding: 32px 24px; }
    .blog-post-title { font-size: 1.8rem; }
    .blog-post-excerpt { font-size: 1rem; line-height: 1.8; }
    .blog-post-meta { font-size: 0.72rem; gap: 12px; }
    .blog-read-more { width: 100%; justify-content: center; padding: 14px 30px; }
    .blog-pagination .page-numbers { min-width: 42px; height: 42px; padding: 0 14px; font-size: 0.85rem; }
}

@media (max-width: 480px) {
    .blog-hero .page-title { font-size: 1.9rem; }
    .blog-featured-image { padding-bottom: 75%; }
    .blog-featured-content { padding: 28px 20px; }
    .blog-post-category { font-size: 0.7rem; padding: 6px 16px; }
    .blog-post-title { font-size: 1.6rem; }
    .blog-post-excerpt { font-size: 0.95rem; }
    .blog-read-more { font-size: 0.8rem; padding: 12px 24px; }
    .blog-pagination .page-numbers { min-width: 38px; height: 38px; padding: 0 10px; font-size: 0.8rem; }
}

/* Night Mode */
.night-mode .blog-featured-post { background: linear-gradient(145deg, color-mix(in srgb, var(--bg-color, #050508) 92%, #ffffff 8%), color-mix(in srgb, var(--bg-color, #050508) 96%, #ffffff 4%)); border-color: color-mix(in srgb, var(--text-color, #f5eee5) 14%, transparent); }
.night-mode .blog-pagination .page-numbers { background: color-mix(in srgb, var(--bg-color, #050508) 82%, #ffffff 18%); border-color: color-mix(in srgb, var(--text-color, #f5eee5) 18%, transparent); }
</style>

<div class="blog-page">
    
    <!-- Blog Hero -->
    <section class="blog-hero">
        <h1 class="page-title">Blog</h1>
        <p class="blog-hero-text">
            Stories, inspirations, and behind-the-scenes glimpses into my writing world.
        </p>
        <div class="blog-hero-divider"></div>
    </section>

    <!-- Blog Content -->
    <section class="blog-section">
        
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $blog_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 1,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish'
        ));

        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-featured-post'); ?>>
            
            <div class="blog-featured-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    <div style="width:100%;height:100%;background:linear-gradient(135deg, rgba(113,66,49,0.3) 0%, rgba(0,0,0,0.7) 100%);"></div>
                <?php endif; ?>
                <div class="blog-image-overlay"></div>
            </div>
            
            <div class="blog-featured-content">
                
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                    <span class="blog-post-category">
                        <?php echo esc_html($categories[0]->name); ?>
                    </span>
                <?php endif; ?>
                
                <h2 class="blog-post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                
                <div class="blog-post-meta">
                    <span class="post-date">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <?php echo get_the_date('F j, Y'); ?>
                    </span>
                    
                    <span class="meta-separator"></span>
                    
                    <span class="post-author">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <?php echo get_the_author(); ?>
                    </span>
                    
                    <?php if (get_comments_number() > 0) : ?>
                        <span class="meta-separator"></span>
                        <span class="post-comments">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <?php comments_number('0', '1', '%'); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="blog-post-excerpt">
                    <?php 
                    if (has_excerpt()) {
                        echo wp_trim_words(get_the_excerpt(), 40, '...');
                    } else {
                        echo wp_trim_words(get_the_content(), 40, '...');
                    }
                    ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="blog-read-more">
                    Continue Reading
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                
            </div>
            
        </article>
        
        <?php
            endwhile;
            
            if ($blog_query->max_num_pages > 1) :
        ?>
            <nav class="blog-pagination">
                <?php
                echo paginate_links(array(
                    'total'        => $blog_query->max_num_pages,
                    'current'      => $paged,
                    'prev_text'    => '← Previous',
                    'next_text'    => 'Next →',
                    'type'         => 'list',
                    'mid_size'     => 2,
                    'end_size'     => 1,
                ));
                ?>
            </nav>
        <?php
            endif;
            
            wp_reset_postdata();
            
        else :
        ?>
            <div class="blog-empty-state">
                <h2>No Stories Yet</h2>
                <p>The pages are waiting to be filled. Check back soon for new tales.</p>
            </div>
        <?php
        endif;
        ?>
        
    </section>

</div>

<?php
get_footer();
?>
