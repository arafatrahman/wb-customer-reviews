<?php
$advancedSettings = get_option('ctrw_advanced_settings');
?>

    
    <div id="advanced" class="tab-content" style="display: none;">
        <h3>Advanced Settings</h3>
        <form id="advanced-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="admin_emails">Admin notification emails</label></th>
                        <td>
                            <input type="text" id="admin_emails" name="admin_emails" value="<?php echo isset($advancedSettings['admin_emails']) ? esc_attr($advancedSettings['admin_emails']) : ''; ?>" class="regular-text">
                            <p class="description">Comma separate multiple emails</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="custom_message">Custom Messages</label></th>
                        <td>
                            <textarea id="custom_message" name="custom_message" class="regular-text" style="height: 120px; font-family: monospace;" placeholder="Enter your custom CSS here"><?php echo isset($advancedSettings['custom_message']) ? esc_textarea($advancedSettings['custom_message']) : ''; ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Advanced Settings</button>
            </p>
        </form>
    </div>