<?php
/**
 * Enqueue assets into the child theme.
 *
 * @package asu-divi
 */

/**
 * Cache-busting version for assets.
 * Prefer a defined build/package version, and fall back to filemtime().
 *
 * @param string $file_path Absolute file path to the asset.
 * @param string|null $fallback_version Optional fallback version string.
 * @return string|false
 */

define( 'ASU_HEADER_FOOTER_VERSION', '1.3.1' );

function uds_divi_get_asset_version( $file_path, $fallback_version = null ) {
	if ( defined( 'ASU_HEADER_FOOTER_VERSION' ) && ASU_HEADER_FOOTER_VERSION ) {
		return ASU_HEADER_FOOTER_VERSION;
	}

	if ( $fallback_version ) {
		return $fallback_version;
	}

	if ( file_exists( $file_path ) ) {
		return filemtime( $file_path );
	}

	return false;
}

/**
 * Enqueue assets.
 */
function uds_divi_enqueue_scripts() {

	$parent_theme     = wp_get_theme()->parent();
	$parent_version   = $parent_theme ? $parent_theme->get( 'Version' ) : '';
	$child_theme      = wp_get_theme();
	$child_version    = $child_theme->get( 'Version' );

	$divi_style_path      = get_template_directory() . '/style.css';
	$child_style_path      = get_stylesheet_directory() . '/style.css';
	$header_bundle_path    = get_stylesheet_directory() . '/src/component-header-footer/asuHeaderFooter.umd.js';
	$header_init_path      = get_stylesheet_directory() . '/dist/js/asu-header-init.js';
	$footer_init_path      = get_stylesheet_directory() . '/dist/js/asu-footer-init.js';
	$theme_js_path         = get_stylesheet_directory() . '/dist/js/theme.js';

	$css_version        = $parent_version . '.' . filemtime( $divi_style_path );
	$child_css_version   = $child_version . '.' . filemtime( $child_style_path );

	$header_asset_version = uds_divi_get_asset_version(
		$header_bundle_path,
		$child_version . '.' . filemtime( $header_bundle_path )
	);

	$header_init_version = uds_divi_get_asset_version(
		$header_init_path,
		$child_version . '.' . filemtime( $header_init_path )
	);

	$footer_init_version = uds_divi_get_asset_version(
		$footer_init_path,
		$child_version . '.' . filemtime( $footer_init_path )
	);

	wp_register_style(
		'divi-style',
		get_template_directory_uri() . '/style.css',
		array(),
		$css_version
	);

	wp_register_style(
		'asu-divi-style',
		get_stylesheet_directory_uri() . '/dist/css/asu-divi.css',
		array( 'divi-style' ),
		$child_css_version
	);

	wp_enqueue_style( 'divi-style' );
	wp_enqueue_style( 'asu-divi-style' );

	wp_enqueue_script(
		'font-awesome-kit',
		'https://kit.fontawesome.com/51b562cd96.js',
		array(),
		null,
		false
	);
	wp_script_add_data( 'font-awesome-kit', 'crossorigin', 'anonymous' );

	// Component header/footer bundle.
	wp_enqueue_script(
		'component-header-footer',
		get_stylesheet_directory_uri() . '/src/component-header-footer/asuHeaderFooter.umd.js',
		array( 'wp-element', 'wp-components' ),
		$header_asset_version,
		true
	);

	// Init files for header/footer.
	// These depend on the shared bundle so they should load after it.
	wp_enqueue_script(
		'component-header-init',
		get_stylesheet_directory_uri() . '/dist/js/asu-header-init.js',
		array( 'component-header-footer' ),
		$header_init_version,
		true
	);

	wp_enqueue_script(
		'component-footer-init',
		get_stylesheet_directory_uri() . '/dist/js/asu-footer-init.js',
		array( 'component-header-footer' ),
		$footer_init_version,
		true
	);

	wp_enqueue_script(
		'asu-divi',
		get_stylesheet_directory_uri() . '/dist/js/theme.js',
		array(),
		file_exists( $theme_js_path ) ? filemtime( $theme_js_path ) : null,
		false
	);

}
add_action( 'wp_enqueue_scripts', 'uds_divi_enqueue_scripts' );
