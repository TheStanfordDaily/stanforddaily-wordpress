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
		<div class="container">
			<div class="row">
				<div class="site-info site-info-left col-12 col-lg-6">
					&copy; <?php echo date("Y"); ?> The Stanford Daily Publishing Corporation.
					<br />
					Proudly powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>
					<span class="sep"> | </span>
					Theme by <a href="/wp-content/themes/thestanforddaily/about.html" target="_blank">TSD Tech Team</a>
				</div><!-- .site-info -->
				<div class="site-info site-info-right col-12 col-lg-6">
					<a href="/privacy-policy/" target="_blank">Privacy Policy</a>
					<span class="sep"> | </span>
					<a href="/mobile-app/" target="_blank">Mobile App</a>
				</div>
			</div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
