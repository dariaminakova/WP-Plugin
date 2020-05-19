<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       dream.team
 * @since      1.0.0
 *
 * @package    Amazing
 * @subpackage Amazing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Amazing
 * @subpackage Amazing/admin
 * @author     dream.team <dream.team@mail.ua>
 */
class Amazing_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amazing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amazing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/amazing-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amazing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amazing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/amazing-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Add menu in WP admin area
	 */
	public function add_amazing_admin_menu_item()
    {
        add_menu_page(
            'amazing',
            'Amazing Settings',
            'read',
            'amazing',
            null,
            plugin_dir_url(__FILE__) . 'images/some-icon.png',
            5
        );

        add_submenu_page('amazing ', 'AmazingPage', 'Settings', 'read', 'amazing', [
            $this,
            'showAmazingSettings'
        ]);
    }

    /**
     * Render Amazing Settings page
     */
    public function showAmazingSettings()
    {
      require_once('partials/amazing-settings-page.php');
		}

		// ADD NEW SLIDER METHOD

		public static function addNewSlider($wpdb, $table_name, $img, $website, $description)
		{
			if ( ! function_exists( 'wp_handle_upload' ) ) 
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				// $file = & $img_path['img_path'];
				$overrides = [ 'test_form' => false ];
				$movefile = wp_handle_upload( $img );
				$path = wp_upload_dir();
				$img_path = $path['url'].'/'. $img['name'];

			$wpdb->insert(
				$table_name,
				array( 
						'img_path' => $img_path,
						'website' => $website,
						'description' => $description,
				),
				array( '%s', '%s', '%s' )
			);
		}

		// SHOW SLIDERS METHOD

		public static function displaySlider($wpdb)
		{
			$table_name = $wpdb->prefix . 'slider_item';
			return $array_content = $wpdb->get_results( "SELECT id, img_path, website, description, DATE_FORMAT(date, '%d. %M %Y') as new_date FROM $table_name");
		}

		// DELETE METHOD

		public static function deleteSlider($wpdb, $table_name, $id)
		{
			$wpdb->delete( $table_name, array( 'id' => (int) $id) );
		}

		// UPADTE METHOD

		public static function updateSlider($wpdb, $table_name, $id, $img, $website, $description)
		{
			if ( ! function_exists( 'wp_handle_upload' ) ) 
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				// $file = & $img_path['img_path'];
				$overrides = [ 'test_form' => false ];
				$movefile = wp_handle_upload( $img, $overrides );
				$path = wp_upload_dir();
				$img_path = $path['url'].'/'. $img['name'];

			$wpdb->update( $table_name, 
			array(
				'img_path' => $img_path,
				'website' => $website,
				'description' => $description,
		  	),
		  	array(
				'id' => $id
			)
		);
	}
}


