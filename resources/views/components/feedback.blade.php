<div id="feedback-popup" class="feedback-overlay" style="display: none;">
    <div class="feedback-modal">
        <div class="feedback-header">
            <h3>We'd Love Your Feedback!</h3>
            <button class="feedback-close-btn" onclick="closeFeedbackPopup()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="feedback-form" class="feedback-form">
            @csrf
            <div class="feedback-rating-section">
                <label class="feedback-label">Rate your experience:</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" class="star-input">
                    <label for="star5" class="star-label">
                        <i class="fas fa-star"></i>
                    </label>
                    <input type="radio" id="star4" name="rating" value="4" class="star-input">
                    <label for="star4" class="star-label">
                        <i class="fas fa-star"></i>
                    </label>
                    <input type="radio" id="star3" name="rating" value="3" class="star-input">
                    <label for="star3" class="star-label">
                        <i class="fas fa-star"></i>
                    </label>
                    <input type="radio" id="star2" name="rating" value="2" class="star-input">
                    <label for="star2" class="star-label">
                        <i class="fas fa-star"></i>
                    </label>
                    <input type="radio" id="star1" name="rating" value="1" class="star-input">
                    <label for="star1" class="star-label">
                        <i class="fas fa-star"></i>
                    </label>
                </div>
                <div class="rating-text">
                    <span id="rating-text">Select your rating</span>
                </div>
            </div>

            <div class="feedback-message-section">
                <label class="feedback-label" for="feedback-message">Tell us more (optional):</label>
                <textarea id="feedback-message" name="message" class="feedback-textarea"
                    placeholder="Share your thoughts, suggestions, or any feedback you'd like to give us..." rows="4"></textarea>
            </div>

            <div class="feedback-actions">
                <button type="button" class="feedback-skip-btn" onclick="closeFeedbackPopup()">
                    Skip
                </button>
                <button type="submit" class="feedback-submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Feedback
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .feedback-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-in-out;
    }

    .feedback-modal {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease-out;
    }

    /* Dark Mode Styles */
    .dark-mode .feedback-modal {
        background: #2d2d2d;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid #404040;
    }

    .feedback-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 24px 0 24px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .dark-mode .feedback-header {
        border-bottom: 1px solid #404040;
    }

    .feedback-header h3 {
        margin: 0;
        color: #1f2937;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .dark-mode .feedback-header h3 {
        color: #e5e7eb;
    }

    .feedback-close-btn {
        background: none;
        border: none;
        font-size: 1.25rem;
        color: #6b7280;
        cursor: pointer;
        padding: 8px;
        height: 40px;
        width: 40px;
        margin-bottom: 10px;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .dark-mode .feedback-close-btn {
        color: #9ca3af;
    }

    .feedback-close-btn:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .dark-mode .feedback-close-btn:hover {
        background: #404040;
        color: #e5e7eb;
    }

    .feedback-form {
        padding: 0 24px 24px 24px;
    }

    .feedback-rating-section {
        margin-bottom: 24px;
    }

    .feedback-label {
        display: block;
        margin-bottom: 12px;
        color: #374151;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .dark-mode .feedback-label {
        color: #d1d5db;
    }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        gap: 4px;
        margin-bottom: 12px;
    }

    .star-input {
        display: none;
    }

    .star-label {
        cursor: pointer;
        font-size: 2rem;
        color: #d1d5db;
        transition: all 0.2s ease;
        padding: 4px;
    }

    .dark-mode .star-label {
        color: #4b5563;
    }

    .star-label:hover,
    .star-label:hover~.star-label,
    .star-input:checked~.star-label {
        color: #fbbf24;
        transform: scale(1.1);
    }

    .rating-text {
        text-align: center;
        color: #6b7280;
        font-size: 0.9rem;
        min-height: 20px;
    }

    .dark-mode .rating-text {
        color: #9ca3af;
    }

    .feedback-message-section {
        margin-bottom: 24px;
    }

    .feedback-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: inherit;
        resize: vertical;
        transition: all 0.2s ease;
        box-sizing: border-box;
        background: white;
        color: #374151;
    }

    .dark-mode .feedback-textarea {
        background: #1f1f1f;
        border-color: #404040;
        color: #e5e7eb;
    }

    .feedback-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .dark-mode .feedback-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }

    .feedback-textarea::placeholder {
        color: #9ca3af;
    }

    .dark-mode .feedback-textarea::placeholder {
        color: #6b7280;
    }

    .feedback-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .feedback-skip-btn {
        padding: 10px 20px;
        border: 1px solid #d1d5db;
        background: white;
        color: #6b7280;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .dark-mode .feedback-skip-btn {
        background: #1f1f1f;
        border-color: #404040;
        color: #9ca3af;
    }

    .feedback-skip-btn:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }

    .dark-mode .feedback-skip-btn:hover {
        background: #3a3a3a;
        border-color: #6b7280;
        color: #e5e7eb;
    }

    .feedback-submit-btn {
        padding: 10px 20px;
        background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .dark-mode .feedback-submit-btn {
        background: linear-gradient(135deg, #60a5fa 0%, #8b5cf6 100%);
    }

    .feedback-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .dark-mode .feedback-submit-btn:hover {
        box-shadow: 0 4px 12px rgba(96, 165, 250, 0.3);
    }

    .feedback-submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 640px) {
        .feedback-modal {
            width: 95%;
            margin: 20px;
        }

        .feedback-header {
            padding: 20px 20px 0 20px;
        }

        .feedback-form {
            padding: 0 20px 20px 20px;
        }

        .star-label {
            font-size: 1.75rem;
        }

        .feedback-actions {
            flex-direction: column;
        }
    }

    @media (max-width: 300px) {
        .feedback-submit-btn {
            font-size: 13px;
        }

        .feedback-skip-btn {
            font-size: 13px;
        }
    }
</style>

<script>
    // Debug logging
    console.log('Feedback component loaded');

    // Make functions globally available
    window.showFeedbackPopup = function() {
        console.log('showFeedbackPopup called');
        const popup = document.getElementById('feedback-popup');
        if (popup) {
            console.log('Feedback popup element found, showing...');
            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        } else {
            console.error('Feedback popup element not found');
        }
    };

    window.closeFeedbackPopup = function() {
        console.log('closeFeedbackPopup called');
        const popup = document.getElementById('feedback-popup');
        if (popup) {
            popup.style.display = 'none';
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('feedback-form').reset();
            document.getElementById('rating-text').textContent = 'Select your rating';
        }
    };

    // Star rating functionality
    document.addEventListener('DOMContentLoaded', function() {
        const starInputs = document.querySelectorAll('.star-input');
        const ratingText = document.getElementById('rating-text');

        const ratingMessages = {
            1: 'Poor - We need to improve',
            2: 'Fair - Room for improvement',
            3: 'Good - Satisfactory experience',
            4: 'Very Good - Great experience',
            5: 'Excellent - Outstanding experience'
        };

        starInputs.forEach(input => {
            input.addEventListener('change', function() {
                const rating = this.value;
                ratingText.textContent = ratingMessages[rating];
            });
        });

        // Handle form submission
        const feedbackForm = document.getElementById('feedback-form');
        if (feedbackForm) {
            feedbackForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('.feedback-submit-btn');
                const originalText = submitBtn.innerHTML;

                // Disable button and show loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                // Send feedback to server
                fetch('/submit-feedback', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank You!',
                                text: 'Your feedback has been submitted successfully.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            closeFeedbackPopup();
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Failed to submit feedback. Please try again.',
                        });
                    })
                    .finally(() => {
                        // Re-enable button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    });
            });
        }
    });

    // Close popup when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('feedback-popup');
        if (overlay) {
            // overlay.addEventListener('click', function(e) {
            //     if (e.target === this) {
            //         closeFeedbackPopup();
            //     }
            // });
        }
    });
</script>
