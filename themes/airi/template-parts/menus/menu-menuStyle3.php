<?php
/**
 * Template part for Extended 1 menu style
 *
 * @package Airi
 */


$airi_options	= airi_get_extended1_options();
$airi_container = airi_menu_container();
?>

<header id="masthead" class="site-header">
	
	<div class="top-bar">
		<div class="<?php echo esc_attr( $airi_container ); ?>">
			<div class="col-md-12">
				<div class="row">
					<div class="contact-item">
						<i class="fa fa-envelope"></i><a href="mailto:<?php echo antispambot( $airi_options['email_address'] ); ?>"><?php echo antispambot( $airi_options['email_address'] ); ?></a>
					</div>
					<div class="contact-item">
						<i class="fa fa-phone"></i><a href="tel:<?php echo esc_attr( $airi_options['phone_number'] ); ?>"><?php echo esc_html( $airi_options['phone_number'] ); ?></a>
					</div>
					<div class="header-social contact-item">
						<?php foreach ( $airi_options['header_social'] as $airi_social ) : ?>
							<a target="_blank" href="<?php echo esc_url( $airi_social['link_url'] ); ?>"><i class="fa <?php echo esc_attr( $airi_social['icon'] ); ?>"></i></a>
						<?php endforeach; ?>
					</div>
					<div class="contact-item header-cta">
						<a class="button" href="<?php echo esc_url( $airi_options['cta_url'] ); ?>"><?php echo esc_html( $airi_options['cta_text'] ); ?></a>
					</div>	
				</div>				
			</div>
		</div>				
	</div>

	<div class="bottom-bar">
		<div class="<?php echo esc_attr( $airi_container ); ?>">
			<div class="row">

				<div class="site-branding col-md-3 col-sm-6 col-9">
					<?php airi_site_branding(); ?>
				</div><!-- .site-branding -->
				
				<div class="header-mobile-menu col-md-9 col-sm-6 col-3">
					<button class="mobile-menu-toggle" aria-controls="primary-menu">
						<span class="mobile-menu-toggle_lines"></span>
						<span class="sr-only"><?php esc_html_e( 'Toggle mobile menu', 'airi' ); ?></span>
					</button>
				</div>

				<div class="col-md-9">
					<nav id="site-navigation" class="main-navigation">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
					</nav><!-- #site-navigation -->
				</div>

			</div>
		</div>
	</div>

</header><!-- #masthead -->













