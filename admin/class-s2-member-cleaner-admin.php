<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://briancoords.com
 * @since      1.0.0
 *
 * @package    S2_Member_Cleaner
 * @subpackage S2_Member_Cleaner/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    S2_Member_Cleaner
 * @subpackage S2_Member_Cleaner/admin
 * @author     Brian Coords <hello@briancoords.com>
 */
class S2_Member_Cleaner_Admin {

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
		 * defined in S2_Member_Cleaner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The S2_Member_Cleaner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/s2-member-cleaner-admin.css', array(), $this->version, 'all' );

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
		 * defined in S2_Member_Cleaner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The S2_Member_Cleaner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/s2-member-cleaner-admin.js', array( 'jquery' ), $this->version, false );

	}

  /**
   * Adds submenu pages
   */
	public function add_submenu_pages(){
		add_options_page( 'S2 Member Cleaner', 'S2 Member Cleaner', 'manage_options', 's2_member_cleaner', array($this, 's2_member_cleaner_page') );
	}

	public function s2_member_cleaner_page(){
		require_once 'partials/s2-member-cleaner-admin-display.php';
	}

}
