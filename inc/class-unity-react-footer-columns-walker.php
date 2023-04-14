<?php
/**
 * ASU Divi Unity Footer, Nav Walker, Columns (prop)
 * Extends native Nav Walker.
 *
 * Returns a serialized array to be included in the columns prop for the ASU React footer.
 *
 * @package asu-divi
 *
 */

if ( ! class_exists('Unity_React_Footer_Columns') ) {

    class Unity_React_Footer_Columns extends Walker_Nav_Menu {

		function start_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '';
		}

		function end_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '';
		}

        function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

			// Unserialize contatenated $output string as array.
			// If this is the first object, it'll be empty. Set it up with default structure.
			// The columns: prop is an array of objects.

			if ( empty($output)) {

				$prop = array();

			} else {

				$prop = maybe_unserialize($output);

			}

			/**
			 * Depth 0: First level
			 * - Any first level $item defines the header at the top of the column.
			 * - Create an object with the title (menu description).
			 *
			 * Depth 1: Second level
			 * - Any second level $item is a link within a column.
			 * - Grab the link details and append them as an object to the links array within the last object of $prop
			 *
			 * Depth >2: Third level
			 * - Links in these positions are not a valid structure for this walker.
			 * - Should be prevented as a part of the setup process, hopefully.
			 */
			if ( $depth == 0 ) {

				// Sanity check. We should see if this $item has children.
				// If not, we can skip it and head to the next item.
				if ( $args->walker->has_children ) {

					// Create a new object and push the title in as a property.
					$column = new stdClass();

					// Add the title and an empty array for the links;
					$column->title = $item->title;
					$column->links = array();

					// All good. Push this to the main array.
					$prop[] = $column;

				}

			} else if ( $depth == 1 ) {

				// The last array key of $prop should be where this link goes since
				// the nav walker builds things in sequence.
				$parentKey = array_key_last($prop);

				$entry = new stdClass();
				$entry->url = $item->url;
				$entry->title = $item->attr_title;
				$entry->text = $item->title;

				// Put it where it belongs.
				$prop[$parentKey]->links[] = $entry;

			}

			// Convert $prop back to a string so it can be passed to the next iteration of start_el.
			$output = maybe_serialize($prop);
			// do_action('qm/debug', $prop);

        }

        function end_el(&$output, $item, $depth=0, $args=[], $id=0) {
            $output .= '';
        }
    }
}
