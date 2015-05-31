<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package observo
 */

get_header(); ?>

	<div id="primary" class="content-area index">
		<main id="main" class="site-main" role="main">

		<div class="card-gallery" id="card-gallery">
			
			<?php
			$type = 'projects';
			$args=array(
			  	'post_type' => $type,
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'ignore_sticky_posts'=> 1
			);

			$my_query = null;
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
			    while ($my_query->have_posts()) : $my_query->the_post();
				    $thumb_id = get_post_thumbnail_id();
				    $thumb_url_array = wp_get_attachment_image_src($thumb_id, array(850,850), true);
				    $thumb_url = $thumb_url_array[0];
			?>
				<a href="<?php echo get_the_permalink(); ?>">
					<div class="card">
						<div class="card-front" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
						<div class="card-back">
							<div class="card-text">
								<?php echo get_the_title(); ?>
							</div>
						</div>
					</div>
				</a>
			<?php
			    endwhile;
			}
			wp_reset_query();
			?>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>