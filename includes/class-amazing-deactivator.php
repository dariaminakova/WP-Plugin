<?php

/**
 * Fired during plugin deactivation
 *
 * @link       dream.team
 * @since      1.0.0
 *
 * @package    Amazing
 * @subpackage Amazing/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Amazing
 * @subpackage Amazing/includes
 * @author     dream.team <dream.team@mail.ua>
 */
class Amazing_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	 
	public static function delete_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'slider_item';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
	}

	public static function deactivate() {
		self::delete_table();
	}
}