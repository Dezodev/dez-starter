<?php

// Comment args
$comm_args = [
	'comment_field'		=> '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'html5blank' ) . '</label><textarea id="comment" class="form-control" name="comment" rows="8" aria-required="true"></textarea></div>',
	'label_submit'		=> __('Send', 'html5blank'),
	'title_reply'		=> __('Add comment', 'html5blank'),
];

?>


<?php if (post_password_required()) : ?>
	<div class="comments">
		<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
	</div>

<?php return; endif; ?>

<div class="comments">

	<h2><?php comments_number(__('Leave the first comment', 'html5blank'), __('1 comment', 'html5blank'), __('% comments', 'html5blank')); ?></h2>

	<?php if (have_comments()) : ?>

		<ul class="comment-list">
			<?php wp_list_comments([
				'type' 			=> 'comment',
				'callback' 		=> 'dezo_comments',
				'style'       	=> 'ul',
		        'short_ping'  	=> true,
		        'avatar_size' 	=> 64,
			]); ?>
		</ul><!-- .comment-list -->

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p><?php _e( 'Comments are closed here.', 'html5blank' ); ?></p>

	<?php endif; ?>

	<?php comment_form($comm_args); ?>

</div>
