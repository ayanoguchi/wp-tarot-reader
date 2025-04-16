jQuery(document).ready(function($){
    $('#tarot_upload_bg').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: '背景画像を選択',
            button: { text: 'この画像を使う' },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#tarot_background_url').val(attachment.url);
            $('#tarot_bg_preview').attr('src', attachment.url);
        }).open();
    });
});
