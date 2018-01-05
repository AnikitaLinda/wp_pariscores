(function($) {
  $('figure.wp-caption.aligncenter').removeAttr('style');
  $('img.aligncenter').wrap('<figure class="centered-image" />');

/*
	 * Create sticky header
	 * 
	 */

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

/*
	 * Manage top button
	 * 
	 */
$(document).ready(function(){
    var show = 200;
    var speed = 500;
    var duration = 500;
	   $(window).scroll(function(){
            if ($(this).scrollTop() < show) {
			     $('.topbutton') .fadeOut(duration);
            } else {
			     $('.topbutton') .fadeIn(duration);
            }
        });
	$('.topbutton').on('click', function(){    
		$('html, body').animate({scrollTop:0}, speed);
		return false;
		});
  }); 


/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
   * 
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}
	
	if ( true === supportsInlineSVG() ) {
		document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
	}
  
})(jQuery);

