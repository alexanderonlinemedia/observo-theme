<?php
/**
 * @package observo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'parts/featured-image-header' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'observo' ),
				'after'  => '</div>',
			) );
		?>

		

		<div class="sitemap">
			<h2>Pages</h2>
			<ul>
			<?php wp_list_pages('title_li='); ?>
			</ul>

			<h2>Recent Posts</h2>
			<ul>
			<?php
				$recent_posts = wp_get_recent_posts('posts_per_page=20');
				foreach( $recent_posts as $recent ){
					echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
				}
			?>
			</ul>

			<h2>Authors</h2>
			<ul>
				<?php wp_list_authors(); ?>
			</ul>

			<h2>Categories</h2>
			<ul>
				<?php wp_list_categories(); ?>
			</ul>

			<h2>Archives</h2>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
			</ul>
		</div>
	</div><!-- .entry-content -->

	<?php observo_entry_footer(); ?>
</article><!-- #post-## -->
