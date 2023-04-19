<?php
/**
 * ASU Divi theme - localize_script function for component footer.
 *
 * @package asu-divi
 */

add_action( 'wp_enqueue_scripts', 'uds_wp_localize_component_footer_script', 99 );
if ( ! function_exists( 'uds_wp_localize_component_footer_script' ) ) {

	function uds_wp_localize_component_footer_script() {

		// load current user status
		global $current_user;

		/**
		 * UDS Footer: Menu settings
		 *
		 * Currently, we're only using the set of columns: props for the React footer.
		 * The social media icons & unit logo are handed by WP directly.
		 *
		 */

		// Build columns: arrray using walker class.
		if ( has_nav_menu('footer')) {
			$footer_menu = wp_nav_menu([
				'theme_location' => 'footer',
				'walker' => new Unity_React_Footer_Columns(),
				'echo' => false,
				'container' => '',
				'items_wrap' => '%3$s', // See: wp_nav_menu codex for why. Returns empty string.
			]);
		} else {
			$footer_menu = array();
		}

		// Expected return from nav walker is a serialized array. But if the array is empty/error,
		// is_seralized() should return false. Explictly return an empty array if so.
		if ( is_serialized( $footer_menu )) {
			$footer_menu = maybe_unserialize($footer_menu);
		} else {
			$footer_menu = array();
		}

		// Prep localized array items for wp_localize_script below.
		$localized_array = 	array(
			'columns' => $footer_menu,
		);

		// Add the site title to the info column
		$localized_array['title'] = get_bloginfo('name');

		// Add a contact link if the information is found within the customizer.
		$contact_link = get_theme_mod('contact_url');
		if (!empty($contact_link)) {
			$localized_array['contactLink'] = $contact_link;
		}

		// Add a contribute button if the information is found within the customizer.
		$contribute_link = get_theme_mod('contribute_url');
		if (!empty($contribute_link)) {
			$localized_array['contributionLink'] = $contribute_link;
		}

		// pass WordPress PHP variables to the uds-header-scripts script we enqueued above
		// These variables are props for the header React component
		wp_localize_script(
			'component-footer-init', // the handle of the script to pass our variables
			'udsFooterVars', // object name to access our PHP variables from in our script
			$localized_array
		);
	}
}
