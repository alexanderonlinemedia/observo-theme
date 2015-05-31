<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php get_template_part( 'parts/featured-image-header' ); ?>

	<?php
	//Check for Featured Image
	if ( has_post_thumbnail() ) {
		printf(
			'<div class="entry-thumbnail">%1$s</div>',
			get_the_post_thumbnail($post->ID, 'full' )
		);
	}
	?>

	<div class="entry-content">

		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php observo_posted_on(); ?>
		</div>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'observo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'parts/sharing' ); ?>

	<?php observo_entry_footer(); ?>
</article><!-- #post-## -->
