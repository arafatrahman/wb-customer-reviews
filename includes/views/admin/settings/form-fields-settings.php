<?php
$form_fields_settings = get_option('ctrw_form_fields_settings');
?>


<div id="form-fields" class="tab-content" style="display: none;">
        
        <form id="form-fields-settings" method="post">
            <h3>Form Fields Settings</h3>
            
            <div class="form-fields-grid" style="display: grid; grid-template-columns: .2fr .2fr; gap: 30px;">
                <!-- First Column: Custom Fields -->
                <div>
                    
                    <?php
                    // Prepare saved data
                    $field_names = isset($form_fields_settings['field_names']) ? $form_fields_settings['field_names'] : array_fill(0, 5, '');
                    $field_required = isset($form_fields_settings['field_required']) ? $form_fields_settings['field_required'] : array();
                    $field_visible = isset($form_fields_settings['field_visible']) ? $form_fields_settings['field_visible'] : array();

                    for ($i = 0; $i < 5; $i++) {
                        $name = isset($field_names[$i]) ? esc_attr($field_names[$i]) : '';
                        $required = isset($field_required[$i]) && $field_required[$i] === 'on';
                        $visible = isset($field_visible[$i]) && $field_visible[$i] === 'on';
                        ?>
                        <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                            <input type="text" name="field_names[]" value="<?php echo $name; ?>" class="regular-text" placeholder="Field label" style="flex: 1;">
                            <div style="display: flex; gap: 15px; white-space: nowrap;">
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_required[<?php echo $i; ?>]" <?php checked($required); ?>>
                                    Required
                                </label>
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_visible[<?php echo $i; ?>]" <?php checked($visible, true); ?>>
                                    Visible
                                </label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Second Column: Review Fields -->
                <div>
                   
                    <?php
                    $special_fields = [
                        ['label' => 'State', 'index' => 5],
                        ['label' => 'Review Title', 'index' => 6],
                        ['label' => 'Comment', 'index' => 7],
                        ['label' => 'Rating', 'index' => 8],
                    ];
                    
                    foreach ($special_fields as $field) {
                        $required = isset($form_fields_settings['field_required'][$field['index']]) && $form_fields_settings['field_required'][$field['index']] === 'on';
                        $visible = isset($form_fields_settings['field_visible'][$field['index']]) && $form_fields_settings['field_visible'][$field['index']] === 'on';
                        ?>
                        <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                            <input type="text" name="field_names[]" value="<?php echo esc_attr($field['label']); ?>" class="regular-text" style="flex: 1;">
                            <div style="display: flex; gap: 15px; white-space: nowrap;">
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_required[<?php echo $field['index']; ?>]" <?php checked($required, true); ?>>
                                    Required
                                </label>
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_visible[<?php echo $field['index']; ?>]" <?php checked($visible, true); ?>>
                                    Visible
                                </label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Form Fields</button>
            </p>
        </form>
    </div>