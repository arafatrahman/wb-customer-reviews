
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

        $('.reply-now').on('click', function() {

            $('#reply-review-id').val($(this).data('review-id'));
            $('#reply-review-author').text($(this).data('review-author'));
            $('#reply-message').val($(this).data('reply-message') || '');
            $('#cr-reply-popup').show();
        });

        $('.edit-review').on('click', function() {

         let reviewId = $(this).data('review-id');
         // AJAX call to get review data
            $.ajax({
                url: ctrw_admin_ajax.ajax_url, // WordPress AJAX URL
                type: 'POST',
                data: {
                    action: 'get_review_data',
                    review_id: reviewId,
                    security: ctrw_admin_ajax.nonce
                },
                success: function(response) {
                    if(response.success) {
                        const review = response.data;
                        // Populate form fields
                        $('#edit-review-id').val(review.id);
                        $('#edit-review-name').val(review.name);
                        $('#edit-review-email').val(review.email);
                        $('#edit-review-website').val(review.website);
                        $('#edit-review-phone').val(review.phone);
                        $('#edit-review-city').val(review.city);
                        $('#edit-review-state').val(review.state);
                        $('#edit-review-status').val(review.status);
                        $('#edit-review-title').val(review.title);
                        $('#edit-review-comment').val(review.review);
                        $('#edit-review-rating').val(review.rating);
                        $('#edit-review-positionid').val(review.page_id);
                        
                        // Show the popup with the original form HTML
                        $('#cr-edit-review-popup').show();
                    } else {
                        alert('Error: ' + response.data);
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX Error: ' + error);
                }
            });

        });

        $('#close-edit-review-popup').on('click', function() {
         $('#cr-edit-review-popup').hide();
        });

    $('#update-customer-review').on('click', function(event) {
        
        // Prevent the default form submission
        event.preventDefault();
       
        let reviewId = $('#edit-review-id').val();
        let updateType = $('#update-type').val();
        let reviewName = $('#edit-review-name').val();
        let reviewEmail = $('#edit-review-email').val();
        let reviewPhone = $('#edit-review-phone').val();
        let reviewWebsite = $('#edit-review-website').val();
        let reviewComment = $('#edit-review-comment').val();
        let reviewCity = $('#edit-review-city').val();
        let reviewState = $('#edit-review-state').val();
        let reviewStatus = $('#edit-review-status').val();
        let reviewRating = $('#edit-review-rating').val();
        let reviewTitle = $('#edit-review-title').val();
        let reviewPositionId = $('#edit-review-positionid').val();

        $.ajax({
            url: ctrw_admin_ajax.ajax_url,
            method: 'POST',
            data: {
                action: 'update_ctrw_review',
                security: ctrw_admin_ajax.nonce,
                id: reviewId,
                update_type: updateType,
                name: reviewName,
                email: reviewEmail,
                phone: reviewPhone,
                website: reviewWebsite,
                review: reviewComment,
                city: reviewCity,
                state: reviewState,
                status: reviewStatus,
                rating: reviewRating,
                title: reviewTitle,
                page_id: reviewPositionId
            },
            success: function(response) {
                 
                if (response.success) {
                    alert('Review updated successfully.');
                    $('#cr-edit-review-popup').hide();
                    location.reload();
                } else {
                    console.log(response.data);
                    alert('Failed to update review: ' + response.data);
                }
            },
            error: function() {
                alert('An error occurred while updating the review.');
            }
        });
    });

    $('#close-reply-popup').on('click', function() {
      $('#cr-reply-popup').hide();
    });

    $('#ctrw-import-form').on('submit', function(event) {
        event.preventDefault();

        
        let selectedPlugin = $('#ctrw_import_plugin').val();
        $.ajax({
            url: cradmin_ajax.ajax_url,
            method: 'POST',
            data: {
              action: 'ctrw_import_review_from_others',
              ctrw_import_review: selectedPlugin,
           },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    alert('Imports completed successfully.');
                    $('#ctrw-import-popup').hide();
                   
                } 
            },
            error: function() {
                alert('An error occurred during import.');
            }
        });
    });

    $('#close-ctrw-import-popup').on('click', function() {
        $('#ctrw-import-popup').hide();
    });

    $('#reply-form').on('submit', function(event) {
    
      event.preventDefault();

      let reviewId = $('#reply-review-id').val();
      let replyMessage = $('#reply-message').val();

      if (!replyMessage.trim()) {
          alert('Reply message cannot be empty.');
          return;
      }

      $.ajax({
          url: cradmin_ajax.ajax_url, 
          method: 'POST',
          data: {
              action: 'save_review_reply',
              review_id: reviewId,
              reply_message: replyMessage
          },
          success: function(response) {
              if (response.success) {
                  alert('Reply submitted successfully.');
                  $('#cr-reply-popup').hide();
              location.reload();
              } else {
                  alert('Failed to submit reply: ' + response.data);
              }
          },
          error: function() {
              alert('An error occurred while submitting the reply.');
          }
      });
      });

        $('#select-all').on('click', function() {
            let isChecked = $(this).prop('checked');
            $('input[name=\"review_ids[]\"]').prop('checked', isChecked);
        });
        $('#import-customer-reviews').on('click', function() {
            
            $('#ctrw-import-popup').show();
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
        }.bind(this), 800);
    });

    $('#review_display_type').on('change', function() {
        var infoText = '';
        switch ($(this).val()) {
            case 'list':
                infoText = 'Displays reviews in a standard list format.';
                break;
            case 'slider':
                infoText = 'Displays reviews in a slider/carousel format.';
                break;
            case 'floating':
                infoText = 'Displays reviews in a floating widget on the page.';
                break;
        }
        $('#review_display_info').text(infoText);
    });

    // Trigger info on page load if a value is already selected
    $('#review_display_type').trigger('change');

});