<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nu Themes
 */
?>
			</div>
		<!-- #main --></div>

		<footer id="footer" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 site-info">
						&copy; <?php echo date('Y'); ?> <?php printf( __( 'LINAGORA. All rights reserved. Proudly powered by %s', 'nuthemes' ), 'WordPress' ); ?>.
					<!-- .site-info --></div>

					<div class="col-sm-6 site-credit">
						<a href="https://www.linagora.fr/node/19">Mentions légales</a>
					<!-- .site-credit --></div>
				</div>
			</div>
		<!-- #footer --></footer>

		<?php wp_footer(); ?>
	</body>
</html>