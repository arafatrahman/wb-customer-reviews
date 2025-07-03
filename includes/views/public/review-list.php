 
 <?php

// Get current post, page, or product ID
global $post;
$current_id = isset($post->ID) ? $post->ID : 0;

$reviews = (new CTRW_Review_Model())->get_review_by_id($current_id);

 ?>
 
 <div class="ctrw-review-card">
            <!-- Standard List View -->
            <div class="ctrw-review-list standard">
                <li class="ctrw-review-item">
                    <div class="ctrw-reviewer-info">
                        <div class="ctrw-reviewer-avatar">JD</div>
                        <div class="ctrw-reviewer-details">
                            <span class="ctrw-reviewer-name">John Doe</span> 
                            <span class="ctrw-review-date">March 15, 2023</span>
                        </div>
                        <div class="ctrw-review-rating">
                            <div class="ctrw-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="ctrw-review-content">
                        <div class="ctrw-review-title">Excellent product!</div>
                        <div class="ctrw-review-text">
                            This product exceeded all my expectations. The quality is outstanding and it arrived earlier than expected. 
                            I would definitely recommend this to anyone looking for a reliable solution. The customer service was also 
                            exceptional when I had questions about customization options.
                        </div>
                    </div>
                </li>

            </div>
</div>