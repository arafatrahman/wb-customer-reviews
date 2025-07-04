<?php
// Get current post, page, or product ID
global $post;
$current_id = isset($post->ID) ? $post->ID : 0;

// Get reviews - ensure it returns an array
$reviews = (new CTRW_Review_Model())->get_review_by_id($current_id);
// [Keep all the existing PHP code from your list view until the display settings]

// Calculate rating statistics
$total_reviews = count($reviews);
$rating_counts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
$total_rating = 0;

foreach ($reviews as $review) {
    $review_data = (array) $review;
    $rating = (int) $review_data['rating'];
    if ($rating >= 1 && $rating <= 5) {
        $rating_counts[$rating]++;
        $total_rating += $rating;
    }
}

$average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;
$average_rating_display = number_format($average_rating, 1);
$full_stars = floor($average_rating);
$has_half_star = ($average_rating - $full_stars) >= 0.5;

// Calculate percentages for each star rating
$rating_percentages = [];
foreach ($rating_counts as $stars => $count) {
    $rating_percentages[$stars] = $total_reviews > 0 ? round(($count / $total_reviews) * 100) : 0;
}
?>


<div class="ctrw-review-card">
    <div class="ctrw-review-header">
        <h2>Customer Reviews</h2>
        <div class="ctrw-review-count">Based on <?php echo $total_reviews; ?> reviews</div>
    </div>

    <div class="ctrw-rating-summary">
        <div class="ctrw-average-rating">
            <div class="ctrw-rating-value"><?php echo $average_rating_display; ?></div>
            <div class="ctrw-stars">
                <?php 
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $full_stars) {
                        echo '<i class="fas fa-star"></i>';
                    } elseif ($i == $full_stars + 1 && $has_half_star) {
                        echo '<i class="fas fa-star-half-alt"></i>';
                    } else {
                        echo '<i class="far fa-star"></i>';
                    }
                }
                ?>
            </div>
            <div class="ctrw-rating-text">Average Rating</div>
        </div>
        
        <div class="ctrw-rating-distribution">
            <?php for ($stars = 5; $stars >= 1; $stars--) : ?>
                <div class="ctrw-rating-bar">
                    <div class="ctrw-star-label">
                        <i class="fas fa-star"></i> <?php echo $stars; ?> stars
                    </div>
                    <div class="ctrw-bar-container">
                        <div class="ctrw-bar" style="width: <?php echo $rating_percentages[$stars]; ?>%"></div>
                    </div>
                    <div class="ctrw-bar-percentage"><?php echo $rating_percentages[$stars]; ?>%</div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

</div>