  
  <?php
  // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'post_id' => get_the_ID(),
        'title' => 'Leave a Review',
    ), $atts);
    
    ob_start();
    ?>
    <div class="wp-ctrw-container wp-ctrw-form">
        <h3 class="wp-ctrw-title"><?php echo esc_html($atts['title']); ?></h3>
        
        <?php if (isset($_GET['review-submitted'])) : ?>
            <div class="wp-ctrw-form-success">
                Thank you for your review! It has been submitted for approval.
            </div>
        <?php endif; ?>
        
        <form id="wp-ctrw-review-form" method="post">
            <input type="hidden" name="wp_ctrw_post_id" value="<?php echo esc_attr($atts['post_id']); ?>">
            
            <div class="wp-ctrw-form-group">
                <label class="wp-ctrw-form-label" for="wp_ctrw_rating">Your Rating</label>
                <select class="wp-ctrw-form-select" name="wp_ctrw_rating" id="wp_ctrw_rating" required>
                    <option value="">Select a rating</option>
                    <option value="5">5 Stars - Excellent</option>
                    <option value="4">4 Stars - Very Good</option>
                    <option value="3">3 Stars - Average</option>
                    <option value="2">2 Stars - Poor</option>
                    <option value="1">1 Star - Terrible</option>
                </select>
            </div>
            
            <div class="wp-ctrw-form-group">
                <label class="wp-ctrw-form-label" for="wp_ctrw_title">Review Title</label>
                <input class="wp-ctrw-form-input" type="text" name="wp_ctrw_title" id="wp_ctrw_title" required>
            </div>
            
            <div class="wp-ctrw-form-group">
                <label class="wp-ctrw-form-label" for="wp_ctrw_name">Your Name</label>
                <input class="wp-ctrw-form-input" type="text" name="wp_ctrw_name" id="wp_ctrw_name" required>
            </div>
            
            <div class="wp-ctrw-form-group">
                <label class="wp-ctrw-form-label" for="wp_ctrw_email">Your Email (optional)</label>
                <input class="wp-ctrw-form-input" type="email" name="wp_ctrw_email" id="wp_ctrw_email">
            </div>
            
            <div class="wp-ctrw-form-group">
                <label class="wp-ctrw-form-label" for="wp_ctrw_content">Your Review</label>
                <textarea class="wp-ctrw-form-textarea" name="wp_ctrw_content" id="wp_ctrw_content" required></textarea>
            </div>
            
            <div class="wp-ctrw-form-group wp-ctrw-form-submit">
                <button type="submit" class="wp-ctrw-button">Submit Review</button>
            </div>
        </form>
    </div>