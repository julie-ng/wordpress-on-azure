<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Airi
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<?php
$sidebar_col = 'col-lg-4';
$layout 		= airi_blog_layout();
if ( $layout['type'] == 'layout-list-2' || $layout['type'] == 'layout-two-columns' )
{
	$sidebar_col = 'col-lg-3';
}
?>
<aside id="secondary" class="widget-area <?php echo esc_attr( $sidebar_col );?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
