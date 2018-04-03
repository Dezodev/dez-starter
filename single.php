<?php get_header(); ?>
<div class="card">
	<div class="card-body">
		<main role="main">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>

					<h1 class="text-center">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>

					<?php display_post_meta_info() ?>

					<?php the_content(); // Dynamic Content ?>

					<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

					<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

					<?php comments_template(); ?>

				</article>

			<?php endwhile; ?>

			<?php else: ?>

				<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

			<?php endif; ?>

		</main>

	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
