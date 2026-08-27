<?php
/**
 * Template Name: About Page
 * Fully editable via Gutenberg Blocks/Widgets
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main about-page">

  <!-- Hero Section -->
  <section class="about-hero section-padding">
    <div class="section-inner about-hero-inner">

      <!-- Left Column: Editable Author Image -->
      <div class="about-hero-photo">
        <div class="about-photo-frame">
          <?php if ( is_active_sidebar( 'about-hero-image' ) ) : ?>
              <?php dynamic_sidebar( 'about-hero-image' ); ?>
          <?php else : ?>
              <!-- Fallback Image -->
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-portrait.jpg' ); ?>" alt="Author Portrait">
          <?php endif; ?>
        </div>
      </div>

      <!-- Right Column: Editable Text & Socials -->
      <div class="about-hero-text">
        
        <!-- 1. Kicker, Name, Tagline -->
        <?php if ( is_active_sidebar( 'about-hero-text' ) ) : ?>
            <?php dynamic_sidebar( 'about-hero-text' ); ?>
        <?php else : ?>
            <p class="about-kicker">ABOUT THE AUTHOR</p>
            <h1 class="about-name">Author name</h1>
            <p class="about-tagline">Insert a captivating author tagline here that describes your writing style and genre.</p>
        <?php endif; ?>

        <!-- 2. Meta List (Location, Genres, Series) -->
        <div class="about-meta-list-wrapper">
            <?php if ( is_active_sidebar( 'about-hero-meta' ) ) : ?>
                <?php dynamic_sidebar( 'about-hero-meta' ); ?>
            <?php else : ?>
                <ul class="about-meta-list">
                    <li><strong>Based in:</strong> City, Country</li>
                    <li><strong>Genres:</strong> Your Genre Here</li>
                </ul>
            <?php endif; ?>
        </div>

        <!-- 3. Social Media Icons (Improved) -->
        <div class="about-social">
            <?php if ( is_active_sidebar( 'about-hero-social' ) ) : ?>
                <?php dynamic_sidebar( 'about-hero-social' ); ?>
            <?php else : ?>
                <p>Add Social Icons via Widgets</p>
            <?php endif; ?>
        </div>
        
      </div>

    </div>
  </section>

  <!-- Story Section (Editable via Page Editor) -->
  <section class="about-story section-padding">
    <div class="section-inner narrow">
      <!-- Title can be part of the page content or hardcoded -->
      <h2 class="section-title">My promise to you</h2>
      
      <div class="about-story-body">
        <?php
        // Standard WordPress content output
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
