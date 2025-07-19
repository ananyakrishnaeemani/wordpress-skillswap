jQuery(document).ready(function ($) {
  $('#srp-submit-rating').click(function () {
    let rating = $('#srp-rating-select').val();
    let post_id = $('#srp-rating').data('postid');

    if (!rating) {
      $('#srp-response').text('Please select a rating!');
      return;
    }

    $.post(srp_ajax_object.ajax_url, {
      action: 'srp_submit_rating',
      rating: rating,
      post_id: post_id,
      nonce: srp_ajax_object.nonce
    }, function (response) {
      if (response.success) {
        $('#srp-response').text('Thanks! New average: ' + response.data.average + ' ⭐');
      } else {
        $('#srp-response').text('Error: ' + response.data);
      }
    });
  });
});
