<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Stanford_Daily
 */

?>

		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container-fluid">
			<div class="row">
				<div class="site-info col-6">
					&copy; <?php echo date("Y"); ?> The Stanford Daily Publishing Corporation.
					<br />
					Proudly powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>
					<span class="sep"> | </span>
					Theme by <a href="/wp-content/themes/thestanforddaily/about.html" target="_blank">TSD Tech Team</a>
				</div><!-- .site-info -->
				<div class="col-6" style="text-align: right; padding-right: 25px;">
					<a href="/privacy-policy">Privacy Policy</a>
					<span class="sep"> | </span>
					<a href="/mobile-app/">Mobile App</a>
				</div>
			</div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
