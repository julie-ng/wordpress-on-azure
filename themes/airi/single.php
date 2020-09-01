<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Airi
 */

get_header();

$layout = airi_single_layout();
?>

	<div id="primary" class="content-area <?php echo esc_attr( $layout['type'] ); ?> <?php echo esc_attr( $layout['cols'] ); ?>">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();
			$single_layout = get_theme_mod( 'single_post_content_layout', 'layout-default' );

			if ( 'layout-default' == $single_layout )
			{
				get_template_part( 'template-parts/content', 'single' );
			}
			elseif ( 'layout-2' == $single_layout )
			{
				get_template_part( 'template-parts/content-single', '2' );
			}
			elseif ( 'layout-3' == $single_layout )
			{
				get_template_part( 'template-parts/content-single', '3' );
			}
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( $layout['sidebar'] ) {
	get_sidebar();
}
get_footer();
