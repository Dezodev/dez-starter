<?php get_header(); ?>
<div class="card">
	<div class="card-body">
		<main role="main">

			<h1 class="text-center"><?php the_title(); ?></h1>

			<?php
			if (have_posts()):
				while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

					<?php comments_template( '', true ); // Remove if you don't want comments ?>

					<br class="clear">

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

				</article>

				<?php
				endwhile;
			else:
				echo '<p class="lead">'. _e( 'Sorry, nothing to display.', 'html5blank' ) . '</p>';
			endif; ?>
	</main>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
