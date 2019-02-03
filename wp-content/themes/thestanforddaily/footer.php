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
			<div class="site-info">
				&copy; <?php echo date("Y"); ?> The Stanford Daily Publishing Corporation.<!--TODO: Typo here!-->
				<br />
				Proudly powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>
				<span class="sep"> | </span>
				Theme by <a href="https://github.com/TheStanfordDaily/" target="_blank">TSD Tech Team</a>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
