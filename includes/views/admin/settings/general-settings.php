
<?php
$generalSettings = get_option('ctrw_general_settings');
?>


<div id="general" class="tab-content ctrw-setting" style="display: block;">
        <form id="general-settings" method="post" class="form-table">
            <h3>General Settings</h3>
            <table class="form-table">
                <tbody>

                    <tr>
                        <th scope="row">Display Options</th>
                        <td>
                           
                            <label>
                                <input type="checkbox" id="enable_review_summary" name="enable_review_summary" <?php checked(isset($generalSettings['enable_review_summary']) && $generalSettings['enable_review_summary'] === 'on'); ?>>
                                Display a summary of reviews on the site.
                            </label>
                            <br>
                             <label>
                                <input type="checkbox" id="enable_review_form" name="enable_review_form" <?php checked(isset($generalSettings['enable_review_form']) && $generalSettings['enable_review_form'] === 'on'); ?>>
                                Allow customers to submit reviews using the review form.
                            </label><br>
                            <label>
                                <input type="checkbox" id="enable_review_list" name="enable_review_list" <?php checked(isset($generalSettings['enable_review_list']) && $generalSettings['enable_review_list'] === 'on'); ?>>
                                Display a list of reviews on the site.
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" id="enable_floating_reviews" name="enable_floating_reviews" <?php checked(isset($generalSettings['enable_floating_reviews']) && $generalSettings['enable_floating_reviews'] === 'on'); ?>>
                                Display floating reviews widget on the site.
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" id="enable_slider_reviews" name="enable_slider_reviews" <?php checked(isset($generalSettings['enable_slider_reviews']) && $generalSettings['enable_slider_reviews'] === 'on'); ?>>
                                Display slider reviews widget on the site.
                            </label>

                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="reviews_per_page">Reviews per page</label></th>
                        <td>
                            <input type="number" id="reviews_per_page" name="reviews_per_page" min="1" max="50" value="<?php echo isset($generalSettings['reviews_per_page']) ? esc_attr($generalSettings['reviews_per_page']) : '12'; ?>" class="regular-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Date Format</th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="date_format" value="mm/dd/yyyy" <?php checked(isset($generalSettings['date_format']) ? $generalSettings['date_format'] : '', 'mm/dd/yyyy'); ?>> MM/DD/YYYY
                                </label><br>
                                <label>
                                    <input type="radio" name="date_format" value="dd/mm/yyyy" <?php checked(isset($generalSettings['date_format']) ? $generalSettings['date_format'] : '', 'dd/mm/yyyy'); ?>> DD/MM/YYYY
                                </label><br>
                                <label>
                                    <input type="radio" name="date_format" value="yyyy/mm/dd" <?php checked(isset($generalSettings['date_format']) ? $generalSettings['date_format'] : '', 'yyyy/mm/dd'); ?>> YYYY/MM/DD
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Email Settings</th>
                        <td>
                            <label>
                                <input type="checkbox" name="admin_email_notifications" <?php checked(isset($generalSettings['admin_email_notifications']) && $generalSettings['admin_email_notifications'] === 'on'); ?>> Enable admin email notifications
                            </label><br>
                            <label>
                                <input type="checkbox" name="customer_email_receipts" <?php checked(isset($generalSettings['customer_email_receipts']) && $generalSettings['customer_email_receipts'] === 'on'); ?>> Enable customer email receipts
                            </label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Review Approval</th>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_approval" <?php checked(isset($generalSettings['auto_approval']) && $generalSettings['auto_approval'] === 'on'); ?>> Automatic review approval
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save General Settings</button>
            </p>
        </form>
    </div>