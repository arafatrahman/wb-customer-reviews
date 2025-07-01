
    <div class="ctrw-container">
       

        <!-- Review Form -->
        <div class="ctrw-review-form-container">
            <h3 class="ctrw-form-title">Write a Review</h3>
            <form id="ctrw-reviewForm" method="post">
                <div class="ctrw-form-group">
                    <label for="ctrw-name" class="ctrw-form-label">Your Name</label>
                    <input type="text" id="ctrw-name" name="ctrw_name" class="ctrw-form-control" >
                </div>
                
                <div class="ctrw-form-group">
                    <label for="ctrw-email" class="ctrw-form-label">Email Address</label>
                    <input type="email" id="ctrw-email" name="ctrw_email" class="ctrw-form-control" >
                </div>

                <div class="ctrw-form-group">
                    <label for="ctrw-phone" class="ctrw-form-label">Phone Number</label>
                    <input type="tel" id="ctrw-phone" name="ctrw_phone" class="ctrw-form-control" pattern="[0-9+\-\s()]{7,20}" maxlength="20">
                </div>

                <div class="ctrw-form-group">
                    <label for="ctrw-website" class="ctrw-form-label">Website</label>
                    <input type="url" id="ctrw-website" name="ctrw_website" class="ctrw-form-control" placeholder="https://example.com">
                </div>
                <div class="ctrw-form-group">
                    <label for="ctrw-city" class="ctrw-form-label">City</label>
                    <input type="text" id="ctrw-city" name="ctrw_city" class="ctrw-form-control">
                </div>

                <div class="ctrw-form-group">
                    <label for="ctrw-state" class="ctrw-form-label">State</label>
                    <input type="text" id="ctrw-state" name="ctrw_state" class="ctrw-form-control">
                </div>

                <div class="ctrw-form-group">
                    <label for="ctrw-title" class="ctrw-form-label">Review Title</label>
                    <input type="text" id="ctrw-title" name="ctrw_title" class="ctrw-form-control" >
                </div>
                
                <div class="ctrw-form-group">
                    <label for="ctrw-review" class="ctrw-form-label">Comment</label>
                    <textarea id="ctrw-review" name="ctrw_review" class="ctrw-form-control" ></textarea>
                </div>
                
                <div class="ctrw-form-group">
                    <label class="ctrw-form-label">Your Rating</label>
                    <div class="ctrw-rating-input">
                        <i class="fas fa-star ctrw-star" data-rating="1"></i>
                        <i class="fas fa-star ctrw-star" data-rating="2"></i>
                        <i class="fas fa-star ctrw-star" data-rating="3"></i>
                        <i class="fas fa-star ctrw-star" data-rating="4"></i>
                        <i class="fas fa-star ctrw-star" data-rating="5"></i>
                        <input type="hidden" id="ctrw-rating" name="ctrw_rating" value="0">
                    </div>
                </div>
                

                <?php
                // Get current post/product/page ID depending on context
                global $post;
                $current_id = 0;

                // WooCommerce product
                if (function_exists('is_product') && is_product()) {
                    $current_id = get_the_ID();
                }
                // Regular post/page
                elseif (isset($post) && isset($post->ID)) {
                    $current_id = $post->ID;
                }
                // Hidden fields
                ?>
                <input type="hidden" name="ctrw_page_id" value="<?php echo esc_attr($current_id); ?>">
               
                <button type="submit" class="ctrw-submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Review
                </button>
            </form>
        </div>
    </div>




