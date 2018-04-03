<?php
if (have_posts()):
	while (have_posts()) : the_post();
		$this_title = get_the_title();
?>

		<div class="card">
			<div class="card-body">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo $this_title; ?>">
							<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
						</a>
					<?php endif; ?>

					<h2 class="post-title text-center">
						<a href="<?php the_permalink(); ?>" title="<?php echo $this_title; ?>"><?php echo $this_title; ?></a>
					</h2>

					<?php display_post_meta_info() ?>

					<?php the_excerpt(); ?>

					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

				</article>
			</div>
		</div>


<?php
	endwhile;
else: ?>
	<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
<?php endif; ?>
