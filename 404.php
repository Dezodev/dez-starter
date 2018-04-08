<?php
global $DEZ_no_sidebar;
$DEZ_no_sidebar = true;

get_header(); ?>

<main role="main">
	<h1><?php _e( 'Page not found', 'dez-starter' ); ?></h1>
	<p class="lead">
		<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'dez-starter' ); ?></a>
	</p>
</main>

<?php get_footer(); ?>
