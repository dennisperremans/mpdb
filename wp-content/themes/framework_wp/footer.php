<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="paypal">
	<div class="row">
		<div class="col-md-3">
			&nbsp;
		</div>
		<div class="col-md-9 d-flex justify-content-center">
			Keep this website alive? 

			<form action="https://www.paypal.com/donate" method="post" target="_top">
			<input type="hidden" name="hosted_button_id" value="PTPBX4FM5V3J4" />
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
			<img alt="" border="0" src="https://www.paypal.com/en_BE/i/scr/pixel.gif" width="1" height="1" />
			</form>

			Thanks ! 
		</div>
	</div>
</div>
<footer class="primary-footer">

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="contact-me">
					Contact me on <u>contact@mpdb.space</u> if there are any issues or if there is wrong info
				</div>
			</div>

			<div class="col-md-4 text-right">
				<div class="legals">
					<a href="https://mpdb.space/cookie-policy" target="_blank">Cookie Policy</a> | 
					<a href="https://mpdb.space/privacy-policy" target="_blank">Privacy Policy</a> |
					<a href="https://mpdb.space/info" target="_blank">Info</a>
				</div>
			</div>
		</div>
	</div>

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

