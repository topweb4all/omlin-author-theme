<?php
/**
 * The template for displaying comments
 *
 * @package Omlin_Author_Theme
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
	// هل يوجد تعليقات؟
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$hana_comment_count = get_comments_number();
			if ( '1' === $hana_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'omlin' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $hana_comment_count, 'comments title', 'omlin' ) ),
					number_format_i18n( $hana_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 60, // حجم الصورة
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		// تصفح التعليقات (سابق/تالي)
		the_comments_navigation();

		// إذا كانت التعليقات مغلقة
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'omlin' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	// نموذج كتابة التعليق (Form)
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	comment_form(
		array(
			'title_reply'       => __( 'Leave a Reply', 'omlin' ),
			'title_reply_to'    => __( 'Leave a Reply to %s', 'omlin' ),
			'class_submit'      => 'btn btn-primary', // نفس كلاس الأزرار عندك
			'label_submit'      => __( 'Post Comment', 'omlin' ),
			
			// تخصيص الحقول (حذفنا الموقع URL)
			'fields' => array(
				'author' => '<div class="comment-form-author form-group">' .
							'<label for="author">' . __( 'Name', 'omlin' ) . '</label> ' .
							( $req ? '<span class="required">*</span>' : '' ) .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',

				'email'  => '<div class="comment-form-email form-group">' .
							'<label for="email">' . __( 'Email', 'omlin' ) . '</label> ' .
							( $req ? '<span class="required">*</span>' : '' ) .
							'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
			),
			'comment_field' => '<div class="comment-form-comment form-group">' .
								'<label for="comment">' . __( 'Comment', 'omlin' ) . '</label>' .
								'<textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea>' .
								'</div>',
		)
	);
	?>

</div><!-- #comments -->
