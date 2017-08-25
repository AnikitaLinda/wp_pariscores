<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pariscores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
    
    <nav class="social-menu">
    	<?php	wp_nav_menu( array( 'theme_location' => 'social' ) );	?>
    </nav>
    
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'pariscores' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'pariscores' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'pariscores' ), 'pariscores', '<a href="http://underscores.me/">Anika Weltermann</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
