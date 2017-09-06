/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
      $( '.main-navigation a,button.dropdown-toggle,.menu-toggle,.site-footer,.site-footer a' ).css( {
				'color': to
			} );
			$( '.menu-toggle,.custom-logo-link:focus > img, .custom-logo-link:hover > img' ).css( {
				'outline-color': to
			} );
			$( 'button.menu-toggle:hover,button.menu-toggle:focus' ).css( {
				'background-color:': to
			} );
		} );
	} );
  
  // Background color for header and footer.
	wp.customize( 'theme_bg_color', function( value ) {
		value.bind( function( to ) {
		$( '.site-header, .site-footer' ).css( {
					'background-color': to
			} );
		} );
	} );
  
    // Background color for footer widgets.
	wp.customize( 'footer_widgets_bg_color', function( value ) {
		value.bind( function( to ) {
		$( '.footer-widgets' ).css( {
					'background-color': to
			} );
		} );
	} );
  
  // Interactive color for links etc.
	wp.customize( 'interactive_color', function( value ) {
		value.bind( function( to ) {
			$( 'a:hover,a:focus, a:active,.site-title a:hover,.site-title a:focus,.main-navigation a:hover,.main-navigation a:focus,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.main-navigation .current-menu-ancestor > a,.page-content a:focus, .page-content a:hover,.entry-content a:focus,.entry-content a:hover,.entry-summary a:focus,.entry-summary a:hover,.comment-content a:focus,.comment-content a:hover,.comment-meta a:hover, .comment-meta a:focus,.comment-form a:hover,.comment-form a:focus,.pagination .current,.comment-awaiting-moderation,.site-footer a:hover, .site-footer a:focus,.widget_calendar a,.cat-links a' ).css( {
				'color': to
			} );
			$( 'button:hover,button:active,button:focus,input[type="button"]:hover,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:hover,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:hover,input[type="submit"]:active,input[type="submit"]:focus,.page-content a,.entry-content a,.entry-summary a,.comment-content a,.edit-link a:hover,.edit-link a:focus,.comment-navigation a:hover,.comment-navigation a:focus,.posts-navigation a:hover,.posts-navigation a:focus,.post-navigation a:hover,.post-navigation a:focus,.paging-navigation a:hover,.paging-navigation a:focus,.post-navigation .post-title,.reply a:hover,.reply a:focus,.bypostauthor .avatar,.comment-form .form-submit input:hover,.comment-form .form-submit input:focus' ).css( {
				'border-color': to
			} );
			$( 'button:hover, button:active, button:focus,input[type="button"]:hover,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:hover,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:hover,input[type="submit"]:active,input[type="submit"]:focus,.edit-link a:hover, .edit-link a:focus,.comment-navigation a:hover,.comment-navigation a:focus,.posts-navigation a:hover,.posts-navigation a:focus,.post-navigation a:hover,.post-navigation a:focus,.paging-navigation a:hover,.paging-navigation a:focus,.pagination a:focus,.pagination a:hover,.search .page-content,.error-404 .page-content,.read-more a:focus, .read-more a:hover,.reply a:hover, .reply a:focus,.comment-form .form-submit input:hover,.comment-form .form-submit input:focus' ).css( {
				'background-color': to
			} );
		} );
	} );  
  
} )( jQuery );
