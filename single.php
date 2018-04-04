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

					<h1 class="post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>

					<?php display_post_meta_info() ?>

					<?php the_content(); // Dynamic Content ?>

					<p><i data-feather="tag"></i> <?php _e( 'Tags: ', 'html5blank' ); the_tags('', ', '); ?></p>

					<p><i data-feather="folder"></i> <?php _e( 'Categories: ', 'html5blank' ); the_category(', '); ?></p>

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

					<?php comments_template(); ?>

				</article>

			</main>

		</div>
	</div>
<?php endwhile; else: ?>

	<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
