jQuery(document).ready(function($){
    // Upload Image functionality
    $(document).on('click', '.desilan-image-upload-btn', function(e) {
        e.preventDefault();
        var button = $(this);
        var inputField = button.prev('.desilan-image-upload-url');
        
        var custom_uploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url).trigger('change');
        }).open();
    });
});
