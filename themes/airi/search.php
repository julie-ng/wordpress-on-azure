<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Airi
 */

get_header();

$layout = airi_blog_layout();
?>

	<section id="primary" class="content-area <?php echo esc_attr( $layout['type'] ); ?> <?php echo esc_attr( $layout['cols'] ); ?>">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header col-md-12 mb30">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'airi' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<div class="blog-loop" <?php echo airi_masonry_data(); ?>>
				<div class="row">
				<div class="grid-sizer"></div>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; ?>

				</div>
			</div>			
			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
if ( $layout['sidebar'] ) {
	get_sidebar();
}
get_footer();
