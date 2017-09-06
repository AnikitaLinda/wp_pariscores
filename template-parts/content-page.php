<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pariscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
  
   <?php
  if ( has_post_thumbnail() )  { ?>
    <figure class="featured-image centered-image">
      <?php  the_post_thumbnail(); ?>
    </figure>
  <?php } ?>

	<div class="entry-content post-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pariscores' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content .post-content-->
    
  <?php
    get_sidebar( 'page' );
  ?>
</article><!-- #post-<?php the_ID(); ?> -->
