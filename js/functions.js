(function($) {
  $('figure.wp-caption.aligncenter').removeAttr('style');
  $('img.aligncenter').wrap('<figure class="centered-image" />');
})(jQuery);

(function($) {
$(window).bind('scroll', function() {  
  
  navHeight = $('#masthead').height();
  
  if ($(window).scrollTop() > $('.header-image').height()) {
   $('#masthead').addClass('main-nav-scrolled');
   $('.site-content').css('marginTop', navHeight);
   }
   else {
     $('#masthead').removeClass('main-nav-scrolled'); 
     $('.site-content').css('marginTop', 'auto');
     
   }
});
})(jQuery);

