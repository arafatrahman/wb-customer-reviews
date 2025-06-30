
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



    jQuery(document).ready(function($) {

 
    // Tab functionality
    $('.nav-tab-wrapper a').click(function(e) {
        e.preventDefault();
        
        // Hide all tab content
        $('.tab-content').hide();
        
        // Remove active class from all tabs
        $('.nav-tab-wrapper a').removeClass('nav-tab-active');
        
        // Add active class to clicked tab
        $(this).addClass('nav-tab-active');
        
        // Show the corresponding tab content
        $($(this).attr('href')).show();
    });
    
    // Color picker
    $('.color-picker').wpColorPicker();
    
    // Copy button functionality
    $('button:contains("Copy")').click(function() {
        var input = $(this).prev('input');
        input.select();
        document.execCommand('copy');
        
        // Show copied feedback
        var originalText = $(this).text();
        $(this).text('Copied!');
        setTimeout(function() {
            $(this).text(originalText);
        }.bind(this), 2000);
    });
});