<?php
/**
 * Single Post Template - Historical Paper Design
 * Complete file with inline CSS for Night Mode compatibility
 */

get_header(); ?>

<main id="primary" class="site-main single-post-page">
    
<style>
/* ============================================
   SINGLE POST - HISTORICAL PAPER DESIGN (INLINE)
============================================ */

/* Post Container */
.single-post-page {
    background-color: #f5f5f5;
    padding: 80px 0 100px;
    min-height: 100vh;
}

/* Historical Paper Wrapper */
.historical-paper {
    max-width: 850px;
    margin: 0 auto;
    background-color: #fdfbf7;
    padding: 80px 100px;
    box-shadow: 
        0 2px 4px rgba(0, 0, 0, 0.05),
        0 8px 16px rgba(0, 0, 0, 0.08),
        0 16px 32px rgba(0, 0, 0, 0.08);
    position: relative;
    border: 1px solid #e8e4dc;
}

/* Paper Texture */
.historical-paper::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image: 
        repeating-linear-gradient(0deg, rgba(0,0,0,0.01) 0px, transparent 1px, transparent 2px, rgba(0,0,0,0.01) 3px);
    pointer-events: none;
    opacity: 0.3;
}

/* Paper Edges */
.historical-paper::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    border: 12px solid transparent;
    border-image: linear-gradient(to bottom, rgba(139,115,85,0.15), transparent 10%, transparent 90%, rgba(139,115,85,0.15)) 1;
    pointer-events: none;
}

/* Post Header */
.post-header { text-align: center; margin-bottom: 60px; position: relative; z-index: 1; }

/* Category */
.post-category {
    display: inline-block;
    padding: 8px 20px;
    background: #714231;
    color: white;
    font-family: "DM Sans", sans-serif;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 700;
    margin-bottom: 30px;
    border-radius: 2px;
}

/* Title */
.post-title {
    font-family: "Cinzel Decorative", serif !important;
    font-size: 3rem !important;
    line-height: 1.2 !important;
    color: #111 !important;
    margin: 0 0 24px 0 !important;
    font-weight: 400 !important;
    letter-spacing: 1px !important;
}

/* Date */
.post-date {
    font-family: "Cormorant Garamond", serif !important;
    font-size: 1rem !important;
    color: #a2785b !important;
    font-style: italic !important;
}

.post-date time::before,
.post-date time::after {
    content: '—';
    margin: 0 12px;
    color: #536564;
}

