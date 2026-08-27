<?php
/**
 * Template Name: Front Page - Book Showcase
 * @package Omlin_Author_Theme
 */

get_header();
?>

<div class="home-page book-showcase">
    
    <!-- Hero Section - Main Book Showcase -->
    <section class="hero-book-section section">
        <div class="container">
            
            <?php
            // Get the latest book (Dynamic as requested)
            $latest_book = new WP_Query(array(
                'post_type' => 'book',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($latest_book->have_posts()) :
                while ($latest_book->have_posts()) : $latest_book->the_post();
                    $buy_link = get_post_meta(get_the_ID(), '_book_buy_link', true);
                    $preview_link = get_post_meta(get_the_ID(), '_book_preview_link', true);
            ?>

            <!-- Book Title -->
            <div class="book-hero-title text-center">
                <h1 class="main-book-title"><?php the_title(); ?></h1>
            </div>

            <!-- Book Content Grid -->
            <div class="book-hero-grid">
                
                <!-- Left Column - Reviews (EDITABLE via Blocks) -->
                <div class="hero-reviews-left">
                    <?php if ( is_active_sidebar( 'hero-reviews-left' ) ) : ?>
                        <?php dynamic_sidebar( 'hero-reviews-left' ); ?>
                    <?php else : ?>
                        <!-- Fallback content if empty -->
                        <div class="review-quote"><p>Add reviews in Appearance > Widgets</p></div>
                    <?php endif; ?>
                </div>

                <!-- Center Column - Book Cover (Dynamic) -->
                <div class="hero-book-cover">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="book-cover-wrapper">
                            <?php the_post_thumbnail('book-large', array(
                                'class' => 'main-book-image',
                                'alt' => get_the_title()
                            )); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column - Reviews (EDITABLE via Blocks) -->
                <div class="hero-reviews-right">
                    <?php if ( is_active_sidebar( 'hero-reviews-right' ) ) : ?>
                        <?php dynamic_sidebar( 'hero-reviews-right' ); ?>
                    <?php else : ?>
                         <!-- Fallback content if empty -->
                        <div class="review-quote"><p>Add reviews in Appearance > Widgets</p></div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="hero-actions text-center">
                <?php if ($buy_link) : ?>
                    <a href="<?php echo esc_url($buy_link); ?>" class="btn btn-primary btn-large" target="_blank">Order Now</a>
                <?php endif; ?>
                
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-large">Learn More</a>
                
                <?php if ($preview_link) : ?>
                    <a href="<?php echo esc_url($preview_link); ?>" class="btn btn-outline btn-large" target="_blank">Read Sample</a>
                <?php endif; ?>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="no-book-message text-center">
                    <h2>Coming Soon</h2>
                </div>
            <?php endif; ?>

        </div>
    </section>

       <!-- About Section -->
    <section class="home-about section-padding">
      <div class="section-inner home-about-inner">
        
        <div class="home-about-text">
          <!-- Editable Text via Blocks -->
          <?php if ( is_active_sidebar( 'home-about-text' ) ) : ?>
                <?php dynamic_sidebar( 'home-about-text' ); ?>
          <?php else : ?>
                <h2 class="section-title">About Author name</h2>
                <p>Add your bio text via Widgets.</p>
          <?php endif; ?>
          
          <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn-ghost">
            Read my full story
          </a>
        </div>

        <div class="home-about-photo">
          <div class="home-about-frame">
            <!-- هنا التغيير: فحصنا هل يوجد ويدجت للصورة أم لا -->
            <?php if ( is_active_sidebar( 'home-about-image' ) ) : ?>
                <?php dynamic_sidebar( 'home-about-image' ); ?>
            <?php else : ?>
                <!-- الصورة الافتراضية تظهر فقط إذا لم تقومي برفع صورة جديدة -->
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-portrait.jpg' ); ?>" alt="Author Portrait">
            <?php endif; ?>
          </div>
        </div>
        
      </div>
    </section>


    <!-- Mood Selection Section -->
    <?php get_template_part('template-parts/mood'); ?>

    <!-- Blog Highlights Section -->
    <?php get_template_part('template-parts/blog-highlights'); ?>

    <!-- Newsletter Section -->
    <section class="newsletter-section section">
        <div class="container">
            <div class="newsletter-wrapper text-center">
                
                <!-- Editable Newsletter Title/Text -->
                <?php if ( is_active_sidebar( 'home-newsletter-text' ) ) : ?>
                    <?php dynamic_sidebar( 'home-newsletter-text' ); ?>
                <?php else : ?>
                    <h2>Join My Reading Circle</h2>
                    <p>Get updates on new releases...</p>
                <?php endif; ?>
                
                <!-- Form Logic (Keep hardcoded for styling or use Shortcode block in widget) -->
                <form class="newsletter-form" action="#" method="post">
                    <div class="form-group-inline">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
