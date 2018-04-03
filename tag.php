<?php get_header(); ?>

	<main role="main">

		<h1><?php echo __( 'Tag Archive: ', 'html5blank' ) . single_tag_title('', false); ?></h1>

		<?php get_template_part('loop'); ?>

		<?php get_template_part('pagination'); ?>

	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