/* Featured Image */
.post-featured-image { margin-bottom: 60px; position: relative; z-index: 1; }
.featured-img {
    width: 100%; height: auto;
    display: block;
    border: 1px solid #e0d8c8;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Content */
.post-content {
    font-family: "Alice", serif !important;
    font-size: 1.15rem !important;
    line-height: 1.9 !important;
    color: #2c2c2c !important;
    margin-bottom: 60px !important;
    position: relative; z-index: 1;
}

/* Drop Cap */
.post-content > p:first-of-type::first-letter {
    font-family: "Cinzel Decorative", serif !important;
    font-size: 4.5rem !important;
    line-height: 0.85 !important;
    float: left;
    margin: 8px 16px 0 0;
    color: #714231 !important;
    font-weight: 700 !important;
}

/* Headings */
.post-content h2 {
    font-family: "Cinzel Decorative", serif !important;
    font-size: 2rem !important;
    color: #714231 !important;
    margin: 60px 0 24px 0 !important;
    text-align: center !important;
    position: relative !important;
}

.post-content h2::after {
    content: '';
    display: block;
    width: 80px; height: 2px;
    background: #a2785b;
    margin: 20px auto 0;
}

.post-content h3 {
    font-family: "Cormorant Garamond", serif !important;
    font-size: 1.6rem !important;
    color: #a2785b !important;
    margin: 48px 0 20px 0 !important;
    font-weight: 600 !important;
}

/* Blockquote */
.post-content blockquote {
    margin: 48px 0 !important;
    padding: 32px 48px !important;
    background: #f9f7f3 !important;
    border-left: 4px solid #714231 !important;
    border-right: 4px solid #714231 !important;
    position: relative !important;
}

.post-content blockquote::before {
    content: '"';
    font-family: "Cinzel Decorative", serif;
    font-size: 5rem;
    color: #536564;
    position: absolute;
    top: 20px; left: 12px;
    line-height: 1;
    opacity: 0.3;
}

.post-content blockquote p {
    font-family: "Cormorant Garamond", serif !important;
    font-size: 1.3rem !important;
    font-style: italic !important;
    color: #714231 !important;
    margin: 0 !important;
    text-align: center !important;
}

/* Tags */
.post-tags {
    display: flex; align-items: center; justify-content: center;
    flex-wrap: wrap; gap: 12px;
    margin-bottom: 60px; position: relative; z-index: 1;
}

.tags-label {
    font-family: "DM Sans", sans-serif;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #a2785b;
}

.tag-list { display: flex; flex-wrap: wrap; gap: 10px; }
.tag-item {
    padding: 6px 16px;
    background: transparent;
    border: 1.5px solid #536564;
    color: #714231;
    font-family: "DM Sans", sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.tag-item:hover {
    background: #714231;
    border-color: #714231;
    color: white;
}

/* Divider */
.decorative-divider {
    text-align: center;
    margin: 60px 0;
    position: relative; z-index: 1;
}

.divider-ornament {
    font-size: 1.5rem;
    color: #a2785b;
    position: relative;
    display: inline-block;
    padding: 0 40px;
}

.divider-ornament::before,
.divider-ornament::after {
    content: '';
    position: absolute; top: 50%;
    width: 60px; height: 1px;
    background: linear-gradient(to right, transparent, #536564, transparent);
}

.divider-ornament::before { right: 100%; }
.divider-ornament::after { left: 100%; }

/* Share */
.post-share {
    text-align: center;
    padding: 48px 0 0;
    border-top: 2px solid #e8e4dc;
    position: relative; z-index: 1;
}

.post-share h4 {
    font-family: "Cinzel Decorative", serif;
    font-size: 1.3rem;
    color: #714231;
    margin-bottom: 32px;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 400;
}

.share-buttons {
    display: flex; justify-content: center;
    gap: 14px; flex-wrap: wrap;
}

.share-btn {
    width: 50px; height: 50px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: white;
    transition: all 0.3s ease;
    border: none; cursor: pointer;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.share-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

.share-btn.x-twitter { background: #000000; }
.share-btn.facebook { background: #4267B2; }
.share-btn.whatsapp { background: #25D366; }
.share-btn.telegram { background: #0088cc; }
.share-btn.threads { background: #000000; }
.share-btn.copy-link { background: #714231; }
.share-btn.copy-link:hover { background: #a2785b; }

/* Copy Notification */
.copy-notification {
    position: fixed; bottom: 30px; left: 50%;
    transform: translateX(-50%) translateY(100px);
    background: #714231; color: white;
    padding: 16px 32px; border-radius: 8px;
    font-family: "DM Sans", sans-serif;
    font-size: 0.9rem; font-weight: 600;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    opacity: 0; transition: all 0.4s ease;
    z-index: 9999;
    max-width: 90%;
    text-align: center;
}

.copy-notification.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* ============================================
   NIGHT MODE - ULTRA HIGH SPECIFICITY
============================================ */
body.night-mode .single-post-page {
    background-color: #0f0f0f !important;
}

body.night-mode .historical-paper {
    background-color: #1a1a1a !important;
    border-color: #333 !important;
    box-shadow: 
        0 2px 4px rgba(0,0,0,0.3),
        0 8px 16px rgba(0,0,0,0.4),
        0 16px 32px rgba(0,0,0,0.4) !important;
}

body.night-mode .historical-paper::before { opacity: 0.1 !important; }

body.night-mode .historical-paper::after {
    border-image: linear-gradient(to bottom, rgba(162,120,91,0.2), transparent 10%, transparent 90%, rgba(162,120,91,0.2)) 1 !important;
}

body.night-mode .post-title { color: #f5eee5 !important; }
body.night-mode .post-date { color: #a2785b !important; }
body.night-mode .post-content { color: #d4d4d4 !important; }
body.night-mode .post-content > p:first-of-type::first-letter { color: #a2785b !important; }
body.night-mode .post-content h2,
body.night-mode .post-content h3 { color: #f5eee5 !important; }

body.night-mode .post-content blockquote {
    background: #242424 !important;
    border-left-color: #a2785b !important;
    border-right-color: #a2785b !important;
}

body.night-mode .post-content blockquote p { color: #f5eee5 !important; }
body.night-mode .featured-img { border-color: #333 !important; }
body.night-mode .tag-item { border-color: #444; color: #f5eee5; }
body.night-mode .tag-item:hover { background: #a2785b !important; border-color: #a2785b !important; }
body.night-mode .post-share { border-top-color: #333 !important; }
body.night-mode .post-share h4,
body.night-mode .tags-label,
body.night-mode .divider-ornament { color: #a2785b !important; }

/* Responsive */
@media (max-width: 768px) {
    .historical-paper { padding: 60px 50px; margin: 0 20px; }
    .post-title { font-size: 2.2rem !important; }
    .share-buttons { gap: 12px; }
}

@media (max-width: 480px) {
    .historical-paper { padding: 40px 30px; margin: 0 15px; }
    .post-title { font-size: 1.8rem !important; }
    .share-btn { width: 46px; height: 46px; }
    .share-buttons { gap: 10px; }
}

/* Night mode headings override */
body.night-mode h1,
body.night-mode h2,
body.night-mode h3,
body.night-mode h4,
body.night-mode h5,
body.night-mode h6,
body.night-mode .section-title,
body.night-mode .entry-title,
body.night-mode .post-title {
      color: #a2785b
}

</style>

    <?php while (have_posts()) : the_post(); ?>

        <div class="historical-paper">
            
            <!-- Post Header -->
            <header class="post-header">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) : ?>
                    <div class="post-category">
                        <?php echo esc_html($categories[0]->name); ?>
                    </div>
                <?php endif; ?>

                <h1 class="post-title"><?php the_title(); ?></h1>
                
                <div class="post-date">
                    <time datetime="<?php the_time('Y-m-d'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('large', array('class' => 'featured-img')); ?>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <article class="post-content">
                <?php the_content(); ?>
            </article>

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) : ?>
                <div class="post-tags">
                    <span class="tags-label">Tags:</span>
                    <div class="tag-list">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-item">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Divider -->
            <div class="decorative-divider">
                <span class="divider-ornament">❖</span>
            </div>

            <!-- Share Section -->
            <div class="post-share">
                <h4>Share This Article</h4>
                <div class="share-buttons">
                    <!-- X (Twitter) -->
                    <a href="#" onclick="shareX(event)" class="share-btn x-twitter" title="Share on X" aria-label="Share on X">
                        <span style="font-size: 1.1rem; font-weight: 700;">𝕏</span>
                    </a>
                    
                    <!-- Facebook -->
                    <a href="#" onclick="shareFacebook(event)" class="share-btn facebook" title="Share on Facebook" aria-label="Share on Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    
                    <!-- WhatsApp -->
                    <a href="#" onclick="shareWhatsApp(event)" class="share-btn whatsapp" title="Share on WhatsApp" aria-label="Share on WhatsApp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    
                    <!-- Telegram -->
                    <a href="#" onclick="shareTelegram(event)" class="share-btn telegram" title="Share on Telegram" aria-label="Share on Telegram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    </a>
                    
                    <!-- Threads -->
                    <a href="#" onclick="shareThreads(event)" class="share-btn threads" title="Share on Threads" aria-label="Share on Threads">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.284 3.272-.886 1.102-2.14 1.704-3.73 1.79-1.202.065-2.361-.218-3.259-.801-1.063-.689-1.685-1.74-1.752-2.964-.065-1.19.408-2.285 1.33-3.082.88-.76 2.119-1.207 3.583-1.291a13.853 13.853 0 0 1 3.02.142l-.126.742a13.086 13.086 0 0 0-2.894-.136c-1.206.07-2.166.417-2.772.999-.613.59-.938 1.41-.913 2.308.02.687.373 1.286.99 1.691.6.392 1.385.57 2.206.5 1.06-.091 1.945-.479 2.572-1.121.297-.305.533-.67.707-1.091l.002.001c-.037-1.191-.168-2.042-.394-2.607-.234-.586-.595-1.064-1.072-1.421-1.44-1.077-3.633-1.09-4.878-.01-.426.37-.73.834-.902 1.376-.224.706-.103 1.44.335 2.02l-.761.549c-.564-.782-.699-1.74-.381-2.699.256-.768.733-1.434 1.38-1.925 1.664-1.443 4.516-1.424 6.35.052.663.534 1.175 1.215 1.521 2.024.299.697.494 1.643.58 2.817.056.772.052 1.496-.012 2.152a7.01 7.01 0 0 1-.38 1.595 5.167 5.167 0 0 1-.832 1.372 5.48 5.48 0 0 1-1.337 1.14c-1.829 1.064-3.98 1.409-6.398 1.025-2.168-.344-3.984-1.208-5.39-2.567C4.165 17.643 3.251 15.234 3.224 12c.027-3.233.941-5.643 2.718-7.162 1.407-1.359 3.222-2.223 5.39-2.567 2.419-.385 4.569-.04 6.398 1.025.486.282.945.621 1.337 1.14.317.42.596.887.832 1.372.27.556.467 1.163.58 1.817.064.37.105.755.123 1.152l-2.086-.004c-.02-.38-.058-.744-.114-1.089-.097-.606-.264-1.158-.498-1.645-.284-.592-.668-1.087-1.14-1.473-1.436-1.173-3.386-1.542-5.787-1.098-2.052.378-3.78 1.272-5.136 2.659C4.062 6.956 3.235 9.227 3.215 12c.02 2.773.847 5.044 2.46 6.753 1.357 1.387 3.084 2.281 5.136 2.66 2.4.444 4.35.074 5.787-1.1.472-.386.856-.881 1.14-1.473.234-.487.401-1.04.498-1.645.056-.346.094-.71.114-1.09l2.086.004c-.018.397-.06.782-.123 1.152-.113.654-.31 1.261-.58 1.817a6.63 6.63 0 0 1-.832 1.372 6.962 6.962 0 0 1-1.337 1.14c-1.829 1.064-3.98 1.409-6.398 1.025-2.168-.344-3.984-1.208-5.39-2.567-1.777-1.519-2.691-3.928-2.718-7.162z"/>
                        </svg>
                    </a>
                    
                    <!-- Copy Link -->
                    <a href="#" onclick="shareCopy(event)" class="share-btn copy-link" title="Copy share text" aria-label="Copy shareable text with link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Copy Notification -->
            <div id="copy-notification" class="copy-notification">
                Link copied to clipboard!
            </div>

        </div>

    <?php endwhile; ?>

    <!-- Comments -->
    <?php if (comments_open() || get_comments_number()) : ?>
        <?php comments_template(); ?>
    <?php endif; ?>

</main>

<script>
function shareX(e) {
    e.preventDefault();
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    const shareUrl = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + url;
    window.open(shareUrl, '_blank', 'noopener,noreferrer,width=600,height=400');
}

function shareFacebook(e) {
    e.preventDefault();
    const url = encodeURIComponent(window.location.href);
    const shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
    window.open(shareUrl, '_blank', 'noopener,noreferrer,width=600,height=400');
}

function shareWhatsApp(e) {
    e.preventDefault();
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    const shareUrl = 'https://wa.me/?text=' + text + '%20' + url;
    window.open(shareUrl, '_blank', 'noopener,noreferrer');
}

function shareTelegram(e) {
    e.preventDefault();
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    const shareUrl = 'https://t.me/share/url?url=' + url + '&text=' + text;
    window.open(shareUrl, '_blank', 'noopener,noreferrer,width=600,height=400');
}

function shareThreads(e) {
    e.preventDefault();
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    const shareUrl = 'https://threads.net/intent/post?text=' + text + '%20' + url;
    window.open(shareUrl, '_blank', 'noopener,noreferrer,width=600,height=400');
}

function shareCopy(e) {
    e.preventDefault();
    const url = window.location.href;
    const title = document.title;
    const shareText = title + '\n\n' + url;

    navigator.clipboard.writeText(shareText).then(() => {
        const notification = document.getElementById('copy-notification');
        if (!notification) return;
        
        notification.textContent = '✓ Share text copied! Paste it anywhere.';
        notification.classList.add('show');
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.textContent = 'Link copied to clipboard!';
            }, 400);
        }, 3000);
    }).catch(err => {
        console.error('Could not copy text: ', err);
        const notification = document.getElementById('copy-notification');
        if (notification) {
            notification.textContent = '✗ Could not copy. Please try again.';
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 2000);
        }
    });
}
</script>

<?php get_footer(); ?>
