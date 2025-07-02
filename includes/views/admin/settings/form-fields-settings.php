<?php
$form_fields_settings = get_option('ctrw_form_fields_settings');

// Default labels (only used when no settings exist)
$default_labels = [
    0 => 'Name',
    1 => 'Email',
    2 => 'Phone',
    3 => 'Website',
    4 => 'City',
    5 => 'State',
    6 => 'Review Title',
    7 => 'Comment',
    8 => 'Rating'
];

// Initialize field names - only use defaults if no settings exist
if (empty($form_fields_settings)) {
    $field_names = $default_labels;
    $field_required = [];
    $field_visible = array_fill(0, 9, 'on'); // All visible by default
} else {
    $field_names = isset($form_fields_settings['field_names']) ? $form_fields_settings['field_names'] : $default_labels;
    $field_required = isset($form_fields_settings['field_required']) ? $form_fields_settings['field_required'] : [];
    $field_visible = isset($form_fields_settings['field_visible']) ? $form_fields_settings['field_visible'] : array_fill(0, 9, 'on');
}

// Ensure all array indexes exist
$field_names = array_replace($default_labels, $field_names);
?>

<div id="form-fields" class="tab-content" style="display: none;">
    <form id="form-fields-settings" method="post">
        <h3>Form Fields Settings</h3>
        
        <div class="form-fields-grid" style="display: grid; grid-template-columns: .2fr .2fr; gap: 30px;">
            <!-- First Column: Basic Fields -->
            <div>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                        <input type="text" name="field_names[]" value="<?php echo esc_attr($field_names[$i]); ?>" class="regular-text" style="flex: 1;">
                        <div style="display: flex; gap: 15px; white-space: nowrap;">
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="field_required[<?php echo $i; ?>]" <?php checked(isset($field_required[$i]) && $field_required[$i] === 'on'); ?>>
                                Required
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="field_visible[<?php echo $i; ?>]" <?php checked(isset($field_visible[$i]) && $field_visible[$i] === 'on'); ?>>
                                Visible
                            </label>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            
            <!-- Second Column: Special Fields -->
            <div>
                <?php for ($i = 5; $i <= 8; $i++): ?>
                    <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                        <input type="text" name="field_names[]" value="<?php echo esc_attr($field_names[$i]); ?>" class="regular-text" style="flex: 1;">
                        <div style="display: flex; gap: 15px; white-space: nowrap;">
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="field_required[<?php echo $i; ?>]" <?php checked(isset($field_required[$i]) && $field_required[$i] === 'on'); ?>>
                                Required
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="field_visible[<?php echo $i; ?>]" <?php checked(isset($field_visible[$i]) && $field_visible[$i] === 'on'); ?>>
                                Visible
                            </label>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        
        <p class="submit">
            <button type="submit" class="button-primary">Save Form Fields</button>
            <input type="hidden" name="action" value="update_ctrw_form_fields">
            <?php wp_nonce_field('ctrw_form_fields_nonce'); ?>
        </p>
    </form>
</div>