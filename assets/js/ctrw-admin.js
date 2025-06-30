        // Simple tab switching functionality
        document.querySelectorAll('.ctrw-settings-tabs button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and sections
                document.querySelectorAll('.ctrw-settings-tabs button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.ctrw-settings-section').forEach(section => section.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Show corresponding section
                const tabIndex = Array.from(document.querySelectorAll('.ctrw-settings-tabs button')).indexOf(button);
                document.querySelectorAll('.ctrw-settings-section')[tabIndex].classList.add('active');
            });
        });

        // Copy button functionality
        document.querySelectorAll('.ctrw-copy-btn').forEach(button => {
            button.addEventListener('click', () => {
                const input = button.parentElement.querySelector('input');
                input.select();
                document.execCommand('copy');
                
                // Visual feedback
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.style.background = 'var(--success)';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = 'var(--primary)';
                }, 2000);
            });
        });

        // Form reset functionality
        document.querySelectorAll('.ctrw-reset-btn').forEach(button => {
            button.addEventListener('click', () => {
                const form = button.closest('form');
                if (form) {
                    form.reset();
                }
            });
        });





    jQuery(document).ready(function($) {
        $('#general-settings').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            
            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;
            
            // Add action
            formData += '&action=ctrw_save_general_settings';
            
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');
            
            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url, // Note: ajax_url instead of ajaxurl
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save General Settings');
                }
            });
        });

        $('#form-fields-settings').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            
            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;
            
            // Add action
            formData += '&action=ctrw_save_form_fields_settings';
            
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');
            
            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url, // Note: ajax_url instead of ajaxurl
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save Form Fields Settings');
                }
            });
        });

        $('#display-settings').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            
            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;
            
            // Add action
            formData += '&action=ctrw_save_display_settings';
            
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');
            
            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url, // Note: ajax_url instead of ajaxurl
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save Display Settings');
                }
            });
        });

        $('#woocommerce-settings').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            
            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;
            
            // Add action
            formData += '&action=ctrw_save_woocommerce_settings';
            
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');
            
            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url, // Note: ajax_url instead of ajaxurl
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save WooCommerce Settings');
                }
            });
        });


        $('#schema-settings').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            
            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;
            
            // Add action
            formData += '&action=ctrw_save_schema_settings';
            
            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');
            
            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url, // Note: ajax_url instead of ajaxurl
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save Schema Settings');
                }
            });
        });


        $('#advanced-settings').on('submit', function(e) {
            e.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            // Add security nonce using your existing object
            formData += '&security=' + ctrw_admin_ajax.nonce;

            // Add action
            formData += '&action=ctrw_save_advanced_settings';

            // Show loading indicator
            $('.ctrw-save-btn').prop('disabled', true).text('Saving...');

            // AJAX request
            $.ajax({
                type: 'POST',
                url: ctrw_admin_ajax.ajax_url,
                data: formData,
                success: function(response) {
                    $('#ctrw-success-msg').fadeIn().delay(2000).fadeOut();
                },
                complete: function() {
                    $('.ctrw-save-btn').prop('disabled', false).text('Save Advanced Settings');
                }
            });
        });

            


    });