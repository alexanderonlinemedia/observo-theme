<header class="entry-header">

<?php
	//Check for Featured Image
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
		printf(
			'<div class="featured-image" style="background-image: -webkit-linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba( 0, 0, 0, 1) ), url(%1$s);  background-image: -moz-linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba( 0, 0, 0, 1) ), url(%1$s);  background-image: -ms-linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba( 0, 0, 0, 1) ), url(%1$s);  background-image: -o-linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba( 0, 0, 0, 1) ), url(%1$s); background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5), rgba( 0, 0, 0, 1) ), url(%1$s);background-position: center center; background-size: cover;">
				<h1 class="entry-title">%2$s</h1>
			</div><!-- .featured-image -->',
			esc_url($thumb_url[0]),
			get_the_title()
		);
	}
?>

</header><!-- .entry-header -->