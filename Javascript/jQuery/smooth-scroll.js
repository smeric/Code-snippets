/*! Smooth scroll to the class area_name
    $('.area_name').click(function(e){e.preventDefault();$(this).autoscroll($(this).attr('href'));}); */

!function($){$.fn.autoscroll=function(s){$('html,body').animate({scrollTop:$(s).offset().top},200)}}(jQuery);

/* For a <body id="top"> , this is a smooth scroll floating button that brings you back to the top of the page */
$('body').prepend('<a href="#top" id="go-top">Top</a>');$('#go-top').css({'position':'fixed','right':'20px','bottom':'50px','display':'none','opacity':'.3','z-index':'2000'}).hover(function(){$(this).css('opacity','.8');},function(){$(this).css('opacity','.3');}).click(function(e){$(this).autoscroll($(this).attr('href'));e.preventDefault();});$(window).scroll(function(){var posScroll=$(document).scrollTop();if(posScroll>=550){$('#go-top').fadeIn(600);}else{$('#go-top').fadeOut(600);}});

