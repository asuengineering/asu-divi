<?php
/**
 * ASU Divi: Add metabox to menu items for CTA buttons in main navigation.
 *
 * @package asu-divi
 */


// Creates custom fields for menu item CTA button styling.
function uds_divi_cta_menu_item_fields( $item_id, $item, $depth, $args ) {

	// Get the saved value for the custom field
	$selected_value = get_post_meta( $item_id, '_menu_item_cta_button', true );

	?>
		<p class="field-cta-button description description-wide">
		<label for="field-cta-button-select-<?php echo esc_attr( $item_id ); ?>"><?php echo esc_html('CTA button color'); ?></label>
		<select id="field-cta-button-select-<?php echo esc_attr( $item_id ); ?>" name="menu-item-cta-button[<?php echo esc_attr( $item_id ); ?>]">
			<option value="" <?php selected( $selected_value, '' ); ?>><?php esc_html_e( 'No button', 'textdomain' ); ?></option>
			<option value="maroon" <?php selected( $selected_value, 'maroon' ); ?>><?php esc_html_e( 'Maroon', 'textdomain' ); ?></option>
			<option value="gold" <?php selected( $selected_value, 'gold' ); ?>><?php esc_html_e( 'Gold', 'textdomain' ); ?></option>
			<option value="dark" <?php selected( $selected_value, 'dark' ); ?>><?php esc_html_e( 'Black', 'textdomain' ); ?></option>
		</select>
		</p>
		<p>Note: Not all button colors are applicable for every location. If your choice of color is not a part of the brand standard, a default color will be displayed instead.</p>
	<?php
}

// Save CTA custom field data to the DB.
add_action( 'wp_update_nav_menu_item', 'uds_divi_save_cta_menu_item_fields', 10, 3 );
function uds_divi_save_cta_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {

	if ( isset( $_POST['menu-item-cta-button'][ $menu_item_db_id ] ) ) {

		// Sanitize the value of the select box
		$cta_button = sanitize_text_field( $_POST['menu-item-cta-button'][ $menu_item_db_id ] );

		// Update the custom field for the menu item
		update_post_meta( $menu_item_db_id, '_menu_item_cta_button', $cta_button );

	}

}


// Creates custom fields for social media icon selection.
function uds_divi_social_menu_item_fields( $item_id, $item, $depth, $args, $current_object_id ) {

	// Get the saved value for the custom field
	$selected_value = get_post_meta( $item_id, '_menu_item_social_icon', true );

	?>
		<p class="field-social-icon description description-wide">
		<label for="field-social-icon-select-<?php echo esc_attr( $item_id ); ?>">Social Media Icon</label>
		<select id="field-social-icon-select-<?php echo esc_attr( $item_id ); ?>" name="menu-item-social-icon[<?php echo esc_attr( $item_id ); ?>]">
			<option value="" <?php selected( $selected_value, '' ); ?>>Select an icon</option>
			<option value="fa-square-behance" <?php selected( $selected_value, 'fa-square-behance' ); ?>>Behance</option>
			<option value="fa-square-facebook" <?php selected( $selected_value, 'fa-square-facebook' ); ?>>Facebook</option>
			<option value="fa-flikr" <?php selected( $selected_value, 'fa-flikr' ); ?>>Flikr</option>
			<option value="fa-square-github" <?php selected( $selected_value, 'fa-square-github' ); ?>>GitHub</option>
			<option value="fa-square-instagram" <?php selected( $selected_value, 'fa-square-instagram' ); ?>>Instagram</option>
			<option value="fa-square-linkedin" <?php selected( $selected_value, 'fa-square-linkedin' ); ?>>LinkedIn</option>
			<option value="fa-square-pinterest" <?php selected( $selected_value, 'fa-square-pinterest' ); ?>>Pinterest</option>
			<option value="fa-researchgate" <?php selected( $selected_value, 'fa-researchgate' ); ?>>ResearchGate</option>
			<option value="fa-tiktok" <?php selected( $selected_value, 'fa-tiktok' ); ?>>TikTok</option>
			<option value="fa-square-tumblr" <?php selected( $selected_value, 'fa-square-tumblr' ); ?>>Tumblr</option>
			<option value="fa-square-twitter" <?php selected( $selected_value, 'fa-square-twitter' ); ?>>Twitter</option>
			<option value="fa-square-vimeo" <?php selected( $selected_value, 'fa-square-vimeo' ); ?>>Vimeo</option>
			<option value="fa-wordpress" <?php selected( $selected_value, 'fa-wordpress' ); ?>>WordPress</option>
			<option value="fa-square-youtube" <?php selected( $selected_value, 'fa-square-youtube' ); ?>>YouTube</option>
		</select>
		</p>
	<?php
}

// Saves social menu icon selection to DB.
add_action( 'wp_update_nav_menu_item', 'uds_divi_save_social_menu_item_fields', 10, 3 );
function uds_divi_save_social_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {

	if ( isset( $_POST['menu-item-social-icon'][ $menu_item_db_id ] ) ) {

		// Sanitize the value of the select box
		$social_icon = sanitize_text_field( $_POST['menu-item-social-icon'][ $menu_item_db_id ] );

		// Update the custom field for the menu item
		update_post_meta( $menu_item_db_id, '_menu_item_social_icon', $social_icon );

	}

}


// Adds both controls to the menu items conditionally based on what menu is being edited.
// Solution found here: https://wordpress.stackexchange.com/a/378199/69368
add_filter( 'wp_edit_nav_menu_walker', 'uds_divi_cta_menu_item_display', 10, 2 );
function uds_divi_cta_menu_item_display( $class, $menu_id ) {
    $tag = 'wp_nav_menu_item_custom_fields';

	$locations = get_nav_menu_locations();

	$primary_menu = $locations['primary'];
	$social_menu = $locations['social-media'];

    if ( $primary_menu === $menu_id && ! has_action( $tag, 'uds_divi_cta_menu_item_fields' ) ) {
        add_action( $tag, 'uds_divi_cta_menu_item_fields', 10, 5 );
    }

	if ( $social_menu === $menu_id && ! has_action( $tag, 'uds_divi_social_menu_item_fields' ) ) {
        add_action( $tag, 'uds_divi_social_menu_item_fields', 10, 5 );
    }

    return $class;
}
