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
      <?php  the_post_thumbnail(); ?>
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
         
      <?php pariscores_post_navigation(); ?>
      
      <?php 
/**      $orig_post = $post; 
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 2, // Number of related posts that will be shown.
'ignore_sticky_posts'=>1,
'orderby'>'rand'
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
echo '<div id="related_posts"><h3>Related Posts</h3><ul>';
while( $my_query->have_posts() ) {
$my_query->the_post();?>
<li><div class="relatedthumb"><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></div>
<div class="relatedcontent">
<h3><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<?php the_time('M j, Y') ?>
</div>
</li>
<?php
}
echo '</ul></div>';
}
}
$post = $orig_post;
wp_reset_query(); 
 * 
 */
?>

<?php

        // If comments are open or we have at least one comment, load up the comment template.
        
        
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif; 
        ?>
  </section><!-- .post-content -->
  <?php get_sidebar(); ?>
  
</article><!-- #post-<?php the_ID(); ?> -->
