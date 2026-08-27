<?php
/**
 * Archive Template for Books CPT
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main books-archive-page">

  <section class="books-archive-hero section-padding">
    <div class="section-inner narrow">
      <h1 class="section-title">My Books</h1>
      <p class="section-subtitle">
        Explore my collection of dark, twisted, and beautiful stories.
      </p>
    </div>
  </section>

  <section class="books-archive-list section-padding">
    <div class="section-inner">

      <?php if (have_posts()) : ?>

        <div class="books-archive-grid">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('book-archive-card'); ?>>

              <a href="<?php the_permalink(); ?>" class="book-archive-cover">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('hana-book-thumb', array('class' => 'book-cover')); ?>
                <?php endif; ?>
              </a>

              <div class="book-archive-content">
                <h2 class="book-archive-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <?php if (has_excerpt()) : ?>
                  <p class="book-archive-excerpt">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?>
                  </p>
                <?php endif; ?>

                <a href="<?php the_permalink(); ?>" class="book-archive-readmore">
                  View details
                </a>
              </div>

            </article>
          <?php endwhile; ?>
        </div>

        <div class="books-archive-pagination">
          <?php
          the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '&larr; Previous',
            'next_text' => 'Next &rarr;',
          ));
          ?>
        </div>

      <?php else : ?>

        <p>No books found yet.</p>

      <?php endif; ?>

    </div>
  </section>

</main>

<?php
get_footer();
