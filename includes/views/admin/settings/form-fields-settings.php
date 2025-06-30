

<?php
$form_fields_settings = get_option('ctrw_form_fields_settings');
?>
<form id="form-fields-settings" class="ctrw-settings-section" method="post">
    <h2>Form Fields Settings</h2>
    <div class="form-row">
        <div class="form-group">
            <div class="fields-grid">
                <div class="ctrw-field-header">Field Label Name</div>
                <div class="ctrw-field-header">Required</div>
                <div class="ctrw-field-header">Visible</div>
                <!-- Field Rows -->
                <?php
                // Prepare saved data
                $field_names    = isset($form_fields_settings['field_names']) ? $form_fields_settings['field_names'] : [];
                $field_required = isset($form_fields_settings['field_required']) ? $form_fields_settings['field_required'] : [];
                $field_visible  = isset($form_fields_settings['field_visible']) ? $form_fields_settings['field_visible'] : [];

                $fields_count = count($field_names);

                for ($i = 0; $i < $fields_count; $i++) {
                    $name = isset($field_names[$i]) ? esc_attr($field_names[$i]) : '';
                    $required = isset($field_required[$i]) && $field_required[$i] === 'on';
                    $visible = isset($field_visible[$i]) && $field_visible[$i] === 'on';
                    ?>
                    <div class="field-row">
                        <div class="field-name">
                            <input type="text" name="field_names[]" value="<?php echo $name; ?>">
                        </div>
                        <div class="field-option">
                            <input type="checkbox" name="field_required[<?php echo $i; ?>]" <?php checked($required); ?>>
                        </div>
                        <div class="field-option">
                            <input type="checkbox" name="field_visible[<?php echo $i; ?>]" <?php checked($visible); ?>>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div> 
    </div>
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save Form Fields</button>
    </div>
</form>
