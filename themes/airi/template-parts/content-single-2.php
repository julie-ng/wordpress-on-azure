<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Airi
 */

$layout 		= airi_single_layout();
$hide_thumb 	= get_theme_mod( 'single_hide_thumb' );
$hide_date 		= get_theme_mod( 'single_hide_date' );
$hide_cats 		= get_theme_mod( 'single_hide_cats' );
$hide_author 	= get_theme_mod( 'single_hide_author' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



	<header class="entry-header">
		<?php
			if ( $hide_date == '' ) {
				airi_posted_on();
			}
			the_title( '<h1 class="entry-title">', '</h1>' );

		?>
		<?php
		if ( ( $layout['type'] == 'layout-default' ) && ( $hide_thumb == '' ) )
		{
			if ( has_post_thumbnail() )
			{
				?>
				<div class="thumbnail">
					<?php airi_post_thumbnail(); ?>
					<?php
					if ( $hide_cats == '' ) {
						echo '<span>';
						airi_all_categories();
						echo '</span>';
					}
					?>
				</div>
				<?php
			}
		}
		?>
	</header><!-- .entry-header -->
	<?php
	if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php
		if ( $hide_author == '' ) {
			airi_posted_by();
		}
		?>
	</div><!-- .entry-meta -->
	<?php
	endif; ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'airi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'airi' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php airi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
