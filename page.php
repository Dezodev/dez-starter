<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="card card-mb">
		<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
			<?php the_post_thumbnail('large', [
				'class' => 'card-img-top',
			]); ?>
		<?php endif; ?>
		<div class="card-body">
			<main role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="post-title"><?php the_title(); ?></h1>

					<?php the_content(); ?>

					<br class="clear">

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

				</article>

			</main>
		</div>
	</div>
	<?php if (comments_open()): ?>
		<div class="card card-mb" id="comments-section">
			<div class="card-body">
				<?php comments_template('', true); ?>
			</div>
		</div>
	<?php endif; ?>
<?php
endwhile; else:
	echo '<h1>'. _e( 'Sorry, nothing to display.', 'dez-starter' ) . '</h1>';
endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
