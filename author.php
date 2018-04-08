<?php get_header(); ?>

<main role="main">

	<?php if (have_posts()): the_post(); ?>

	<h1><?php echo __('Author Archives : ', 'dez-starter') . get_the_author(); ?></h1>

	<?php if ( get_the_author_meta('description')) : ?>

		<div class="card card-mb">
			<div class="card-body">
				<?php
					echo '<div class="float-left mr-3">' . get_avatar(get_the_author_meta('user_email')) . '</div>';
					echo '<h2>'.__('About', 'dez-starter').' '.get_the_author().'</h2>';
					echo wpautop(get_the_author_meta('description'));
				?>
			</div>
		</div>


	<?php endif; ?>

	<?php rewind_posts(); while (have_posts()) : the_post();
		get_template_part('loop-post');
	endwhile; ?>

	<?php else: ?>

		<h2><?php _e( 'Sorry, nothing to display.', 'dez-starter' ); ?></h2>

	<?php endif; ?>

	<?php get_template_part('pagination'); ?>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
