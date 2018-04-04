<?php

// Comment args
$comm_args = [
	'comment_field'	=> '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'html5blank' ) . '</label><textarea id="comment" class="form-control" name="comment" rows="8" aria-required="true"></textarea></div>',
	'label_submit'	=> __('Send', 'html5blank'),
	'fields' => [
		'author' =>
			'<div class="form-group row comment-form-author"><div class="col-sm-4"><label for="author">' . __( 'Name', 'html5blank' ) .
			( $req ? '<span class="required">*</span>' : '' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'"' . $aria_req . ' /></div></div>',

		'email' =>
			'<div class="form-group row comment-form-email"><div class="col-sm-4"><label for="email">' . __( 'Email', 'html5blank' ) .
			( $req ? '<span class="required">*</span>' : '' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'"' . $aria_req . ' /></div></div>',

		'url' =>
			'<div class="form-group row comment-form-url"><div class="col-sm-4"><label for="url">' . __( 'Website', 'html5blank' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" /></div></div>',
	]
];

?>


<?php if (post_password_required()) : ?>
	<div class="comments">
		<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
	</div>

<?php return; endif; ?>

<div class="comments">

	<h2><?php comments_number(__('Be the first comment', 'html5blank'), __('1 comment', 'html5blank'), __('% comments', 'html5blank')); ?></h2>

	<?php if (have_comments()) : ?>

		<ul>
			<?php wp_list_comments('type=comment'); ?>
		</ul>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p><?php _e( 'Comments are closed here.', 'html5blank' ); ?></p>

	<?php endif; ?>

	<?php comment_form($comm_args); ?>

</div>
