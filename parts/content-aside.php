<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-header">
			<div class="entry-meta">
				<?php observo_posted_on(); ?>
			</div><!-- .entry-meta -->
		</div>

		<div class="entry-content">
			<?php 
				the_content(); 
			?>
		</div><!-- .entry-content -->

	
</article><!-- #post-## -->