<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">			
<?php
if(!$post->post_parent){
	// will display the subpages of this top level page
	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
	$titlenamer = get_the_title($post->post_parent);
}
else{

	if($post->ancestors) {
		// now you can get the the top ID of this page
		// wp is putting the ids DESC, thats why the top level ID is the last one
		$ancestors = end($post->ancestors);
		$titlenamer = get_the_title(end($post->ancestors));
		$children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0");
	}
}
  if ($children) { ?>

<nav id="sub-pages" class="widget">
  <h3 class="widget-title"> <?php echo $titlenamer; ?> </h3>
  <ul>
  <?php echo $children; ?>
  </ul>
</nav>

<?php } ?>
				<?php if ( ! $children ) : ?>		
							<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
								<aside id="archives" class="widget">
									<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
									<ul>
										<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
									</ul>
								</aside>

								<aside id="meta" class="widget">
									<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
									<ul>
										<?php wp_register(); ?>
										<li><?php wp_loginout(); ?></li>
										<?php wp_meta(); ?>
									</ul>
								</aside>

							<?php endif; // end sidebar widget area ?>
				<?php endif; // children ?>			
		</div><!-- #secondary .widget-area -->
<?php endif; ?>