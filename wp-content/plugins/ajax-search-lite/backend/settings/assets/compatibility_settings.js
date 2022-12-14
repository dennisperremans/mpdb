// Simulate a click on the first element to initialize the tabs
jQuery(function ($) {
    // Remove the # from the hash, as different browsers may or may not include it
    var hash = location.hash.replace('#','');

    if(hash != ''){
        hash = parseInt(hash);
        $('.tabs a[tabid=' + Math.floor( hash / 100 ) + ']').click();
        $('.tabs a[tabid=' + hash + ']').click();
    } else {
        $('.tabs a[tabid=1]').click();
    }

    $('.tabs a').on('click', function(){
        location.hash = $(this).attr('tabid');
    });

    WPD.Conditionals.init('.tabscontent');
});