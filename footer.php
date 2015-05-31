<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package observo
 */
?>

	</div><!-- #content -->

	<footer id="site-footer" class="site-footer" role="contentinfo">

		<div class="site-info">
			<?php printf( __( 'Designed by <a href="%s" rel="designer">WordSkins.com</a>', 'observo' ), esc_url( __( 'http://www.wordskins.com/', 'observo' ) ) ); ?>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'observo' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'observo' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->

	</footer><!-- #site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>