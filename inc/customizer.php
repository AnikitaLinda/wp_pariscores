<?php
/**
 * pariscores Theme Customizer
 *
 * @package pariscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pariscores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  /**
   * Custom Customizer Customizations
   */
  
  // Setting for header and footer background color
  $wp_customize->add_setting( 'theme_bg_color', array(
      'default' => '#002254',
      'transport' => 'postMessage',
      'type' => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
  ));

  // Control for header and footer background color
  $wp_customize->add_control(
      new WP_Customize_Color_Control(
          $wp_customize,
          'theme_bg_color', array(
              'label' => __( 'Header and footer background color', 'pariscores' ),
              'section' => 'colors',
              'settings' => 'theme_bg_color'
          )
      )    
  );
  
  // Setting for footer widgets background color
  $wp_customize->add_setting( 'footer_widgets_bg_color', array(
      'default' => '#8b0000',
      'transport' => 'postMessage',
      'type' => 'theme_mod',
      'sanitize_callback' => 'sanitize_hex_color',
  ));

  // Control for footer widgets background color
  $wp_customize->add_control(
      new WP_Customize_Color_Control(
          $wp_customize,
          'footer_widgets_bg_color', array(
              'label' => __( 'Footer widgets background color', 'pariscores' ),
              'section' => 'colors',
              'settings' => 'footer_widgets_bg_color'
          )
      )    
  );
  
  // Create interactive color setting
	$wp_customize->add_setting( 'interactive_color' , 
		array(
			'default'			=> '#eb4646',
			'transport'			=> 'postMessage',
			'type'				=> 'theme_mod',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage',
		)
	);
	
	// Add the controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'interactive_color', array(
				'label'		=> __( 'Interactive color (links etc)', 'pariscores' ),
				'section'	=> 'colors',
				'settings'	=> 'interactive_color'
			)
		)
	);
  
  // Add option to select index content
	$wp_customize->add_section( 'theme_options',
		array(
			'title'			=> __( 'Theme Options', 'pariscores' ),
			'priority'		=> 95,
			'capability'	=> 'edit_theme_options',
			'description'	=> __( 'Change how much of a post is displayed on index and archive pages.', 'pariscores' )
		)
	);

	// Create excerpt or full content settings
	$wp_customize->add_setting(	'length_setting',
		array(
			'default'			=> 'excerpt',
			'type'				=> 'theme_mod',
			'sanitize_callback' => 'pariscores_sanitize_length', // Sanitization function appears further down
			'transport'			=> 'postMessage'
		)
	);

	// Add the controls
	$wp_customize->add_control(	'pariscores_length_control',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Index/archive displays', 'pariscores' ),
			'section'	=> 'theme_options',
			'choices'	=> array(
				'excerpt'		=> __( 'Excerpt (default)', 'pariscores' ),
				'full-content'	=> __( 'Full content', 'pariscores' )
			),
			'settings'	=> 'length_setting' // Matches setting ID from above
		)
	);


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'pariscores_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'pariscores_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'pariscores_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pariscores_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pariscores_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pariscores_customize_preview_js() {
	wp_enqueue_script( 'pariscores-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pariscores_customize_preview_js' );

/**
 * Sanitize length options:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (excerpt).
 */

function pariscores_sanitize_length( $value ) {
    if ( ! in_array( $value, array( 'excerpt', 'full-content' ) ) ) {
        $value = 'excerpt';
	}
    return $value;
}

