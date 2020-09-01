<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Airi
 */

get_header();
$layout = airi_blog_layout();
?>

	<div id="primary" class="content-area <?php echo esc_attr( $layout['type'] ); ?> <?php echo esc_attr( $layout['cols'] ); ?>">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header col-md-12 mb30">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			<div class="blog-loop" <?php echo airi_masonry_data(); ?>>
				<div class="row">
					<div class="grid-sizer"></div>
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						if	( 'layout-list-2' == $layout['type'] )
						{
							get_template_part( 'template-parts/content-list', '2' );
						}
						else if	( 'layout-two-columns' == $layout['type'] )
						{
							get_template_part( 'template-parts/content-two', 'columns' );
						}
						else
						{
							get_template_part( 'template-parts/content', get_post_type() );
						}

					endwhile; ?>
				</div>
			</div>
			
			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( $layout['sidebar'] ) {
	get_sidebar();
}
get_footer();
