<?php
/**
 * Enqueue scripts and styles.
 */
function observo_scripts() {
	wp_enqueue_style( 'observo-style', get_stylesheet_uri() );

	wp_enqueue_script( 'observo-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '20141205', true );

	wp_enqueue_script( 'observo-animation', get_template_directory_uri() . '/js/animation-dist.js', array('jquery', 'jquery-color', 'jquery-effects-slide'), '20141205', true );

	wp_enqueue_script( 'observo-gallery-grid', get_template_directory_uri() . '/js/gallery-grid-dist.js', array(), '20150506', true );

	wp_enqueue_script( 'observo-nice-scroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), '20150506', true );

	wp_enqueue_script( 'observo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'observo-retina-js', get_template_directory_uri() . '/js/retina.min.js', array(), '20150407', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'observo_scripts' );