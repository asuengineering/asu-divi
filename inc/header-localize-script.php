<?php
/**
 * ASU Divi theme - localize_script function for component header.
 *
 * @package asu-divi
 */

add_action( 'wp_enqueue_scripts', 'uds_divi_localize_component_header_script', 99 );
if ( ! function_exists( 'uds_divi_localize_component_header_script' ) ) {

	function uds_divi_localize_component_header_script() {

		// load current user status
		global $current_user;

		/**
		 * UDS Header: Menu settings
		 *
		 * Unlinke the Pitchfork theme, several options here are hardcoded to avoid presenting end users
		 * with an additional options panel to consider while building their site.
		 *
		 *
		 */

		$animate_title = true;
		$expand_on_hover = false;

		// Consider creating an options group for this setting.
		$mobile_menu_breakpoint = 'Lg';

		// $mobile_menu_breakpoint = get_field('mobile_menu_breakpoint', 'option');
		// if (empty($mobile_menu_breakpoint )) {
		// 	$mobile_menu_breakpoint = 'Lg';
		// }

		/**
		 * UDS Header: Logo settings
		 * Same philosophy as above. Likely not needed for legacy sites built using ASU Divi.
		 */
		$asu_logo_override = false;
		$show_partner_logo = false;

		$parent_org_name = get_theme_mod( 'parent_unit_name' );
		$parent_org_link = get_theme_mod( 'parent_unit_link' );

		// Build navTree / mobileNavTree props using walker class.
		if ( has_nav_menu('primary')) {
			$menu_items = wp_nav_menu([
				'theme_location' => 'primary',
				'walker' => new UDS_Divi_React_Header_Navtree(),
				'echo' => false,
				'container' => '',
				'items_wrap' => '%3$s', // See: wp_nav_menu codex for why. Returns empty string.
			]);
		} else {
			$menu_items = array();
		}

		// Expected return from nav walker is a serialized array. But if the array is empty/error,
		// is_seralized() should return false. Explictly return an empty array if so.
		// Handles the use case where the menu is only composed of CTA buttons.
		if ( is_serialized( $menu_items )) {
			$menu_items = maybe_unserialize($menu_items);
		} else {
			$menu_items = array();
		}

		// Build ctaButton prop using walker class.
		if ( has_nav_menu('primary')) {
			$cta_buttons = wp_nav_menu([
				'theme_location' => 'primary',
				'walker' => new UDS_Divi_React_Header_CTAButtons(),
				'echo' => false,
				'container' => '',
				'items_wrap' => '%3$s', // See: wp_nav_menu codex for why. Returns empty string.
				'depth' => 1,
			]);
		} else {
			$cta_buttons = array();
		}

		// If there are no CTA buttons defined in the menu, the CTA walker explicitly returns a
		// serlizized empty array. Shouldn't be any need to further check is_serialized().

		$cta_buttons = maybe_unserialize($cta_buttons);

		// Prep localized array items for wp_localize_script below.
		$localized_array = 	array(
			'loggedIn' => is_user_logged_in(),
			'loginLink' => site_url() . '/wp-admin',
			'logoutLink' => wp_logout_url(),
			'userName' => $current_user->user_login,
			'navTree' => $menu_items,
			'mobileNavTree' => $menu_items,
			'expandOnHover' => $expand_on_hover,
			'baseUrl' => site_url(),
			'logo' => false,
			// 'logo' => $logo_override,
				// // [
				// // 	'alt' => 'alt text',        // default: 'Arizona State University'
				// // 	'src' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',        // default: 'arizona-state-university-logo-vertical.png'
				// // 	'mobileSrc' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',  // default: 'arizona-state-university-logo.png'
				// // 	'brandLink' => 'https://asu.edu',  // default: 'https://asu.edu'
				// // ],
			'isPartner' => false,
			// 'isPartner' => $show_partner_logo,
			// 'partnerLogo' => $partner_logo,
			'title' => get_bloginfo(),
			'animateTitle' => $animate_title,
			'parentOrg' => $parent_org_name,
			'parentOrgUrl' => $parent_org_link,
			'breakpoint' => $mobile_menu_breakpoint,
			'buttons' => $cta_buttons,
		);

		// pass WordPress PHP variables to the uds-header-scripts script we enqueued above
		// These variables are props for the header React component
		wp_localize_script(
			'component-header-init', // the handle of the script to pass our variables
			'udsHeaderVars', // object name to access our PHP variables from in our script
			$localized_array
		);
	}
}
