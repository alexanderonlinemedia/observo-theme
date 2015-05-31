<?php
/**
 * observo Theme Customizer
 *
 * @package observo
 */

/**
 * Add postMessage support for site title, description, header and background colors for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */



if ( ! function_exists( 'observo_customize_register' ) ) :

	function observo_customize_register( $wp_customize ) {

		//Setup Fonts Section
		$wp_customize->add_section( 'observo_fonts' , array(
		    'title'      => __( 'Fonts', 'observo' ),
		    'priority'   => 30,
		) );
		//Setup Headers Font Setting
		$wp_customize->add_setting( 'headers_font' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
		    'sanitize_callback' => 'observo_sanitize_font_code',
		) );
		$wp_customize->add_control( 
			'observo_headers_font_control',
			array(
				'label'        => __( 'Headers Font', 'observo' ),
				'section'    => 'observo_fonts',
				'settings'   => 'headers_font',
				'type'		=> 'textarea',																		
		) );

		//Setup Body Font Setting
		$wp_customize->add_setting( 'body_font' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
		    'sanitize_callback' => 'observo_sanitize_font_code',
		) );
		$wp_customize->add_control( 
			'observo_body_font_control',
			array(
				'label'        => __( 'Body Font', 'observo' ),
				'section'    => 'observo_fonts',
				'settings'   => 'body_font',
				'type'		=> 'textarea',																		
		) );

		//Setup Colors Setting
		$wp_customize->add_setting( 'main_accent_color' , array(
		    'default'     => '#E58824',
		    'transport'   => 'refresh',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
				$wp_customize, 
				'observo_main_accent_color',
				array(
					'label'        => __( 'Main Accent Color', 'observo' ),
					'section'    => 'colors',
					'settings'   => 'main_accent_color',
				)
		) );
		
	}

endif; //end observo_customize_register
add_action( 'customize_register', 'observo_customize_register' );


if ( ! function_exists( 'observo_sanitize_font_code' ) ) :

	function observo_sanitize_font_code( $input ) {
		return wp_kses( $input, array(
			'link' => array(
				'href' => array(),
				'rel' => array(),
				'type' => array()
			)
		));
	}

endif; //end observo_sanitize_font_code


if ( ! function_exists( 'observo_customize_add_head_style' ) ) :

	function observo_customize_add_head_style() {
		//Headers Font Prep
		$headersFontCode = get_theme_mod('headers_font');
		$headersFontNameWorking = str_replace('<link href=\'http://fonts.googleapis.com/css?family=', '', $headersFontCode);
		$headersFontNameWorking = explode(':', $headersFontNameWorking);
		$headersFontNameWorking = explode('\'', $headersFontNameWorking[0]);
		$headersFontFamily = str_replace('+', ' ', $headersFontNameWorking[0]);

		//Body Font Prep
		$bodyFontCode = get_theme_mod('body_font');
		$bodyFontNameWorking = str_replace('<link href=\'http://fonts.googleapis.com/css?family=', '', $bodyFontCode);
		$bodyFontNameWorking = explode(':', $bodyFontNameWorking);
		$bodyFontNameWorking = explode('\'', $bodyFontNameWorking[0]);
		$bodyFontFamily = str_replace('+', ' ', $bodyFontNameWorking[0]);

		if($headersFontCode !== '') {
			echo $headersFontCode . PHP_EOL;
		}

		if($bodyFontCode !== '') {
			echo $bodyFontCode . PHP_EOL;
		}

		?>
<style type="text/css" media="screen">
<?php
if($bodyFontFamily !== '') {
?>
body, 
.site .site-content .comments-area,
.site .site-content #ws-contact-form,
.site .site-info {
	font-family: '<?php echo $bodyFontFamily; ?>';
}
<?php
}
if($headersFontFamily !== '') {
?>
h1, h2, h3, h4, h5, h6,
.site .site-header .main-navigation,
.home .page-header .page-title,
.archive .page-header .page-title,
.blog .page-header .page-title,
.search .page-header .page-title,
.error404 .page-header .page-title {
	font-family: '<?php echo $headersFontFamily; ?>';
}
<?php
}
$mainAccentColor = get_theme_mod('main_accent_color');
if($mainAccentColor !== '') {
?>
.site a,
.site a:visited,
.site a:hover,
.site a:focus,
.site a:active,
.site .site-header .menu-toggle a,
.site .site-content .nav-links .nav-previous a,
.site .site-content .nav-links .nav-next a {
	color: <?php echo $mainAccentColor; ?>;
}

.site .site-content .card-gallery .card .card-back,
.site .site-content .nav-links .nav-previous a:hover,
.site .site-content .nav-links .nav-next a:hover,
.site .site-content .comments-area .comment-list .reply a:hover,
.site .site-content .comments-area .comment-respond .comment-form .form-submit input.submit,
.site .site-content .comments-area .comment-respond .comment-form .form-submit input.submit:hover,
.site .site-content #ws-contact-form .contact-row .contact-submit-button,
.site .site-content #ws-contact-form .contact-row .contact-submit-button:hover,
.home .post .entry-content .read-more a:hover,
.archive .post .entry-content .read-more a:hover,
.blog .post .entry-content .read-more a:hover,
.search .post .entry-content .read-more a:hover,
.error404 .post .entry-content .read-more a:hover {
	background-color: <?php echo $mainAccentColor; ?>;
}

.site .site-header .menu-toggle a,
.site .site-content .nav-links .nav-previous a:hover,
.site .site-content .nav-links .nav-next a:hover,
.site .site-content .comments-area .comment-navigation a:hover,
.site .site-content .comments-area .comment-list .reply a:hover,
.home .post .entry-content .read-more a:hover,
.archive .post .entry-content .read-more a:hover,
.blog .post .entry-content .read-more a:hover,
.search .post .entry-content .read-more a:hover,
.error404 .post .entry-content .read-more a:hover {
	border-color: <?php echo $mainAccentColor; ?>;
}
<?php
}
?></style><?php
	echo PHP_EOL;
	// }
}
endif; //end observo_customize_add_head_style
add_action( 'wp_head', 'observo_customize_add_head_style');