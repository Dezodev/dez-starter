</div> <!-- primary -->

<aside id="secondary" class="d-none d-sm-block col-sm-12 col-md-4">

	<div class="card card-mb">
		<div class="card-body">
			<?php get_template_part('searchform'); ?>
		</div>
	</div>

	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>

</aside> <!-- secondary -->
