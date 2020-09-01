<?php
/**
 * Theme info page
 *
 * @package Airi
 */

/**
 * Recommended plugins
 */
require get_template_directory() . '/inc/onboarding/plugins/class-airi-recommended-plugins.php'; 

//Add the theme page
add_action('admin_menu', 'airi_add_theme_info');
function airi_add_theme_info(){

	if ( !current_user_can('install_plugins') ) {
		return;
	}

	$theme_info = add_theme_page( __('Airi Info','airi'), __('Airi Info','airi'), 'manage_options', 'airi-info.php', 'airi_info_page' );
	add_action( 'load-' . $theme_info, 'airi_info_hook_styles' );
}

//Callback
function airi_info_page() {
	$user = wp_get_current_user();
?>
	<div class="info-container">
		<p class="hello-user"><?php echo sprintf( __( 'Hello, %s,', 'airi' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></p>
		<h1 class="info-title"><?php echo __( 'Welcome to Airi', 'airi' ); ?><span class="info-version"><?php echo 'v' . esc_html( wp_get_theme()->version ); ?></span></h1>
		<p class="welcome-desc"><?php _e( 'Airi is now installed and ready to go. To help you with the next step, we’ve gathered together on this page all the resources you might need. We hope you enjoy using Airi. You can always come back to this page by going to <strong>Appearance > Airi Info</strong>.', 'airi' ); ?>
	

		<div class="airi-theme-tabs">

			<div class="airi-tab-nav nav-tab-wrapper">
				<a href="#begin" data-target="begin" class="nav-button nav-tab begin active"><?php esc_html_e( 'Getting started', 'airi' ); ?></a>
				<a href="#support" data-target="support" class="nav-button support nav-tab"><?php esc_html_e( 'Support', 'airi' ); ?></a>
				<a href="#table" data-target="table" class="nav-button table nav-tab"><?php esc_html_e( 'Free vs Pro', 'airi' ); ?></a>
			</div>

			<div class="airi-tab-wrapper">

				<div id="#begin" class="airi-tab begin show">
					
					<div class="plugins-row">
						<h2><span class="step-number">1</span><?php esc_html_e( 'Install recommended plugins', 'airi' ); ?></h2>
						<p><?php _e( 'Install one plugin at a time. Wait for each plugin to activate.', 'airi' ); ?></p>

						<div style="margin: 0 -15px;overflow:hidden;display:flex;">
							<div class="plugin-block">
								<?php $plugin = 'airi-demo-importer'; ?>
								<h3>Airi Demo Importer</h3>
								<p><?php esc_html_e( 'Airi Demo Importer is a free addon for the Airi WordPress theme. It acts as an interface between the One Click Demo Import plugin and our theme.', 'airi' ); ?></p>
								<?php echo Airi_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>

							<div class="plugin-block">
								<?php $plugin = 'elementor'; ?>
								<h3>Elementor</h3>
								<p><?php esc_html_e( 'Elementor will enable you to create pages by adding widgets to them using drag and drop.', 'airi' ); ?>
								<?php 
								//If Elementor is active, show a link to Elementor's getting started video
								$is_elementor_active = Airi_Recommended_Plugins::instance()->check_plugin_state( $plugin );
								if ( $is_elementor_active == 'deactivate' ) {
									echo '<a target="_blank" href="https://www.youtube.com/watch?v=nZlgNmbC-Cw&feature=emb_title">' . __( 'First time Elementor user?', 'airi') . '</a>';
								}; ?>
								</p>
								<?php echo Airi_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>

							<div class="plugin-block">
								<?php $plugin = 'one-click-demo-import'; ?>
								<h3>One Click Demo Import</h3>
								<p><?php esc_html_e( 'This plugin is useful for importing our demos. You can uninstall it after you\'re done with it.', 'airi' ); ?></p>
								<?php echo Airi_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>
							<div class="plugin-block">
								<?php $plugin = 'kirki'; ?>
								<h3>Kirki</h3>
								<p><?php esc_html_e( 'Kirki is a framework for theme options. You need this plugin to access Airi\'s options.', 'airi' ); ?></p>
								<?php echo Airi_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>															
						</div>
					</div>
					<hr style="margin-top:25px;margin-bottom:25px;">
					
					<div class="import-row">
						<h2><span class="step-number">2</span><?php esc_html_e( 'Import demo content (optional)', 'airi' ); ?></h2>
						<p><?php esc_html_e( 'Importing the demo will make your website look like our website.', 'airi' ); ?></p>
						<?php 
							$plugin = 'airi-demo-importer';
							$is_airi_toolbox_active = Airi_Recommended_Plugins::instance()->check_plugin_state( $plugin );
							$plugin = 'elementor';
							$is_elementor_active = Airi_Recommended_Plugins::instance()->check_plugin_state( $plugin );
							$plugin = 'one-click-demo-import';
							$is_ocdi_active = Airi_Recommended_Plugins::instance()->check_plugin_state( $plugin );	
							$plugin = 'kirki';
							$is_kirki_active = Airi_Recommended_Plugins::instance()->check_plugin_state( $plugin );																					
						?>
							<?php if ( $is_airi_toolbox_active == 'deactivate' && $is_elementor_active == 'deactivate' && $is_ocdi_active == 'deactivate' && $is_kirki_active ==  'deactivate' ) : ?>
								<a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'airi' ); ?></a>
							<?php else : ?>
								<p class="airi-notice"><?php esc_html_e( 'All recommended plugins need to be installed and activated for this step.', 'airi' ); ?></p>
							<?php endif; ?>
					</div>
					<hr style="margin-top:25px;margin-bottom:25px;">

					<div class="customizer-row">
						<h2><span class="step-number">3</span><?php esc_html_e( 'Styling with the Customizer', 'airi' ); ?></h2>
						<p><?php esc_html_e( 'Theme elements can be styled from the Customizer. Use the links below to go straight to the section you want.', 'airi' ); ?></p>		
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=title_tagline' ) ); ?>"><?php esc_html_e( 'Change your site title or add a logo', 'airi' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=airi_section_menu' ) ); ?>"><?php esc_html_e( 'Header options', 'airi' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[panel]=airi_panel_colors' ) ); ?>"><?php esc_html_e( 'Color options', 'airi' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[panel]=airi_panel_typography' ) ); ?>"><?php esc_html_e( 'Font options', 'airi' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[panel]=airi_panel_blog' ) ); ?>"><?php esc_html_e( 'Blog options', 'airi' ); ?></a></p>		
					</div>


				</div>

				<div id="#support" class="airi-tab support">
					<div class="column-wrapper">
						<div class="tab-column">
						<span class="dashicons dashicons-sos"></span>
						<h3><?php esc_html_e( 'Visit our forums', 'airi' ); ?></h3>
						<p><?php esc_html_e( 'Need help? Go ahead and visit our support forums and we\'ll be happy to assist you with any theme related questions you might have', 'airi' ); ?></p>
							<a href="https://forums.athemes.com/c/airi" target="_blank"><?php esc_html_e( 'Visit the forums', 'airi' ); ?></a>				
							</div>
						<div class="tab-column">
						<span class="dashicons dashicons-book-alt"></span>
						<h3><?php esc_html_e( 'Documentation', 'airi' ); ?></h3>
						<p><?php esc_html_e( 'Our documentation can help you learn how to use the theme and also provides you with premade code snippets and answers to FAQs.', 'airi' ); ?></p>
						<a href="https://docs.athemes.com/category/260-airi" target="_blank"><?php esc_html_e( 'See the Documentation', 'airi' ); ?></a>
						</div>
					</div>
				</div>
				<div id="#table" class="airi-tab table">
				<table class="widefat fixed featuresList"> 
				   <thead> 
					<tr> 
					 <td><strong><h3><?php esc_html_e( 'Feature', 'airi' ); ?></h3></strong></td>
					 <td style="width:20%;"><strong><h3><?php esc_html_e( 'Airi', 'airi' ); ?></h3></strong></td>
					 <td style="width:20%;"><strong><h3><?php esc_html_e( 'Airi Pro', 'airi' ); ?></h3></strong></td>
					</tr> 
				   </thead> 
				   <tbody> 
				   <tr> 
					 <td><?php esc_html_e( 'Elementor support', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Access to all Google Fonts', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Responsive', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Parallax backgrounds', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Social Icons', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Custom Elementor blocks', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Translation ready', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Color options', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Blog options', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Widgetized footer', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Background image support', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 	
					<td><?php esc_html_e( 'WooCommerce compatible', 'airi' ); ?></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr>
					<tr> 
					 <td><?php esc_html_e( 'Growing collection of premium demos', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Footer Credits option', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Footer background image', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Extra Elementor blocks (portfolio, shop categories, slider)', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Two extra menu types', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Extra blog layouts (list, masonry)', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Extended WooCommerce options', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
					<tr> 
					 <td><?php esc_html_e( 'Priority support', 'airi' ); ?></td>
					 <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
					 <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
					</tr> 
				   </tbody> 
				  </table>
				  <p style="text-align: right;"><a class="button button-primary button-large" href="https://athemes.com/theme/airi-pro/?utm_source=theme_table&utm_medium=button&utm_campaign=Airi"><?php esc_html_e('View Airi Pro', 'airi'); ?></a></p>
				</div>		
			</div>
		</div>

		<div class="airi-theme-sidebar">
			<div class="airi-sidebar-widget">
				<h3>Review Airi</h3>
				<p><?php echo esc_html__( 'It makes us happy to hear from our users. We would appreciate a review.', 'airi' ); ?> </p>	
				<p><a target="_blank" href="https://wordpress.org/support/theme/airi/reviews/"><?php echo esc_html__( 'Submit a review here', 'airi' ); ?></a></p>		
			</div>
			<hr style="margin-top:25px;margin-bottom:25px;">
			<div class="airi-sidebar-widget">
				<h3>Changelog</h3>
				<p><?php echo esc_html__( 'Keep informed about each theme update.', 'airi' ); ?> </p>	
				<p><a target="_blank" href="https://athemes.com/changelog/airi"><?php echo esc_html__( 'See the changelog', 'airi' ); ?></a></p>		
			</div>	
			<hr style="margin-top:25px;margin-bottom:25px;">
			<div class="airi-sidebar-widget">
				<h3>Upgrade to Airi Pro</h3>
				<p><?php echo esc_html__( 'Take Airi to a whole other level by upgrading to the Pro version.', 'airi' ); ?> </p>	
				<p><a target="_blank" href="https://athemes.com/theme/airi-pro/?utm_source=theme_info&utm_medium=link&utm_campaign=Airi"><?php echo esc_html__( 'Discover Airi Pro', 'airi' ); ?></a></p>		
			</div>									
		</div>
	</div>
<?php
}

//Styles
function airi_info_hook_styles(){
	add_action( 'admin_enqueue_scripts', 'airi_info_page_styles' );
}
function airi_info_page_styles() {
	wp_enqueue_style( 'airi-info-style', get_template_directory_uri() . '/inc/onboarding/assets/info-page.css', array(), true );

	wp_enqueue_script( 'airi-info-script', get_template_directory_uri() . '/inc/onboarding/assets/info-page.js', array('jquery'),'', true );

}