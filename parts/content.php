<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	//Check for Featured Image
	if ( has_post_thumbnail() ) {
		printf(
			'<div class="entry-thumbnail"><a href="%1$s">%2$s</a></div>',
			get_the_permalink($post->ID),
			get_the_post_thumbnail($post->ID, 'full' )
		);
	}
	?>

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
			'<div class="read-more"><a href="%1$s">%2$s</a></div>',
			esc_url( get_permalink() ),
			__('Continue Reading', 'observo')
			);
		?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->