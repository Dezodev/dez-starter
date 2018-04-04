<?php $this_title = get_the_title(); ?>

<div class="card card-mb">
	<?php if ( has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo $this_title; ?>">
			<?php the_post_thumbnail('large', [
				'class' => 'card-img-top',
			]); ?>
		</a>
	<?php endif; ?>
	<div class="card-body">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo $this_title; ?>"><?php echo $this_title; ?></a>
			</h2>

			<?php display_post_meta_info() ?>

			<?php the_excerpt(); ?>

			<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

		</article>
	</div>
</div>
