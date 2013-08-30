jQuery(document).ready(function($) {
    var $endEl = $('.transition.has-end');
    if($endEl.length) {
        setTimeout(function() {
            $endEl.each(function() {
                $(this).hover(function() {
                    var $el = $(this);
                    var end = parseInt($el.data('end'));
                    $el.addClass('animate');
                    setTimeout(function() { $el.hide(); }, end);
                });
            });
        }, 3000);
    }

    // center map
    $('.center-map').click(function() {

        var lat = $(this).data('lat');
        var lon = $(this).data('lon');
        var zoom = $(this).data('zoom');
        if(lat && lon && zoom) {
            $('html,body').stop().animate({
                scrollTop: $('#map').offset().top
            }, 400, function() {
                jeo.map.centerzoom({lat: lat, lon: lon}, zoom, true);
            });
        }

        return false;

    });
});