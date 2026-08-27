/**
 * Mood Selection and Quote Display - Final Version
 * 100% CSS-driven styling, JS only toggles classes
 */

document.addEventListener('DOMContentLoaded', () => {
    const moodDataElement = document.getElementById('mood-quotes-data');
    const moodSection = document.getElementById('mood-section');
    const quoteContainer = document.querySelector('.mood-quote');
    const quoteText = document.querySelector('.quote-text');
    const quoteSource = document.querySelector('.quote-source');

    if (!moodDataElement || !moodSection) return;

    let moodQuotes = {};
    try {
        moodQuotes = JSON.parse(moodDataElement.textContent);
    } catch (e) {
        console.error('Failed to parse mood quotes:', e);
        return;
    }

    const MOOD_CLASSES = ['mood-dark', 'mood-romantic', 'mood-mysterious', 'mood-hopeful'];
    const STORAGE_KEY = 'selectedMood';

    // Storage helper
    const storage = {
        get: () => {
            try {
                return localStorage.getItem(STORAGE_KEY) || 
                       document.cookie.match(new RegExp(`(^| )${STORAGE_KEY}=([^;]+)`))?.[2];
            } catch {
                return null;
            }
        },
        set: (value) => {
            try {
                localStorage.setItem(STORAGE_KEY, value);
            } catch {
                document.cookie = `${STORAGE_KEY}=${value};path=/;max-age=31536000`;
            }
        }
    };

    // Get random quote
    const getRandomQuote = (mood) => {
        const quotes = moodQuotes[mood];
        return quotes?.[Math.floor(Math.random() * quotes.length)] || null;
    };

    // Display quote (JS only updates content, CSS handles animation)
    const displayQuote = (quote, mood) => {
        if (!quote || !quoteContainer) return;

        // Fade out
        quoteContainer.classList.remove('show');

        setTimeout(() => {
            // Update content only (no inline styles!)
            if (quoteText) quoteText.textContent = `"${quote.text}"`;
            if (quoteSource) quoteSource.textContent = `— ${quote.source}`;

            // Update body classes (only toggle classes, no inline styles)
            const hasNightMode = document.body.classList.contains('night-mode');
            document.body.classList.remove(...MOOD_CLASSES);
            document.body.classList.add(`mood-${mood}`);
            if (hasNightMode) {
                document.body.classList.add('night-mode');
            }

            // Fade in
            setTimeout(() => quoteContainer.classList.add('show'), 50);
        }, 300);
    };

    // Handle button click
    const handleMoodClick = (event) => {
        const button = event.currentTarget;
        const mood = button.dataset.mood;

        if (!mood) return;

        // Update active states (CSS handles visual changes)
        document.querySelectorAll('.mood-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        // Display quote
        const quote = getRandomQuote(mood);
        if (quote) {
            displayQuote(quote, mood);
        }

        // Save preference
        storage.set(mood);
    };

    // Initialize
    document.querySelectorAll('.mood-btn').forEach(button => {
        button.addEventListener('click', handleMoodClick);
    });

    // Load saved mood
    const savedMood = storage.get();
    const savedButton = savedMood && document.querySelector(`[data-mood="${savedMood}"]`);
    if (savedButton) {
        setTimeout(() => savedButton.click(), 500);
    }

    // Intersection observer for animation
    const observer = new IntersectionObserver(
        (entries) => entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        }),
        { threshold: 0.3 }
    );

    if (moodSection) {
        moodSection.classList.add('fade-in-up');
        observer.observe(moodSection);
    }
});
