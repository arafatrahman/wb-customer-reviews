jQuery(document).ready(function($) {

      $('.add-ctrw-review').on('click', function() {
         $('#update-type').val("add");
         $('#cr-edit-review-popup').show();
      });
      
      $('.edit-review').on('click', function() {
      let reviewId = $(this).data('review-id');
      
      // AJAX call to get review data
      $.ajax({
            url: ctrw_datatable_ajax.ajax_url,
            type: 'POST',
            data: {
                  action: 'get_review_data',
                  review_id: reviewId,
                  security: ctrw_datatable_ajax.nonce // Changed from _security to security
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
                  $('#update-type').val("update");
                  // Show the popup with the original form HTML
                  $('#cr-edit-review-popup').show();
                  } else {
                  alert('Error: ' + response.data);
                  }
            }
      });
      });
      $('.reply-now').on('click', function() {

            $('#reply-review-id').val($(this).data('review-id'));
            $('#reply-review-author').text($(this).data('review-author'));
            $('#reply-message').val($(this).data('reply-message') || '');
            $('#cr-reply-popup').show();
      });

      $('#close-edit-review-popup').on('click', function() {
            $('#cr-edit-review-popup').hide();
      });

      $('#update-customer-review').on('click', function(event) {
      event.preventDefault();
      
      // Collect form data more efficiently
      let formData = {
            action: 'update_ctrw_review',
            security: ctrw_datatable_ajax.nonce,
            id: $('#edit-review-id').val(),
            update_type: $('#update-type').val(),
            name: $('#edit-review-name').val(),
            email: $('#edit-review-email').val(),
            phone: $('#edit-review-phone').val(),
            website: $('#edit-review-website').val(),
            review: $('#edit-review-comment').val(),
            city: $('#edit-review-city').val(),
            state: $('#edit-review-state').val(),
            status: $('#edit-review-status').val(),
            rating: $('#edit-review-rating').val(),
            title: $('#edit-review-title').val(),
            positionid: $('#edit-review-positionid').val()
      };

      $.ajax({
            url: ctrw_datatable_ajax.ajax_url,
            method: 'POST',
            data: formData,
            success: function(response) {
                  if (response.success) {
                  alert('Review updated successfully.');
                  $('#cr-edit-review-popup').hide();
                  location.reload();
                  } else {
                  console.error(response.data);
                  alert('Failed to update review: ' + response.data);
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
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