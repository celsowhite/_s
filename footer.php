<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>

	</div>

	<footer class="footer">

	</footer>
</div>

<?php wp_footer(); ?>

<!-- Google Analytics Pulled from Options Page Created by ACF -->

<?php /* if(get_field('options_google_analytics','option')): ?>

	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php the_field('options_google_analytics','option'); ?>']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

<?php endif; */?>

</body>
</html>
