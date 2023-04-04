<?php
/**
 * ASU Divi Child Theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package asu-divi
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$uds_wp_includes = array(
	'/enqueue.php',                       		 		// Enqueues the correct child theme files.
	'/asu-favicons.php',						 		// Adds favicons directly to <head>
	'/setup.php',								 		// Theme setup options.
	'/class-unity-react-header-ctabtn-walker.php',		// Nav walker class specifically for the CTA buttons within the header.
	'/class-unity-react-header-navtree-walker.php',		// Nav walker class for the main navigation object within the header.
	'/menu-item-metabox.php',                       	// Adds a meta box for CTA button colors to each menu item.
	'/class-wp-social-media-walker.php',         		// Load custom WordPress nav walker for footer Social Media menu wdiget.
	'/customizer.php',                           		// Customizer additions.
	'/render-partials.php',                     		// Rendering methods for certain customizer-controlled items.
	// '/header-localize-script.php'				 		// Pass header variables to React for rendering.
	'/wp-custom-menu.php',                       		// Load custom menu builder functions.


);

foreach ( $uds_wp_includes as $file ) {
	require_once get_stylesheet_directory() . '/inc' . $file;
}


// Misc functions. These need a home eventually.
if ( ! function_exists( 'uds_wp_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function uds_wp_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'uds_wp_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

// Remove the [...] standard output for an excerpt.
function asu_divi_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'asu_divi_excerpt_more');
