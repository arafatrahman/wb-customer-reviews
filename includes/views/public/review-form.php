<?php
global $post;
$current_id = isset($post->ID) ? $post->ID : 0;

// Get post-specific review setting
$post_reviews_enabled = get_post_meta($current_id, '_ctrw_enable_reviews', true);
// Get general review setting
$generalSettings = get_option('ctrw_general_settings');
// Get form field settings
$formSettings = get_option('ctrw_form_fields_settings');

// Check if reviews are enabled
if ($post_reviews_enabled !== "1" || $generalSettings['enable_review_form'] !== 'on') {
    return;
}

// Unserialize the form settings if needed
if (is_string($formSettings)) {
    $formSettings = unserialize($formSettings);
}

// Field names and visibility from settings
$field_names = isset($formSettings['field_names']) ? $formSettings['field_names'] : array();
$field_visible = isset($formSettings['field_visible']) ? $formSettings['field_visible'] : array();

// Create a mapping between field names and form fields
$field_mapping = array(
    'Name' => array('id' => 'ctrw-name', 'name' => 'ctrw_name', 'type' => 'text'),
    'Email' => array('id' => 'ctrw-email', 'name' => 'ctrw_email', 'type' => 'email'),
    'Phone' => array('id' => 'ctrw-phone', 'name' => 'ctrw_phone', 'type' => 'tel'),
    'Website' => array('id' => 'ctrw-website', 'name' => 'ctrw_website', 'type' => 'url'),
    'City' => array('id' => 'ctrw-city', 'name' => 'ctrw_city', 'type' => 'text'),
    'State' => array('id' => 'ctrw-state', 'name' => 'ctrw_state', 'type' => 'text'),
    'Review Title' => array('id' => 'ctrw-title', 'name' => 'ctrw_title', 'type' => 'text'),
    'Comment' => array('id' => 'ctrw-review', 'name' => 'ctrw_review', 'type' => 'textarea'),
    'Rating' => array('id' => 'ctrw-rating', 'name' => 'ctrw_rating', 'type' => 'rating')
);
?>

<div class="ctrw-container">
    <!-- Review Form -->
    <div class="ctrw-review-form-container">
        <h3 class="ctrw-form-title">Write a Review</h3>
        <form id="ctrw-reviewForm" method="post">
            <?php
            // Loop through all possible fields and display only those that are enabled
            foreach ($field_names as $index => $field_name) {
                if (isset($field_visible[$index]) && $field_visible[$index] === 'on' && isset($field_mapping[$field_name])) {
                    $field = $field_mapping[$field_name];
                    
                    if ($field['type'] === 'textarea') {
                        ?>
                        <div class="ctrw-form-group">
                            <label for="<?php echo esc_attr($field['id']); ?>" class="ctrw-form-label"><?php echo esc_html($field_name); ?></label>
                            <textarea id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="ctrw-form-control"></textarea>
                        </div>
                        <?php
                    } elseif ($field['type'] === 'rating') {
                        ?>
                        <div class="ctrw-form-group">
                            <label class="ctrw-form-label"><?php echo esc_html($field_name); ?></label>
                            <div class="ctrw-rating-input">
                                <i class="fas fa-star ctrw-star" data-rating="1"></i>
                                <i class="fas fa-star ctrw-star" data-rating="2"></i>
                                <i class="fas fa-star ctrw-star" data-rating="3"></i>
                                <i class="fas fa-star ctrw-star" data-rating="4"></i>
                                <i class="fas fa-star ctrw-star" data-rating="5"></i>
                                <input type="hidden" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" value="0">
                            </div>
                        </div>
                        <?php
                    } else {
                        $placeholder = ($field['type'] === 'url') ? ' placeholder="https://example.com"' : '';
                        $maxlength = ($field['type'] === 'tel') ? ' maxlength="20"' : '';
                        ?>
                        <div class="ctrw-form-group">
                            <label for="<?php echo esc_attr($field['id']); ?>" class="ctrw-form-label"><?php echo esc_html($field_name); ?></label>
                            <input type="<?php echo esc_attr($field['type']); ?>" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="ctrw-form-control"<?php echo $placeholder . $maxlength; ?>>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            
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
            ?>
            <input type="hidden" name="ctrw_page_id" value="<?php echo esc_attr($current_id); ?>">
           
            <button type="submit" class="ctrw-submit-btn">
                <i class="fas fa-paper-plane"></i> Submit Review
            </button>
        </form>
    </div>
</div>