<?php global $DEZ_no_sidebar; ?>

			<?php if ($DEZ_no_sidebar) echo '</div> <!-- primary -->'; ?>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<footer id="footer">
		<div id="footer-widgets">
			<div class="container">
				<div class="row">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
				</div>
			</div>
		</div>
		<div id="footer-sub">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="copyright">
							&copy; <?php echo date('Y'); ?> <a href="#"><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></a>
						</p>
					</div>
					<div class="col-sm-auto">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								Made by <a href="http://dezodev.tk/" target="_blank">DezoDev</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body></html>
