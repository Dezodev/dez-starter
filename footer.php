<?php global $DEZ_no_sidebar; ?>

			<?php if ($DEZ_no_sidebar) echo '</div> <!-- primary -->'; ?>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="copyright">
						&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
					</p>
				</div>
				<div class="col-sm-auto">
					<a href="#" class="smooth-scroll"> <?php echo __('Back to top', 'html5blank'); ?> </a>
				</div>
			</div>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body></html>
