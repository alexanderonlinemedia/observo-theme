<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-info full-width">

		<div class="entry-header">
			<?php
				printf(
					'<h1 class="entry-title"><a href="%1$s">%2$s</a></h1>',
					get_the_permalink($post->ID),
					get_the_title()
				);
			?>

			<div class="entry-meta">
				<?php observo_posted_on(); ?>
			</div><!-- .entry-meta -->
		</div><!-- .entry-header -->

		<div class="entry-content">
			<?php 
				the_excerpt(); 
				printf( 
				__( '<div class="read-more"><a href="%s">Watch</a></div>', 'breakaway'),
				esc_url( get_permalink() ) 
				);
			?>
		</div><!-- .entry-content -->
		
	</div>
	
</article><!-- #post-## -->