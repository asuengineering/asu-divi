<?php
/**
 * Theme basic setup
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Sets up correct menu locations.
 */
function uds_divi_wp_setup() {

	// Register the correct nav menus.
	register_nav_menus(
		array(
			'primary' => __( 'Main Menu', 'asu-divi-theme' ),
			'footer' => __( 'Footer Menu', 'asu-divi-theme' ),
			'social-media' => __( 'Social Media Menu', 'asu-divi-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'uds_divi_wp_setup' );

/**
 * Remove the default menu locations from Divi parent.
 */
function uds_divi_remove_parent_theme_menu_locations() {
	unregister_nav_menu( 'primary-menu' );
	unregister_nav_menu( 'secondary-menu' );
	unregister_nav_menu( 'footer-menu' );
}
add_action( 'after_setup_theme', 'uds_divi_remove_parent_theme_menu_locations', 20 );


add_filter( 'excerpt_more', 'uds_wp_custom_excerpt_more' );

if ( ! function_exists( 'uds_wp_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function uds_wp_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}
