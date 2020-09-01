<?php
/**
 * Template part for Extended 2 menu style
 *
 * @package Airi
 */

//Get the options
$airi_above_phone_number = get_theme_mod( 'above_phone_number', esc_html__( 'Call us', 'airi' ) );
$airi_phone_number 		= get_theme_mod( 'phone_number', '999.999.999' );
$airi_above_address		= get_theme_mod( 'above_address', esc_html__( 'Address', 'airi' ) );
$airi_address			= get_theme_mod( 'address_details', esc_html__( 'Brooklyn Street', 'airi' ) );
$airi_above_opening		= get_theme_mod( 'above_opening', esc_html__( 'Opening hours', 'airi' ) );
$airi_opening_hours		= get_theme_mod( 'opening_hours', esc_html__( '9-18 Mon-Fri', 'airi' ) );
$airi_cta_text			= get_theme_mod( 'cta_text_menustyle4', esc_html__( 'Get a quote', 'airi' ) );
$airi_cta_url			= get_theme_mod( 'cta_url_menustyle4', '#' );
?>

<header id="masthead" class="site-header">
	
	<div class="<?php echo esc_attr( airi_menu_container() ); ?>">
		<div class="row">
			<div class="site-branding col-md-4 col-sm-6 col-9">
				<?php airi_site_branding(); ?>
			</div><!-- .site-branding -->

			<div class="header-mobile-menu col-md-8 col-sm-6 col-3">
				<button class="mobile-menu-toggle" aria-controls="primary-menu">
					<span class="mobile-menu-toggle_lines"></span>
					<span class="sr-only"><?php esc_html_e( 'Toggle mobile menu', 'airi' ); ?></span>
				</button>
			</div>			

			<div class="contact-area col-md-8">
				<div class="contact-block">
					<div class="contact-icon">
						<i class="fa fa-phone"></i>
					</div>
					<div class="contact-text">
						<span><?php echo esc_html( $airi_above_phone_number ); ?></span>
						<span><?php echo esc_html( $airi_phone_number ); ?></span>
					</div>
				</div>
				<div class="contact-block">
					<div class="contact-icon">
						<i class="fa fa-map-marker"></i>
					</div>
					<div class="contact-text">
						<span><?php echo esc_html( $airi_above_address ); ?></span>
						<span><?php echo esc_html( $airi_address ); ?></span>
					</div>
				</div>
				<div class="contact-block">
					<div class="contact-icon">
						<i class="fa fa-clock-o"></i>
					</div>
					<div class="contact-text">
						<span><?php echo esc_html( $airi_above_opening ); ?></span>
						<span><?php echo esc_html( $airi_opening_hours ); ?></span>
					</div>
				</div>				
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation col-md-12">			
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>

			<?php airi_header_cart_search(); ?>

			<?php if ( $airi_cta_text ) : ?>
			<div class="header-cta">
				<a href="<?php echo esc_url( $airi_cta_url ); ?>"><?php echo esc_html( $airi_cta_text ); ?></a>
			</div>
			<?php endif; ?>
			<div class="header-search-form">
				<?php get_search_form(); ?>
			</div>
		</nav><!-- #site-navigation -->
	</div>

</header><!-- #masthead -->