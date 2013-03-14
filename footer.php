<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->


	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>

		<!--	<div id="site-generator">
				<?php //do_action( 'twentyeleven_credits' ); ?>
				
			</div> -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/../twentyeleven/style.css" />		
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri() ?>/js/respond.min.js'></script>
<![endif]-->

<?php
if ( function_exists( 'yoast_analytics' ) ) { 
  yoast_analytics(); 
}
?>

</body>
</html>