<?php
// Get current post, page, or product ID
global $post;
$current_id = isset($post->ID) ? $post->ID : 0;

// Get reviews - ensure it returns an array
$reviews = (new CTRW_Review_Model())->get_review_by_id($current_id);

// Get display settings with defaults
$settings = get_option('ctrw_general_settings', []);
$displaySettings = get_option('ctrw_display_settings', []);

// Set default values if not exists
$defaults = [
    'name_font_weight' => 'normal',
    'comment_font_size' => '14',
    'comment_font_style' => 'normal',
    'comment_line_height' => '20',
    'comment_box_color' => '#f5f5f5',
    'star_color' => '#ffb100',
    'show_time_with_date' => '',
    'show_city' => '',
    'show_state' => ''
];

$displaySettings = wp_parse_args($displaySettings, $defaults);

// Date format settings
$date_format = $settings['date_format'] ?? 'm/d/Y';
$showTimeDate = $displaySettings['show_time_with_date'] == 'on';

// Location display settings
$showCity = $displaySettings['show_city'] == 'on';
$showState = $displaySettings['show_state'] == 'on';

// If time display is enabled, append time format to date format
if ($showTimeDate) {
    $date_format .= ' h:i A';
}

// If we get a single review object instead of array, convert it to an array of one item
if (is_object($reviews)) {
    $reviews = [$reviews];
} elseif (!is_array($reviews)) {
    $reviews = [];
}

// Generate dynamic styles based on settings
$dynamic_styles = "
    .ctrw-review-item {
        background-color: {$displaySettings['comment_box_color']};
        line-height: {$displaySettings['comment_line_height']}px;
    }
    .ctrw-reviewer-name {
        font-weight: {$displaySettings['name_font_weight']};
    }
    .ctrw-review-text {
        font-size: {$displaySettings['comment_font_size']}px;
        font-style: {$displaySettings['comment_font_style']};
    }
    .ctrw-stars .fas.fa-star {
        color: {$displaySettings['star_color']};
    }
";
?>
<style><?php echo $dynamic_styles; ?></style>

<?php if (!empty($reviews)) : ?>
<div class="ctrw-review-card">
    <!-- Standard List View -->
    <div class="ctrw-review-list standard">
        <?php foreach ($reviews as $review) : 
            // Handle both array and object access
            $review_data = (array) $review;
            
            // Format the date according to settings
            $review_date = date($date_format, strtotime($review_data['date']));
            
            // Get initials for avatar
            $name_parts = explode(' ', $review_data['name']);
            $initials = '';
            foreach ($name_parts as $part) {
                if (!empty($part)) {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
            }
            $initials = substr($initials, 0, 2);
            
            // Generate stars based on rating
            $stars = '';
            $full_stars = (int) $review_data['rating'];
            $empty_stars = 5 - $full_stars;
            
            for ($i = 0; $i < $full_stars; $i++) {
                $stars .= '<i class="fas fa-star"></i>';
            }
            for ($i = 0; $i < $empty_stars; $i++) {
                $stars .= '<i class="far fa-star"></i>';
            }
            
            // Prepare location information if enabled
            $location_parts = [];
            if ($showCity && !empty($review_data['city'])) {
                $location_parts[] = esc_html($review_data['city']);
            }
            if ($showState && !empty($review_data['state'])) {
                $location_parts[] = esc_html($review_data['state']);
            }
            $location = implode(', ', $location_parts);
        ?>
        <li class="ctrw-review-item">
            <div class="ctrw-reviewer-info">
                <div class="ctrw-reviewer-avatar"><?php echo $initials; ?></div>
                <div class="ctrw-reviewer-details">
                    <span class="ctrw-reviewer-name"><?php echo esc_html($review_data['name']); ?></span>
                    <?php if (!empty($location)) : ?>
                        <span class="ctrw-reviewer-location"><?php echo $location; ?></span>
                    <?php endif; ?>
                    <span class="ctrw-review-date"><?php echo $review_date; ?></span>
                </div>
                <div class="ctrw-review-rating">
                    <div class="ctrw-stars">
                        <?php echo $stars; ?>
                    </div>
                </div>
            </div>
            <div class="ctrw-review-content">
                <?php if (!empty($review_data['title'])) : ?>
                    <div class="ctrw-review-title"><?php echo esc_html($review_data['title']); ?></div>
                <?php endif; ?>
                <div class="ctrw-review-text">
                    <?php echo esc_html($review_data['review']); ?>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </div>
</div>

<?php else : ?>
    <p class="ctrw-no-reviews">No reviews yet.</p>
<?php endif; ?>