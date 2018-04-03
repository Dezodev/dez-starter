<?php
global $DEZ_no_sidebar;
$DEZ_no_sidebar = true
?>
<?php get_header(); ?>

<main role="main">
	<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
	<p class="lead">
		<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
	</p>
</main>

<?php get_footer(); ?>
