// Rating stars interaction
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-rating');
                ratingInput.value = rating;
                
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            star.addEventListener('mouseover', () => {
                const rating = star.getAttribute('data-rating');
                
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.style.color = '#f8961e';
                    }
                });
            });
            
            star.addEventListener('mouseout', () => {
                const currentRating = ratingInput.value;
                
                stars.forEach((s, index) => {
                    if (index >= currentRating) {
                        s.style.color = '#e9ecef';
                    }
                });
            });
        });
        
        // Form submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (ratingInput.value === '0') {
                alert('Please select a rating');
                return;
            }
            
            // Here you would typically send the data to a server
            alert('Thank you for your review!');
            this.reset();
            
            // Reset stars
            stars.forEach(star => {
                star.classList.remove('active');
                star.style.color = '#e9ecef';
            });
            ratingInput.value = '0';
        });

        // Review Slider Functionality
        const slider = document.getElementById('reviewSlider');
        const dots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0;

        // Update slider dots
        function updateDots() {
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Scroll to slide
        function goToSlide(index) {
            const slideWidth = document.querySelector('.review-slide').offsetWidth;
            slider.scrollTo({
                left: index * (slideWidth + 20), // 20px gap
                behavior: 'smooth'
            });
            currentSlide = index;
            updateDots();
        }

        // Dot click events
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const slideIndex = parseInt(dot.getAttribute('data-slide'));
                goToSlide(slideIndex);
            });
        });

        // Auto-scroll slider
        let autoScroll = setInterval(() => {
            currentSlide = (currentSlide + 1) % dots.length;
            goToSlide(currentSlide);
        }, 5000);

        // Pause auto-scroll on hover
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoScroll);
        });

        slider.addEventListener('mouseleave', () => {
            autoScroll = setInterval(() => {
                currentSlide = (currentSlide + 1) % dots.length;
                goToSlide(currentSlide);
            }, 5000);
        });

        // Floating Reviews Toggle
        const floatingBtn = document.getElementById('floatingBtn');
        const floatingReviews = document.getElementById('floatingReviews');
        const closeFloating = document.getElementById('closeFloating');

        floatingBtn.addEventListener('click', () => {
            floatingReviews.classList.toggle('show');
        });

        closeFloating.addEventListener('click', () => {
            floatingReviews.classList.remove('show');
        });

        // Close floating reviews when clicking outside
        document.addEventListener('click', (e) => {
            if (!floatingReviews.contains(e.target) && e.target !== floatingBtn) {
                floatingReviews.classList.remove('show');
            }
        });

        // View Toggle Functionality
        const viewOptions = document.querySelectorAll('.view-option');
        const reviewLists = {
            standard: document.querySelector('.review-list.standard'),
            slider: document.querySelector('.review-list.slider'),
            floating: document.querySelector('.review-list.floating')
        };

        viewOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Update active state
                viewOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                
                // Get selected view
                const view = option.getAttribute('data-view');
                
                // Hide all review lists
                Object.values(reviewLists).forEach(list => {
                    if (list) list.style.display = 'none';
                });
                
                // Show selected view
                if (reviewLists[view]) {
                    reviewLists[view].style.display = 'block';
                    
                    // Special handling for slider view
                    if (view === 'slider') {
                        // Reset slider position
                        goToSlide(0);
                    }
                }
                
                // Special handling for floating view
                if (view === 'floating') {
                    floatingBtn.click(); // Open the floating panel
                }
            });
        });

        // Initialize with standard view
        reviewLists.slider.style.display = 'none';
        reviewLists.floating.style.display = 'none';