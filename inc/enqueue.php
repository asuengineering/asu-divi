<?php
/**
 * Enqueue assets into the child theme.
 *
 * @package asu-divi
 */

/**
 * Enqueue assets.
 **/
function uds_divi_enqueue_scripts() {

	// Get the Divi version
	$the_parent_theme = wp_get_theme()->parent();
	$parent_theme_version = $the_parent_theme->Version;

	// Get the ASU Divi version
	$the_child_theme     = wp_get_theme();
	$child_theme_version = $the_child_theme->get( 'Version' );

	$css_version = $parent_theme_version . '.' . filemtime( get_template_directory() . '/style.css' );
	$child_css_version = $child_theme_version . '.' . filemtime( get_stylesheet_directory() . '/style.css' );

	wp_register_style( 'divi-style', get_template_directory_uri() . '/style.css', array(), $css_version );
	wp_register_style( 'asu-divi-style', get_stylesheet_directory_uri() . '/css/asu-divi.css', array( 'divi-style' ), $child_css_version );

	wp_enqueue_style( 'divi-style' );
	wp_enqueue_style( 'asu-divi-style' );

	wp_enqueue_script ( 'font-awesome-kit', 'https://kit.fontawesome.com/51b562cd96.js', array(), null, false );
	wp_script_add_data( 'font-awesome-kit', 'crossorigin', 'anonymous' );

	wp_enqueue_script ( 'component-header-vendor', get_stylesheet_directory_uri() . '/src/uds-header/js/vendor.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-header', get_stylesheet_directory_uri() . '/src/uds-header/js/asuHeader.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-header-init', get_stylesheet_directory_uri() . '/js/asu-header-init.js', array(), null, false );

	wp_enqueue_script ( 'component-footer-vendor', get_stylesheet_directory_uri() . '/src/uds-footer/js/vendor.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-footer', get_stylesheet_directory_uri() . '/src/uds-footer/js/asuFooter.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-footer-init', get_stylesheet_directory_uri() . '/js/asu-footer-init.js', array(), null, false );

	wp_enqueue_script ( 'component-cookie-vendor', get_stylesheet_directory_uri() . '/src/cookie-consent/js/vendor.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-cookie', get_stylesheet_directory_uri() . '/src/cookie-consent/js/asuCookieConsent.umd.js', array( 'wp-element', 'wp-components' ), null, false );
	wp_enqueue_script ( 'component-cookie-init', get_stylesheet_directory_uri() . '/js/cookie-consent-init.js', array(), null, false );

	wp_enqueue_script ( 'asu-divi', get_stylesheet_directory_uri() . '/js/theme.js', array(), null, false );

}
add_action( 'wp_enqueue_scripts', 'uds_divi_enqueue_scripts' );
