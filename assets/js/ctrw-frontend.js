        
        
    jQuery(document).ready(function($) {
        $('#ctrw-reviewForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            // Add security nonce
            formData += '&security=' + ctrw_review_form_ajax.nonce;
            // Add action
            formData += '&action=ctrw_submit_review';
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Submiting...');

            // AJAX request
            $.ajax({
            type: 'POST',
            url: ctrw_review_form_ajax.ajax_url,
            data: formData,
            dataType: 'json',
            success: function(data) {
                alert('Thank you for your review!');
                $('#ctrw-reviewForm')[0].reset();
            }
            });
        });
    });


        
        
        
        // Rating stars interaction
        const ctrwStars = document.querySelectorAll('.ctrw-star');
        const ctrwRatingInput = document.getElementById('ctrw-rating');
        
        ctrwStars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-rating');
                ctrwRatingInput.value = rating;
                
                ctrwStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            star.addEventListener('mouseover', () => {
                const rating = star.getAttribute('data-rating');
                
                ctrwStars.forEach((s, index) => {
                    if (index < rating) {
                        s.style.color = '#f8961e';
                    }
                });
            });
            
            star.addEventListener('mouseout', () => {
                const currentRating = ctrwRatingInput.value;
                
                ctrwStars.forEach((s, index) => {
                    if (index >= currentRating) {
                        s.style.color = '#e9ecef';
                    }
                });
            });
        });

        // Review Slider Functionality
        const ctrwSlider = document.getElementById('ctrw-reviewSlider');
        const ctrwDots = document.querySelectorAll('.ctrw-slider-dot');
        let ctrwCurrentSlide = 0;

        // Update slider dots
        function ctrwUpdateDots() {
            ctrwDots.forEach((dot, index) => {
                if (index === ctrwCurrentSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Scroll to slide
        function ctrwGoToSlide(index) {
            const slideWidth = document.querySelector('.ctrw-review-slide').offsetWidth;
            ctrwSlider.scrollTo({
                left: index * (slideWidth + 20), // 20px gap
                behavior: 'smooth'
            });
            ctrwCurrentSlide = index;
            ctrwUpdateDots();
        }

        // Dot click events
        ctrwDots.forEach(dot => {
            dot.addEventListener('click', () => {
                const slideIndex = parseInt(dot.getAttribute('data-slide'));
                ctrwGoToSlide(slideIndex);
            });
        });

        // Auto-scroll slider
        let ctrwAutoScroll = setInterval(() => {
            ctrwCurrentSlide = (ctrwCurrentSlide + 1) % ctrwDots.length;
            ctrwGoToSlide(ctrwCurrentSlide);
        }, 5000);

        // Pause auto-scroll on hover
        ctrwSlider.addEventListener('mouseenter', () => {
            clearInterval(ctrwAutoScroll);
        });

        ctrwSlider.addEventListener('mouseleave', () => {
            ctrwAutoScroll = setInterval(() => {
                ctrwCurrentSlide = (ctrwCurrentSlide + 1) % ctrwDots.length;
                ctrwGoToSlide(ctrwCurrentSlide);
            }, 5000);
        });

        // Floating Reviews Toggle
        const ctrwFloatingBtn = document.getElementById('ctrw-floatingBtn');
        const ctrwFloatingReviews = document.getElementById('ctrw-floatingReviews');
        const ctrwCloseFloating = document.getElementById('ctrw-closeFloating');

        ctrwFloatingBtn.addEventListener('click', () => {
            ctrwFloatingReviews.classList.toggle('show');
        });

        ctrwCloseFloating.addEventListener('click', () => {
            ctrwFloatingReviews.classList.remove('show');
        });

        // Close floating reviews when clicking outside
        document.addEventListener('click', (e) => {
            if (!ctrwFloatingReviews.contains(e.target) && e.target !== ctrwFloatingBtn) {
                ctrwFloatingReviews.classList.remove('show');
            }
        });

        // View Toggle Functionality
        const ctrwViewOptions = document.querySelectorAll('.ctrw-view-option');
        const ctrwReviewLists = {
            standard: document.querySelector('.ctrw-review-list.standard'),
            slider: document.querySelector('.ctrw-review-list.slider'),
            floating: document.querySelector('.ctrw-review-list.floating')
        };

        ctrwViewOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Update active state
                ctrwViewOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                
                // Get selected view
                const view = option.getAttribute('data-view');
                
                // Hide all review lists
                Object.values(ctrwReviewLists).forEach(list => {
                    if (list) list.style.display = 'none';
                });
                
                // Show selected view
                if (ctrwReviewLists[view]) {
                    ctrwReviewLists[view].style.display = 'block';
                    
                    // Special handling for slider view
                    if (view === 'slider') {
                        // Reset slider position
                        ctrwGoToSlide(0);
                    }
                }
                
                // Special handling for floating view
                if (view === 'floating') {
                    ctrwFloatingBtn.click(); // Open the floating panel
                }
            });
        });

        // Initialize with standard view
        ctrwReviewLists.slider.style.display = 'none';
        ctrwReviewLists.floating.style.display = 'none';
        // AJAX form submission for review form


