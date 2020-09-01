<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package airi
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function airi_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'airi_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function airi_woocommerce_scripts() {
	wp_enqueue_style( 'airi-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'airi-woocommerce-style', $inline_font );
}
//add_action( 'wp_enqueue_scripts', 'airi_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function airi_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'airi_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function airi_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'airi_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function airi_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'airi_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function airi_woocommerce_loop_columns() {
	return 5;
}
add_filter( 'loop_shop_columns', 'airi_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function airi_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'airi_woocommerce_related_products_args' );

if ( ! function_exists( 'airi_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function airi_woocommerce_product_columns_wrapper() {
		$columns = airi_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'airi_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'airi_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function airi_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'airi_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'airi_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function airi_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'airi_woocommerce_wrapper_before' );

if ( ! function_exists( 'airi_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function airi_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'airi_woocommerce_wrapper_after' );

if ( ! function_exists( 'airi_woocommerce_cart_link_fragment' ) ) {
	/**
	 * cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function airi_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		airi_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'airi_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'airi_woocommerce_cart_link' ) ) {
	/**
	 * cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function airi_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'airi' ); ?>">
			<i class="fa fa-shopping-bag"></i><span class="count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

/**
 * Returns true if current page is shop, product archive or product tag
 */
function airi_wc_archive_check() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Remove sidebar
 */
function airi_remove_wc_sidebar_archives() {
    $archive_check = airi_wc_archive_check();
    $shop_layout   = get_theme_mod( 'shop_layout', 'shop-grid' );

    if ( ( $shop_layout == 'shop-grid' && $archive_check ) || ( is_product() ) ) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }   
}
add_action( 'wp', 'airi_remove_wc_sidebar_archives' );

/**
 * Remove page title from archives
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Remove headings from single product tabs
 */
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

/**
 * Change breadcrumb separator and remove non-breaking spaces
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'airi_change_wc_breadcrumb_sep' );
function airi_change_wc_breadcrumb_sep( $defaults ) {
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}