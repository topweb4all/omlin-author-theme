<?php
/**
 * Template Name: Single Book Template
 * Fixed: Original Hero Layout + New Widget Areas + Series/Genres + Unified Box
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main single-book-page">

<?php if (have_posts()) : while (have_posts()) : the_post(); 

    // البيانات الأصلية
    $subtitle     = get_post_meta(get_the_ID(), '_book_subtitle', true);
    $tagline      = get_post_meta(get_the_ID(), '_book_tagline', true);
    $pages        = get_post_meta(get_the_ID(), '_book_pages', true);
    $format       = get_post_meta(get_the_ID(), '_book_format', true);
    $buy_link     = get_post_meta(get_the_ID(), '_book_buy_link', true);
    $preview_link = get_post_meta(get_the_ID(), '_book_preview_link', true);

    // الحقول الجديدة من cpt-book.php
    $series_name  = get_post_meta(get_the_ID(), '_book_series_name', true);
    $series_num   = get_post_meta(get_the_ID(), '_book_series_number', true);
    $genres       = get_post_meta(get_the_ID(), '_book_genres', true);

    // نص السلسلة
    $series_label = '';
    if ($series_name && $series_num) {
        $series_label = $series_name . ' · Book #' . $series_num;
    } elseif ($series_name) {
        $series_label = $series_name;
    } elseif ($series_num) {
        $series_label = 'Book #' . $series_num;
    }
?>

  <!-- 1. Hero Section -->
  <section class="books-hero section-padding">
    <div class="books-hero-inner">
      
      <div class="books-hero-cover">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('hana-book-large', array('class' => 'book-cover')); ?>
        <?php endif; ?>
      </div>

      <div class="books-hero-content">
        <h1 class="books-title"><?php the_title(); ?></h1>

        <?php if ($subtitle) : ?>
          <p class="books-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>

        <?php if ($tagline) : ?>
          <p class="books-tagline"><?php echo esc_html($tagline); ?></p>
        <?php endif; ?>

        <!-- صندوق موحد واحد لكل التفاصيل -->
        <?php if ($series_label || $genres || $pages || $format) : ?>
          <div class="books-series-box">
            <?php if ($series_label) : ?>
              <div class="books-series-line">
                <span class="series-label"><?php echo esc_html($series_label); ?></span>
              </div>
            <?php endif; ?>

            <?php if ($genres) : ?>
              <div class="books-genres-line">
                <span class="label">Genres:</span>
                <span class="value"><?php echo esc_html($genres); ?></span>
              </div>
            <?php endif; ?>

            <?php if ($pages || $format) : ?>
              <div class="books-details-line">
                <?php if ($pages) : ?>
                  <span class="detail-item"><?php echo esc_html($pages); ?> pages</span>
                <?php endif; ?>
                <?php if ($format) : ?>
                  <span class="detail-item"><?php echo esc_html($format); ?></span>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="books-actions">
          <?php if ($buy_link) : ?>
            <a class="btn btn-primary" href="<?php echo esc_url($buy_link); ?>" target="_blank" rel="noopener">
              Order on Amazon
            </a>
          <?php endif; ?>

          <?php if ($preview_link) : ?>
            <a class="btn btn-ghost" href="<?php echo esc_url($preview_link); ?>" target="_blank" rel="noopener">
              Read Sample
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. About this book -->
  <section class="books-blurb section-padding">
    <div class="section-inner narrow">
      <h2 class="section-title">About this book</h2>
      <div class="book-blurb">
        <?php
        $content = get_post_field('post_content', get_the_ID());
        $content = apply_filters('the_content', $content);
        echo $content;
        ?>
      </div>
    </div>
  </section>

  <!-- 3. Reviews Section -->
  <section class="books-reviews section-padding">
      <div class="section-inner narrow">
          <?php if ( is_active_sidebar( 'book-reviews-area' ) ) : ?>
            <h2 class="section-title text-center">Readers Reviews</h2>
            <div class="reviews-content-wrapper text-center">
                <?php dynamic_sidebar( 'book-reviews-area' ); ?>
            </div>
          <?php endif; ?>
      </div>
  </section>

   <!-- 4. Community / Comments -->
  <section class="books-comments section-padding">
      <div class="section-inner narrow">
          <?php if ( is_active_sidebar( 'book-comments-area' ) ) : ?>
              <div class="comments-widget-area mb-5">
                  <?php dynamic_sidebar( 'book-comments-area' ); ?>
              </div>
          <?php endif; ?>

          <?php 
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            else :
                if (WP_DEBUG) echo '<p style="color:red; text-align:center;">Comments are closed or disabled for this post.</p>';
            endif;
          ?>
      </div>
  </section>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
