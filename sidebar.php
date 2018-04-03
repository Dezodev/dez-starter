</div> <!-- primary -->

<aside id="secondary" class="col-sm-4">

	<div class="card">
		<div class="card-body">
			<?php get_template_part('searchform'); ?>
		</div>
	</div>

	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>

</aside> <!-- secondary -->
