<?php $this_title = get_the_title(); ?>

<div class="card card-mb dezo-loop-post">
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

			<ul class="list-inline">
				<li class="list-inline-item">
					<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-secondary"> <?php _e('Read more', 'dez-starter') ?> </a>
				</li>
				<li class="list-inline-item">
					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-secondary'); ?>
				</li>
			</ul>

		</article>
	</div>
</div>
