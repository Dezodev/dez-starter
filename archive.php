<?php get_header(); ?>

<main role="main">
	<h1><?php the_archive_title(); ?></h1>

	<?php get_template_part('loop'); ?>

	<?php get_template_part('pagination'); ?>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
