<?php
if (have_posts()):
	while (have_posts()) : the_post();
		get_template_part('loop-post');
	endwhile;
else: ?>
	<p class="lead"><?php _e( 'Sorry, nothing to display.', 'dez-starter' ); ?></p>
<?php endif; ?>
