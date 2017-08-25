<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pariscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<header class="entry-header">
    <?php pariscores_the_category_list(); ?>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="entry-meta">
			<?php pariscores_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->  
  
  <?php
  if ( has_post_thumbnail() )  { ?>
    <figure class="featured-image centered-image">
      <?php  the_post_thumbnail() ?>
    </figure>
  <?php } ?>
  
  <section class="post-content">
    <?php
  	if ( !is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div class="post-content__wrap">
      
      <div class="entry-meta">
        <?php pariscores_posted_on(); ?>
      </div><!-- .entry-meta -->
      <div class="post-content__body">
        <?php
        endif; ?>  
        <div class="entry-content">
          <?php
            the_content( sprintf(
              wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pariscores' ),
                array(
                  'span' => array(
                    'class' => array(),
                  ),
                )
              ),
              get_the_title()
            ) );

            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pariscores' ),
              'after'  => '</div>',
            ) );
          ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
          <?php pariscores_entry_footer(); ?>
        </footer><!-- .entry-footer -->
        
         <?php
        if ( !is_active_sidebar( 'sidebar-1' ) ) : ?>
      </div><!-- .post-content__body -->
     </div><!-- .post-content__wrap -->
     <?php endif; ?>
    
      <?php pariscores_post_navigation();

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif; 
        ?>
  </section><!-- .post-content -->
  <?php get_sidebar(); ?>
  
</article><!-- #post-<?php the_ID(); ?> -->
