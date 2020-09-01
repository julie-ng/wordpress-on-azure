<?php
/**
 *
 * @package Airi
 */
?>

	<?php 
	//Return if the first widget area has no widgets
	if ( !is_active_sidebar( 'footer-1' ) ) {
		return;
	} ?>

	<?php //Set widget areas classes based on user choice

		$airi_widget_areas = get_theme_mod('footer_widget_areas', '4');

		if ($airi_widget_areas == '4') {
			$airi_footer_cols = 'col-md-3';		
		} elseif ($airi_widget_areas == '3') {
			$airi_footer_cols = 'col-md-4';
		} elseif ($airi_widget_areas == '2') {
			$airi_footer_cols = 'col-md-6';
		} else {
			$airi_footer_cols = 'col-md-12';
		}
	?>

	<div id="sidebar-footer" class="footer-widgets" role="complementary">
		<div class="container">
			<div class="row">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="sidebar-column <?php echo $airi_footer_cols; ?>">
					<?php dynamic_sidebar( 'footer-1'); ?>
				</div>
			<?php endif; ?>	
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="sidebar-column <?php echo $airi_footer_cols; ?>">
					<?php dynamic_sidebar( 'footer-2'); ?>
				</div>
			<?php endif; ?>	
			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="sidebar-column <?php echo $airi_footer_cols; ?>">
					<?php dynamic_sidebar( 'footer-3'); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
				<div class="sidebar-column <?php echo $airi_footer_cols; ?>">
					<?php dynamic_sidebar( 'footer-4'); ?>
				</div>
			<?php endif; ?>		
			</div>	
		</div>	
	</div>