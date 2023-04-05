<?php
/**
 * ASU Divi: Add metabox to menu items for CTA buttons in main navigation.
 *
 * @package asu-divi
 */


// Add custom fields to menu item
function uds_divi_custom_menu_item_fields( $item_id, $item, $depth, $args ) {

  	// TODO: Check if the current menu being edited is assigned to the "primary" location.
	// For now, metabox is displayed on all menu items.

	// Get the saved value for the custom field
	$selected_value = get_post_meta( $item_id, '_menu_item_cta_button', true );

	?>
		<p class="field-cta-button description description-wide">
		<label for="field-cta-button-select-<?php echo esc_attr( $item_id ); ?>"><?php echo esc_html('CTA button color'); ?></label>
		<select id="field-cta-button-select-<?php echo esc_attr( $item_id ); ?>" name="menu-item-cta-button[<?php echo esc_attr( $item_id ); ?>]">
			<option value="" <?php selected( $selected_value, '' ); ?>><?php esc_html_e( 'No button', 'textdomain' ); ?></option>
			<option value="maroon" <?php selected( $selected_value, 'maroon' ); ?>><?php esc_html_e( 'Maroon', 'textdomain' ); ?></option>
			<option value="gold" <?php selected( $selected_value, 'gold' ); ?>><?php esc_html_e( 'Gold', 'textdomain' ); ?></option>
			<option value="black" <?php selected( $selected_value, 'black' ); ?>><?php esc_html_e( 'Black', 'textdomain' ); ?></option>
			<option value="gray" <?php selected( $selected_value, 'gray' ); ?>><?php esc_html_e( 'Gray', 'textdomain' ); ?></option>
		</select>
		</p>
		<p>Note: Not all button colors are applicable for every location. If your choice of color is not a part of the brand standard, a default color will be displayed instead.</p>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'uds_divi_custom_menu_item_fields', 10, 4 );

// Save custom fields
function uds_divi_save_custom_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {

	if ( isset( $_POST['menu-item-cta-button'][ $menu_item_db_id ] ) ) {

		// Sanitize the value of the select box
		$cta_button = sanitize_text_field( $_POST['menu-item-cta-button'][ $menu_item_db_id ] );

		// Update the custom field for the menu item
		update_post_meta( $menu_item_db_id, '_menu_item_cta_button', $cta_button );

	} else {
		// delete_post_meta( $menu_item_db_id, '_menu_item_cta_button' );
	}

}
add_action( 'wp_update_nav_menu_item', 'uds_divi_save_custom_menu_item_fields', 10, 3 );
