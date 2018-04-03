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
					<a href="#"> <?php echo __('Back to top', 'html5blank'); ?> </a>
				</div>
			</div>
		</div>

	</footer>

	<?php wp_footer(); ?>

	<!-- analytics -->
	<script>
	(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
	(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
	l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
	ga('send', 'pageview');
	</script>

</body></html>
