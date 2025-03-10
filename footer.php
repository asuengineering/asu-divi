<?php
/**
 * UDS Divi Footer. Modeled after UDS-WordPress.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Action hook from Divi.
 * Fires after the main content, before the footer is output.
 */
do_action( 'et_after_main_content' );

/**
 * Divi function to output a back to top element.
 */
if ( 'on' === et_get_option( 'divi_back_to_top', 'false' ) ) {
	echo '<span class="et_pb_scroll_top et-pb-icon"></span>';
}

/**
 * Action hook from UDS-WordPress.
 * Fires after the main content, before the footer is output.
 */
do_action( 'uds_wp_before_global_footer' );

?>

<footer id="site-footer">

	<div class="wrapper" id="wrapper-endorsed-footer">
		<?php uds_wp_render_footer_branding_row(); ?>
	</div> <!-- wrapper-endorsed-footer -->

</footer>

<footer id="asu-react-footer"></footer>

<?php wp_footer(); ?>

</body>

</html>
