<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package observo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area fadeInOnPageLoad">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'observo' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'observo' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'observo' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'observo' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'type'      	=> 'pings',
					'style'      	=> 'ul',
					'short_ping' 	=> true,
				) );
			?>
			<?php
				wp_list_comments( array(
					'type'      	=> 'comment',
					'style'      	=> 'ul',
					'short_ping' 	=> true,
					'avatar_size'	=> 75,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'observo' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'observo' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'observo' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php else: // No comments to load ?>
		<h2 class="comments-title">
			<?php _e('0 Comments', 'observo'); ?>
		</h2>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'observo' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
