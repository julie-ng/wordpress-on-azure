<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Airi
 */

$airi_layout 	= airi_blog_layout();
$airi_read_more 		= get_theme_mod( 'read_more_text', __( 'Read more', 'airi' ) );
$airi_hide_thumb 	= get_theme_mod( 'index_hide_thumb' );
$airi_hide_date 		= get_theme_mod( 'index_hide_date' );
$airi_hide_cats 		= get_theme_mod( 'index_hide_cats' );
$airi_hide_author 	= get_theme_mod( 'index_hide_author' );
$airi_hide_comments 	= get_theme_mod( 'index_hide_comments' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-inner">
		<div class="flex">

			<?php if ( $airi_hide_thumb == '' ) : ?>
			<div class="<?php echo esc_attr( $airi_layout['item_inner_cols'] ); ?>">
				<?php airi_post_thumbnail(); ?>
			</div>
			<?php endif; ?>

			<div class="post-info <?php echo esc_attr( $airi_layout['item_inner_cols'] ); ?>">
				<header class="entry-header">
					<?php
						if ( $airi_hide_date == '' ) {
							airi_posted_on();
						}
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
							if ( $airi_hide_cats == '' ) {
							echo '<span>';
								airi_first_category();
							echo '</span>';
							}
							if ( $airi_layout['type'] != 'layout-grid' && $airi_layout['type'] != 'layout-masonry' && $airi_hide_author == '' ) {
								airi_posted_by();
							}
							if ( $airi_hide_comments == '' ) {
								airi_get_comments_number();
							}
						?>
					</div><!-- .entry-meta -->
					<?php
					endif; ?>
				</header><!-- .entry-header -->	

				<?php if ( $airi_layout['type'] != 'layout-grid' && $airi_layout['type'] != 'layout-masonry' ) : ?>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->

					<?php if ( $airi_read_more != '' ) : ?>
					<footer class="entry-footer">
						<a class="read-more-link" href="<?php the_permalink(); ?>"><?php echo esc_html( $airi_read_more ); ?><span class="gt">&gt;&gt;</span></a>
					</footer><!-- .entry-footer -->
					<?php endif; ?>
				<?php endif; ?>

			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
