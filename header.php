<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$c_options              = array();
$asu_hub_analytics     = 'disabled';
$site_gtm_container_id = '';
$site_ga_tracking_id   = '';
$hotjar_site_id        = '';
$nav_menu_enabled      = '';

// retrieve settings from the theme mods entry in the options database table.
$c_options = get_theme_mods();

// Is navigation menu enabled?
if ( ! empty( $c_options['header_navigation_menu'] ) ) {
	$nav_menu_enabled = $c_options['header_navigation_menu'];
}

// Do we have an asu_hub_analytics setting?
if ( ! empty( $c_options['asu_hub_analytics'] ) ) {
	$asu_hub_analytics = $c_options['asu_hub_analytics'];
}
// Do we have a site_gtm_container_id setting?
if ( ! empty( $c_options['site_gtm_container_id'] ) ) {
	$site_gtm_container_id = $c_options['site_gtm_container_id'];
}
// Do we have a site_ga_tracking_id setting?
if ( ! empty( $c_options['site_ga_tracking_id'] ) ) {
	$site_ga_tracking_id = $c_options['site_ga_tracking_id'];
}
// Do we have an hotjar_site_id setting?
if ( ! empty( $c_options['hotjar_site_id'] ) ) {
	$hotjar_site_id = $c_options['hotjar_site_id'];
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<?php
	if ( is_user_logged_in() && ! is_customize_preview() ) {
		// shift page content below the WP Admin toolbar.
		?>
		<style type="text/css" media="screen">
			#asu-header.fixed-top {
				top: 32px !important;
			}

			#wpadminbar {
				z-index: 999999 !important;
			}
		</style>
		<?php
	}

	// ASU Hub Analytics.
	if ( ! empty( $asu_hub_analytics ) && 'enabled' === $asu_hub_analytics ) {
		include get_stylesheet_directory() . '/inc/analytics/asu-hub-analytics-tracking-code.php';
	}

	// Site Google Tag Manager.
	if ( ! empty( $site_gtm_container_id ) ) {
		include get_stylesheet_directory() . '/inc/analytics/google-tag-manager-tracking-code.php';
	}

	// Site Google Analytics.
	if ( ! empty( $site_ga_tracking_id ) ) {
		include get_stylesheet_directory() . '/inc/analytics/google-analytics-tracking-code.php';
	}

	// Hotjar Analytics.
	if ( ! empty( $hotjar_site_id ) ) {
		include get_stylesheet_directory() . '/inc/analytics/hotjar-tracking-code.php';
	}
	?>
</head>

<body <?php body_class(); ?> <?php uds_wp_body_attributes(); ?>>

	<?php

	// Site Google Tag Manager (noscript).
	if ( ! empty( $site_gtm_container_id ) ) {
		include get_stylesheet_directory() . '/inc/analytics/google-tag-manager-noscript-code.php';
	}

	do_action( 'wp_body_open' );

	?>

	<div id="header-container"></div>

	<?php do_action( 'uds_wp_after_global_header' ); ?>
