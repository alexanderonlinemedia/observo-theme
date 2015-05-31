<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package observo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'observo' ); ?></a>

	<header id="site-header" class="site-header" role="banner">

		<div class="menu-toggle" id="menu-toggle"><a><i class="fa fa-arrow-right"></i></a></div>	

		<div class="site-branding" id="site-branding">
			<?php
			$general_options = get_option( 'observo_general_settings_option' );
			$header_logo = isset($general_options['header_logo']) ? $general_options['header_logo'] : null;
			?>
			<?php if ( $header_logo ) : ?>
			    <div class="site-logo">
			        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></h1>
			    </div>
			<?php else : ?>
			    <div class="site-logo">
			        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/observo-logo.svg" alt=""></a></h1>
			    </div>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="main-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'header', 'depth' => 3 ) ); ?>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			 
			     <div class="widget-area sidebar-1">
			      <?php dynamic_sidebar( 'sidebar-1' ); ?>
			     </div><!-- #sidebar-1 .widget-area -->
			 
			<?php endif; ?>

			<div class="social-icons" id="social-icons">
			<?php
			$show_facebook = isset($general_options['show_facebook']) ? $general_options['show_facebook'] : null;
			$facebook_url = isset($general_options['facebook_url']) ? $general_options['facebook_url'] : null;
			$show_twitter = isset($general_options['show_twitter']) ? $general_options['show_twitter'] : null;
			$twitter_url = isset($general_options['twitter_url']) ? $general_options['twitter_url'] : null;
			$show_google_plus = isset($general_options['show_google_plus']) ? $general_options['show_google_plus'] : null;
			$google_plus_url = isset($general_options['google_plus_url']) ? $general_options['google_plus_url'] : null;
			$show_linkedin = isset($general_options['show_linkedin']) ? $general_options['show_linkedin'] : null;
			$linkedin_url = isset($general_options['linkedin_url']) ? $general_options['linkedin_url'] : null;
			$show_instagram = isset($general_options['show_instagram']) ? $general_options['show_instagram'] : null;
			$instagram_url = isset($general_options['instagram_url']) ? $general_options['instagram_url'] : null;
			$show_pinterest = isset($general_options['show_pinterest']) ? $general_options['show_pinterest'] : null;
			$pinterest_url = isset($general_options['pinterest_url']) ? $general_options['pinterest_url'] : null;
			$show_youtube = isset($general_options['show_youtube']) ? $general_options['show_youtube'] : null;
			$youtube_url = isset($general_options['youtube_url']) ? $general_options['youtube_url'] : null;
			$show_vimeo = isset($general_options['show_vimeo']) ? $general_options['show_vimeo'] : null;
			$vimeo_url = isset($general_options['vimeo_url']) ? $general_options['vimeo_url'] : null;
			$show_dribbble = isset($general_options['show_dribbble']) ? $general_options['show_dribbble'] : null;
			$dribbble_url = isset($general_options['dribbble_url']) ? $general_options['dribbble_url'] : null;
			$show_behance = isset($general_options['show_behance']) ? $general_options['show_behance'] : null;
			$behance_url = isset($general_options['behance_url']) ? $general_options['behance_url'] : null;
			if ($show_facebook) {
				printf( '<a href="%s"><i class="fa fa-facebook social-icon"></i></a>', esc_url( $facebook_url ) );
			}
			if ($show_twitter) {
				printf( '<a href="%s"><i class="fa fa-twitter social-icon"></i></a>', esc_url( $twitter_url ) );
			}
			if ($show_google_plus) {
				printf( '<a href="%s"><i class="fa fa-google-plus social-icon"></i></a>', esc_url( $google_plus_url ) );
			}
			if ($show_linkedin) {
				printf( '<a href="%s"><i class="fa fa-linkedin social-icon"></i></a>', esc_url( $linkedin_url ) );
			}
			if ($show_instagram) {
				printf( '<a href="%s"><i class="fa fa-instagram social-icon"></i></a>', esc_url( $instagram_url ) );
			}
			if ($show_pinterest) {
				printf( '<a href="%s"><i class="fa fa-pinterest social-icon"></i></a>', esc_url( $pinterest_url ) );
			}
			if ($show_youtube) {
				printf( '<a href="%s"><i class="fa fa-youtube social-icon"></i></a>', esc_url( $youtube_url ) );
			}
			if ($show_vimeo) {
				printf( '<a href="%s"><i class="fa fa-vimeo-square social-icon"></i></a>', esc_url( $vimeo_url ) );
			}
			if ($show_dribbble) {
				printf( '<a href="%s"><i class="fa fa-dribbble social-icon"></i></a>', esc_url( $dribbble_url ) );
			}
			if ($show_behance) {
				printf( '<a href="%s"><i class="fa fa-behance social-icon"></i></a>', esc_url( $behance_url ) );
			}
			?>
			</div>
		</nav><!-- #main-navigation -->
	</header><!-- #masthead -->

	<div id="site-content" class="site-content">
