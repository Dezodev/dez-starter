<?php get_header(); ?>

<main role="main">
	<h1><?php echo __( 'Categories :', 'dez-starter' ) . ' '; echo single_cat_title(); ?></h1>

	<?php get_template_part('loop'); ?>

	<?php get_template_part('pagination'); ?>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
