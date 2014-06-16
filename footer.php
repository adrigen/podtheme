<?php
/**
 * podtheme template for displaying the footer
 *
 * @package WordPress
 * @subpackage podtheme
 * @since podtheme 1.0
 */
?>
<footer role="contentinfo">
				<ul class="footer-widgets"><?php
					if ( function_exists( 'dynamic_sidebar' ) ) :
						dynamic_sidebar( 'footer-sidebar' );
					endif; ?>
				</ul>

<hr/>
<p><a href="http://octapod.org/privacy/"> Privacy Policy</a> |<a href="http://octapod.org/terms-of-use/"> Terms Of Use</a></p>
<p>© 2013 The Octapod Association Incorporated | ABN 78 817 017 065 </p>
</footer>
			</div>

		<?php wp_footer(); ?>
	</body>
</html>
