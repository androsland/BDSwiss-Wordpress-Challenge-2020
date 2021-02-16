jQuery(document).ready(function($) {
  // Uploading files
  var file_frame;
  // Store the old id
  var wp_media_post_id = wp.media.model.settings.post.id;

  jQuery('#upload_image_button').on('click', function(event) {
    event.preventDefault();
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Select logo',
      button: {
        text: 'Use this image',
      },
      multiple: false
    });
    // When an image is selected, run a callback.
    file_frame.on('select', function() {
      attachment = file_frame.state().get('selection').first().toJSON();
      $('#image-preview').attr('src', attachment.url).css('width', 'auto');
      $('#bdswiss_rss_logo').val(attachment.url);
      // Restore the main post ID
      wp.media.model.settings.post.id = wp_media_post_id;
    });
    // Finally, open the modal
    file_frame.open();
  });
  // Restore the main ID when the add media button is pressed
  jQuery('a.add_media').on('click', function() {
    wp.media.model.settings.post.id = wp_media_post_id;
  });

  jQuery('#remove-logo').on('click', function() {
    $('#bdswiss_rss_logo').val('');
    $('#image-preview').attr('src','');
  });
});