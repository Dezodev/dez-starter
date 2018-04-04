<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="card">
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

					<?php comments_template( '', true ); ?>

					<br class="clear">

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

				</article>

			</main>
		</div>
	</div>
<?php
endwhile; else:
	echo '<h1>'. _e( 'Sorry, nothing to display.', 'html5blank' ) . '</h1>';
endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
