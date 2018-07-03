<?php

// Comment args
$comm_args = [
	'comment_field'		=> '<div class="form-group comment-form-comment"><label for="comment">' . __('Comment', 'dez-starter') . '</label><textarea id="comment" class="form-control" name="comment" rows="8" aria-required="true"></textarea></div>',
	'label_submit'		=> __('Send', 'dez-starter'),
	'title_reply'		=> __('Add comment', 'dez-starter'),
];

?>


<?php if (post_password_required()) : ?>
	<div class="comments">
		<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'dez-starter' ); ?></p>
	</div>

<?php return; endif; ?>

<div class="comments">

	<h2><?php comments_number(__('Leave the first comment', 'dez-starter'), __('1 comment', 'dez-starter'), __('% comments', 'dez-starter')); ?></h2>

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

	<?php endif; ?>

	<?php comment_form($comm_args); ?>

</div>
