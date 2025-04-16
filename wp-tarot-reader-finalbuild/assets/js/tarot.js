jQuery(document).ready(function($){
    const bg = tarotAjax.bg_url;
    if (bg) $('#tarot-wrap').css('background-image', 'url(' + bg + ')');
    $('#draw-tarot').on('click', function(){
        $.post(tarotAjax.ajax_url, {
            action: 'tarot_draw',
            post_id: tarotAjax.post_id
        }, function(response){
            let html = '<h3>' + response.card + '</h3>';
            if(response.meaning) html += '<p>' + response.meaning + '</p>';
            if(response.banner) html += '<div>' + response.banner + '</div>';
            $('#tarot-result').html(html).addClass('show');
        });
    });
});
