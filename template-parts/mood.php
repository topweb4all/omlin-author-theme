<?php
/**
 * Template Part: Mood Section
 * Fully Editable via Widgets
 */
?>

<section class="mood-section section" id="mood-section">
    <div class="container">
        
        <!-- Editable Header -->
        <div class="mood-header text-center">
            <?php if ( is_active_sidebar( 'mood-header-text' ) ) : ?>
                <?php dynamic_sidebar( 'mood-header-text' ); ?>
            <?php else : ?>
                <h2>What's Your Reading Mood?</h2>
                <p>Choose your mood and discover a quote that speaks to your soul</p>
            <?php endif; ?>
        </div>

        <!-- Mood Buttons (Static Layout, triggers dynamic content) -->
        <div class="mood-buttons">
            <button class="mood-btn" data-target="mood-dark" aria-label="Dark Mood">
                <span class="mood-icon">🌑</span>
                <span class="mood-label">Dark</span>
            </button>
            
            <button class="mood-btn" data-target="mood-romantic" aria-label="Romantic Mood">
                <span class="mood-icon">💕</span>
                <span class="mood-label">Romantic</span>
            </button>
            
            <button class="mood-btn" data-target="mood-mysterious" aria-label="Mysterious Mood">
                <span class="mood-icon">🔮</span>
                <span class="mood-label">Mysterious</span>
            </button>
            
            <button class="mood-btn" data-target="mood-hopeful" aria-label="Hopeful Mood">
                <span class="mood-icon">✨</span>
                <span class="mood-label">Hopeful</span>
            </button>
        </div>

        <!-- Quote Display Container -->
        <div class="mood-quote-container text-center">
            
            <!-- Default Message (Shows before clicking) -->
            <div id="mood-default" class="mood-content-area active">
                <div class="mood-quote">
                    <blockquote>
                        <p class="quote-text">Select a mood above to reveal a quote...</p>
                    </blockquote>
                </div>
            </div>

            <!-- Dark Content -->
            <div id="mood-dark" class="mood-content-area" style="display:none;">
                <?php dynamic_sidebar( 'mood-content-dark' ); ?>
            </div>

            <!-- Romantic Content -->
            <div id="mood-romantic" class="mood-content-area" style="display:none;">
                <?php dynamic_sidebar( 'mood-content-romantic' ); ?>
            </div>

            <!-- Mysterious Content -->
            <div id="mood-mysterious" class="mood-content-area" style="display:none;">
                <?php dynamic_sidebar( 'mood-content-mysterious' ); ?>
            </div>

            <!-- Hopeful Content -->
            <div id="mood-hopeful" class="mood-content-area" style="display:none;">
                <?php dynamic_sidebar( 'mood-content-hopeful' ); ?>
            </div>

        </div>

    </div>

    <!-- Simple Script to Handle Switching -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.mood-btn');
        const contents = document.querySelectorAll('.mood-content-area');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                // 1. Remove active class from all buttons
                buttons.forEach(b => b.classList.remove('active'));
                // 2. Add active class to clicked button
                this.classList.add('active');

                // 3. Hide all content areas
                contents.forEach(content => {
                    content.style.display = 'none';
                    content.classList.remove('active');
                });

                // 4. Show the target content
                const targetId = this.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                if(targetContent) {
                    targetContent.style.display = 'block';
                    // Small delay to allow CSS fade-in animation if you have one
                    setTimeout(() => targetContent.classList.add('active'), 10);
                }
            });
        });
    });
    </script>

    <style>
        /* Optional Styles to make the transition smooth */
        .mood-content-area {
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .mood-content-area.active {
            opacity: 1;
        }
        /* Ensure Quote Blocks look good inside */
        .mood-content-area blockquote {
            font-size: 1.5rem;
            font-style: italic;
            border: none;
            padding: 20px;
            background: transparent;
        }
        .mood-btn.active {
            transform: translateY(-5px);
            background-color: var(--primary-color, #333); /* Adjust to your theme color */
            color: #fff;
        }
    </style>
</section>
