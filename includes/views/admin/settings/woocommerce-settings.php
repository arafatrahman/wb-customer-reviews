 <?php

$woocommerceSettings = get_option('ctrw_woocommerce_settings', array());


?>
 
 
 <div id="woocommerce" class="tab-content" style="display: none;">
        <h3>WooCommerce Settings</h3>
        <form id="woocommerce-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">WooCommerce Integration</th>
                        <td>
   
                            <label>
                                <input type="checkbox" name="show_on_product_pages" <?php checked(isset($woocommerceSettings['show_on_product_pages']) && $woocommerceSettings['show_on_product_pages'] === 'on'); ?>>
                                Show reviews on product pages
                            </label><br>
                            <label>
                                <input type="checkbox" name="review_summary" <?php checked(isset($woocommerceSettings['review_summary']) && $woocommerceSettings['review_summary'] === 'on'); ?>>
                                Show Review Summary
                            </label><br>
                            
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="min_rating_display">Minimum rating to display on product page</label></th>
                        <td>
                            <select id="min_rating_display" name="min_rating_display" class="regular-text">
                                <option value="0" <?php selected(isset($woocommerceSettings['min_rating_display']) ? $woocommerceSettings['min_rating_display'] : '', '0'); ?>>No minimum</option>
                                <option value="2" <?php selected(isset($woocommerceSettings['min_rating_display']) ? $woocommerceSettings['min_rating_display'] : '', '2'); ?>>2 stars</option>
                                <option value="3" <?php selected(isset($woocommerceSettings['min_rating_display']) ? $woocommerceSettings['min_rating_display'] : '', '3'); ?>>3 stars</option>
                                <option value="4" <?php selected(isset($woocommerceSettings['min_rating_display']) ? $woocommerceSettings['min_rating_display'] : '', '4'); ?>>4 stars</option>
                            </select>
                        </td>
                    </tr>

                        <tr>
                            <th scope="row"><label for="review_display_type">Reviews display style</label></th>
                            <td>
                                <select name="review_display_type" id="review_display_type" class="regular-text">
                                    <option value="list" <?php selected(isset($woocommerceSettings['review_display_type']) ? $woocommerceSettings['review_display_type'] : '', 'list'); ?>>List Review</option>
                                    <option value="slider" <?php selected(isset($woocommerceSettings['review_display_type']) ? $woocommerceSettings['review_display_type'] : '', 'slider'); ?>>Review Slider</option>
                                    <option value="floating" <?php selected(isset($woocommerceSettings['review_display_type']) ? $woocommerceSettings['review_display_type'] : '', 'floating'); ?>>Review Widget</option>
                                </select>
                                <p id="review_display_info"></p>
                            </td>
                        </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save WooCommerce Settings</button>
            </p>
        </form>
    </div>