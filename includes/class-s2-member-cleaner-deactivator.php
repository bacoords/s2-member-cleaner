<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://briancoords.com
 * @since      1.0.0
 *
 * @package    S2_Member_Cleaner
 * @subpackage S2_Member_Cleaner/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    S2_Member_Cleaner
 * @subpackage S2_Member_Cleaner/includes
 * @author     Brian Coords <hello@briancoords.com>
 */
class S2_Member_Cleaner_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 's2_member_cleaner_schedule' );
	}

}
