/*! Back buttons */

$('.back').css('cursor','pointer').click(function(e){if(history.length){history.back();e.preventDefault()}});
