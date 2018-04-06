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
					<ul class="list-inline mb-0">
						<li class="list-inline-item">
							Made by <a href="http://dezodev.tk/" target="_blank">DezoDev</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body></html>
