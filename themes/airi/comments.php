<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Airi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( '1 comment', 'airi' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number */
					esc_html( _nx( '%1$s comments', '%1$s comments', $comment_count, 'comments title', 'airi' ) ),
					number_format_i18n( $comment_count )
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => '70',
					'callback'	 => 'airi_comment_template'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'airi' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().
	$comment_layout = get_theme_mod('single_comment_form_layout', 'layout-default');
	if ( 'layout-2' == $comment_layout )
	{
		$args = array(
			'title_reply'   => esc_html__( 'Leave A Comment', 'airi' ),
			'label_submit'  => esc_html__( 'Send message', 'airi' ),
			'comment_notes_before'	=>	'',
			'class_form'	=>	'comment-form layout-2',
			'comment_notes_after'	=>	'',
			'class_submit'	=>	'btn-main',
			'fields'               => array(
				'author' => '<div class="form-group">' . '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name', 'airi' ) . '" aria-required="true" required/></div>',
				'email'	=>	'<div class="form-group">' . '<input id="email" name="email" class="form-control" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email', 'airi' ) . '" aria-required="true" required /></div>',
				'url'	=>	'<div class="form-group">' . '<input id="url" name="url" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website', 'airi' ) . '" aria-required="true" required /></div>',
				'comment_field'	=>	'<div class="form-group"><textarea id="comment" rows="6" class="form-control" name="comment" placeholder="' . esc_attr__( 'Message', 'airi' ) . '" aria-required="true"></textarea></div>',
			),
			'comment_field'	=>	'<div class="form-group"><textarea id="comment" rows="6" class="form-control" name="comment" placeholder="' . esc_attr__( 'Message', 'airi' ) . '" aria-required="true"></textarea></div>',
		);
		if ( ! is_user_logged_in() )
		{
			$args['comment_field'] = '';
		}

		comment_form( $args );
	}
	elseif ( 'layout-3' == $comment_layout )
	{
		$args = array(
			'title_reply'   => esc_html__( 'Leave A Comment', 'airi' ),
			'label_submit'  => esc_html__( 'Send message', 'airi' ),
			'comment_notes_before'	=>	'',
			'class_form'	=>	'comment-form layout-3',
			'comment_notes_after'	=>	'',
			'class_submit'	=>	'btn-main',
			'fields'               => array(
				'author' => '<div class="row"><div class="col-md-6"><div class="form-group">' . '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name', 'airi' ) . '" aria-required="true" required/></div></div>',
				'email'	=>	'<div class="col-md-6"><div class="form-group">' . '<input id="email" name="email" class="form-control" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email', 'airi' ) . '" aria-required="true" required /></div></div></div>',
				'url'	=>	'<div class="form-group">' . '<input id="url" name="url" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website', 'airi' ) . '" aria-required="true" required /></div>',
				'comment_field'	=>	'<div class="form-group"><textarea id="comment" rows="6" class="form-control" name="comment" placeholder="' . esc_attr__( 'Message', 'airi' ) . '" aria-required="true"></textarea></div>',
			),
			'comment_field'	=>	'<div class="form-group"><textarea id="comment" rows="6" class="form-control" name="comment" placeholder="' . esc_attr__( 'Message', 'airi' ) . '" aria-required="true"></textarea></div>',
		);
		if ( ! is_user_logged_in() )
		{
			$args['comment_field'] = '';
		}

		comment_form( $args );
	}
	else
	{
		comment_form();
	}
	?>

</div><!-- #comments -->
