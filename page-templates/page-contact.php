<?php
/**
 * Template Name: Contact Page
 * 
 * @package Author_Theme
 */

get_header();
?>

<div class="contact-page">
    
    <!-- Page Header -->
    <section class="page-header section">
        <div class="container text-center">
            <h1 class="page-title">Get In Touch</h1>
            <p class="page-description">
                I'd love to hear from you! Whether you have questions, feedback, or just want to say hello.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section section">
        <div class="container">
            <div class="contact-wrapper">
                
                <!-- Contact Form -->
                <div class="contact-form-container">
                    <h2>Send Me a Message</h2>
                    
                    <form id="contact-form" class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <input type="hidden" name="action" value="author_contact_form">
                        <?php wp_nonce_field('author_contact_nonce', 'contact_nonce'); ?>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact_name">Your Name *</label>
                                <input type="text" id="contact_name" name="contact_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_email">Your Email *</label>
                                <input type="email" id="contact_email" name="contact_email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_subject">Subject *</label>
                            <input type="text" id="contact_subject" name="contact_subject" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_message">Your Message *</label>
                            <textarea id="contact_message" name="contact_message" rows="6" required></textarea>
                        </div>

                        <div id="form-message" class="form-message"></div>

                        <button type="submit" class="btn btn-primary submit-btn">
                            <span class="btn-text">Send Message</span>
                            <span class="btn-loading" style="display: none;">Sending...</span>
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info-container">
                    <h2>Connect With Me</h2>
                    
                    <div class="contact-info-items">
                        
                        <!-- Email -->
                        <div class="contact-info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <h4>Email</h4>
                                <a href="mailto:hello@yourdomain.com">hello@yourdomain.com</a>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="contact-info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <h4>Follow Me</h4>
                                <div class="social-links-inline">
                                    <a href="#" target="_blank">Facebook</a>
                                    <a href="#" target="_blank">Instagram</a>
                                    <a href="#" target="_blank">TikTok</a>
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="contact-info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <h4>Newsletter</h4>
                                <a href="#newsletter" class="info-link">Subscribe Now →</a>
                            </div>
                        </div>

                    </div>

                    <!-- Quote -->
                    <div class="contact-quote">
                        <blockquote>
                            <p>"Every message from a reader is a gift. Thank you for taking the time to reach out."</p>
                            <footer>— The Author</footer>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script>
// Contact Form Handling
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const messageDiv = document.getElementById('form-message');
    const submitBtn = form.querySelector('.submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading state
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';

            // Show message
            messageDiv.textContent = data.message;
            messageDiv.className = 'form-message ' + (data.success ? 'success' : 'error');
            messageDiv.style.display = 'block';

            // Clear form if successful
            if (data.success) {
                form.reset();
                
                // Hide message after 5 seconds
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000);
            }
        })
        .catch(error => {
            // Hide loading state
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';

            // Show error
            messageDiv.textContent = 'An error occurred. Please try again.';
            messageDiv.className = 'form-message error';
            messageDiv.style.display = 'block';
        });
    });
});
</script>

<style>
.contact-page {
  background: transparent;
  color: var(--text-color, #f5eee5);
}

/* Header text */
.page-title,
.page-description {
  color: var(--text-color, #f5eee5);
}

/* Layout */
.contact-wrapper {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(0, 1.1fr);
  gap: 3rem;
}

/* Cards */
.contact-form-container,
.contact-info-container {
  background: color-mix(in srgb, var(--bg-color, #050508) 85%, #ffffff 15%);
  padding: 2.5rem;
  border-radius: 18px;
  border: 1px solid color-mix(in srgb, var(--text-color, #f5eee5) 14%, transparent);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.55);
}

.contact-form-container h2,
.contact-info-container h2 {
  margin-bottom: 1.5rem;
  color: var(--text-color, #f5eee5);
}

/* Form */
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.form-group {
  margin-bottom: 1.4rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-family: var(--font-sans);
  font-weight: 600;
  color: var(--text-color, #f5eee5);
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 0.75rem 1rem;
  border-radius: 10px;
  border: 1px solid color-mix(in srgb, var(--text-color, #f5eee5) 18%, transparent);
  background: color-mix(in srgb, var(--bg-color, #050508) 90%, #ffffff 10%);
  color: var(--text-color, #f5eee5);
  font-family: var(--font-body);
  font-size: 1rem;
  transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
  box-sizing: border-box;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
  color: color-mix(in srgb, var(--text-color, #f5eee5) 55%, transparent);
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--accent-color, #714231);
  box-shadow: 0 0 0 1px var(--accent-color, #714231);
}

/* Messages */
.form-message {
  padding: 1rem;
  border-radius: 10px;
  margin-bottom: 1.5rem;
  display: none;
  font-size: 0.9rem;
}

.form-message.success {
  background-color: color-mix(in srgb, #1f3d2b 70%, transparent);
  color: #c6f6d5;
  border: 1px solid #38a169;
}

.form-message.error {
  background-color: color-mix(in srgb, #4b2323 70%, transparent);
  color: #fed7d7;
  border: 1px solid #f56565;
}

/* Submit */
.submit-btn {
  width: 100%;
  padding: 1rem 2rem;
  font-size: 0.95rem;
  border-radius: 999px;
}

/* Contact info */
.contact-info-items {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.contact-info-item {
  display: flex;
  gap: 1.3rem;
  align-items: flex-start;
}

.info-icon {
  width: 50px;
  height: 50px;
  background-color: var(--accent-color, #714231);
  color: var(--accent-text, #f5eee5);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.info-content h4 {
  font-size: 1.05rem;
  margin-bottom: 0.4rem;
  color: var(--text-color, #f5eee5);
}

.info-content a {
  color: color-mix(in srgb, var(--text-color, #f5eee5) 80%, transparent);
}

/* Quote */
.contact-quote {
  margin-top: 2.5rem;
  padding: 1.6rem 1.8rem;
  background-color: color-mix(in srgb, var(--bg-color, #050508) 85%, #ffffff 15%);
  border-left: 4px solid var(--accent-color, #714231);
  border-radius: 12px;
}

.contact-quote p {
  font-family: var(--font-elegant);
  font-size: 1.05rem;
  font-style: italic;
  color: var(--text-color, #f5eee5);
}

.contact-quote footer {
  margin-top: 0.8rem;
  font-family: var(--font-sans);
  font-size: 0.9rem;
  opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
  .contact-wrapper {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .contact-form-container,
  .contact-info-container {
    padding: 2rem;
  }
}

</style>

<?php
get_footer();