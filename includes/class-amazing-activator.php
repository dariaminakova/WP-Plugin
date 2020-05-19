<?php

/**
 * Fired during plugin activation
 *
 * @link       dream.team
 * @since      1.0.0
 *
 * @package    Amazing
 * @subpackage Amazing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Amazing
 * @subpackage Amazing/includes
 * @author     dream.team <dream.team@mail.ua>
 */

class Amazing_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *static
	 * @since    1.0.0
	 */

	public static function create_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'slider_item';
		$charset_collate = $wpdb->get_charset_collate();

		#Check to see if the table exists already, if not, then create it
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) 
		{
			$sql = "CREATE TABLE " . $table_name ." (
				id INT(11) AUTO_INCREMENT NOT NULL,
				img_path text NOT NULL,
				website text,
				description text,
				date DATETIME DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY(id)
			)
			$charset_collate;";
			$wpdb->query($sql);
		}

	}

	public static function activate() {
		self::create_table();
	}

}

?>