if ( ! function_exists( 'pariscores_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see pariscores_custom_header_setup().
	 */
	function pariscores_header_style() {
		$header_text_color = get_header_textcolor();
    $header_bg_color = get_theme_mod( 'theme_bg_color');
    $interactive_color = get_theme_mod('interactive_color');
    $footer_widget_bg_color = get_theme_mod('footer_widgets_bg_color');

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) != $header_text_color ) {
		

      // If we get this far, we have custom styles. Let's do this.
      ?>
      <style type="text/css">
      <?php
      // Has the text been hidden?
      if ( ! display_header_text() ) :
      ?>
        .site-title,
        .site-description {
          position: absolute;
          clip: rect(1px, 1px, 1px, 1px);
        }
      <?php
        // If the user has set a custom color for the text use that.
        else :
      ?>
        .site-title a,
        .site-description {
          color: #<?php echo esc_attr( $header_text_color ); ?>;
        }
      <?php endif; ?>
      .main-navigation a,
			button.dropdown-toggle,
			.menu-toggle,
			.site-footer,
			.site-footer a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			.menu-toggle,
			.custom-logo-link:focus > img, .custom-logo-link:hover > img {
				outline-color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			button.menu-toggle:hover,
			button.menu-toggle:focus {
				color: <?php echo esc_attr( $header_bg_color ); ?>;
				background-color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
      </style>
      <?php
    }
    
    /*
	 * Do we have a custom header background color?
	 */
    
    if( '#002254' != $header_bg_color ) { ?>
      
      <style type="text/css">
        .site-header,
        .site-footer {
          background-color: <?php echo esc_attr( $header_bg_color ); ?>;
        }
      </style>
      <?php      
    }
     /*
	 * Do we have a custom footer widget background color?
	 */
    
    if( '#8b0000' != $footer_widget_bg_color ) { ?>
      
      <style type="text/css">
        .footer-widgets {
          background-color: <?php echo esc_attr( $footer_widget_bg_color ); ?>;
        }
      </style>
      <?php      
    }
  /*
	 * Do we have a custom interactive color?
	 */
	if ( '#eb4646' != $interactive_color ) { ?>
		<style type="text/css">
			a:hover,
      a:focus,
      a:active,
      .site-title a:hover, .site-title a:focus,
      .main-navigation a:hover,
      .main-navigation a:focus,
      .main-navigation .current_page_item > a,
      .main-navigation .current-menu-item > a,
      .main-navigation .current_page_ancestor > a,
      .main-navigation .current-menu-ancestor > a,
      .page-content a:focus, .page-content a:hover,
      .entry-content a:focus,
      .entry-content a:hover,
      .entry-summary a:focus,
      .entry-summary a:hover,
      .comment-content a:focus,
      .comment-content a:hover,
      .comment-meta a:hover, .comment-meta a:focus,
      .comment-form a:hover,
      .comment-form a:focus,
      .pagination .current,
      .comment-awaiting-moderation,
      .site-footer a:hover, .site-footer a:focus,
      .widget_calendar a,
      .cat-links a {
				color: <?php echo esc_attr( $interactive_color ); ?>;
			}
			
			button:hover, button:active, button:focus,
      input[type="button"]:hover,
      input[type="button"]:active,
      input[type="button"]:focus,
      input[type="reset"]:hover,
      input[type="reset"]:active,
      input[type="reset"]:focus,
      input[type="submit"]:hover,
      input[type="submit"]:active,
      input[type="submit"]:focus,
      .page-content a,
      .entry-content a,
      .entry-summary a,
      .comment-content a,
      .edit-link a:hover, .edit-link a:focus,
      .comment-navigation a:hover,
      .comment-navigation a:focus,
      .posts-navigation a:hover,
      .posts-navigation a:focus,
      .post-navigation a:hover,
      .post-navigation a:focus,
      .paging-navigation a:hover,
      .paging-navigation a:focus,
      .post-navigation .post-title,
      .reply a:hover, .reply a:focus,
      .bypostauthor .avatar,
      .comment-form .form-submit input:hover,
      .comment-form .form-submit input:focus {
				border-color: <?php echo esc_attr( $interactive_color ); ?>;
			}
			
			button:hover, button:active, button:focus,
      input[type="button"]:hover,
      input[type="button"]:active,
      input[type="button"]:focus,
      input[type="reset"]:hover,
      input[type="reset"]:active,
      input[type="reset"]:focus,
      input[type="submit"]:hover,
      input[type="submit"]:active,
      input[type="submit"]:focus,
      .edit-link a:hover, .edit-link a:focus,
      .comment-navigation a:hover,
      .comment-navigation a:focus,
      .posts-navigation a:hover,
      .posts-navigation a:focus,
      .post-navigation a:hover,
      .post-navigation a:focus,
      .paging-navigation a:hover,
      .paging-navigation a:focus,
      .pagination a:focus, .pagination a:hover,
      .search .page-content,
      .error-404 .page-content,
      .read-more a:focus, .read-more a:hover,
      .reply a:hover, .reply a:focus,
      .comment-form .form-submit input:hover,
      .comment-form .form-submit input:focus {
				background-color: <?php echo esc_attr( $interactive_color ); ?>;
			}
			
			@media screen and (min-width: 900px) {
				.no-sidebar .post-content__wrap .entry-meta a:hover, 
				.no-sidebar .post-content__wrap .entry-meta a:focus {
					border-color: <?php echo esc_attr( $interactive_color ); ?>;
				}
			}
		</style>
	<?php
	} 
 }
 endif;

