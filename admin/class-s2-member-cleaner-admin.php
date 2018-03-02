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

	public $max_users = 50;

	public $timeline = '-6 months';

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

		$screen = get_current_screen();

		if( 'settings_page_s2_member_cleaner' == $screen->id){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/s2-member-cleaner-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();

		if( 'settings_page_s2_member_cleaner' == $screen->id){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/s2-member-cleaner-admin.js', array( 'jquery' ), $this->version, false );
		}

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

	/**
	 * Deletes a batch (max 1000) of users
	 * @return int number of users deleted
	 */
	public function delete_batch_of_expired_users(){

		$max_users = $this->max_users;
		$timeline = $this->timeline;

		$args = array(
		  'role' => 'subscriber',
		  'number' => $max_users,
			'fields' => 'ID',
		  'date_query'    => array(
		     array(
		         'before'     => $timeline,
		         'inclusive' => true,
		     ),
		  ),
		);
		$user_query = new WP_User_Query($args);

		$count = 0;

		if ( ! empty( $user_query->get_results() ) ) {
			foreach ( $user_query->get_results() as $user ) {
				if( s2member_last_login_time( $user ) <= strtotime($timeline) ){
					if( wp_delete_user( $user ) ){
						$count++;
					}
				}
			}
		}

		return $count;

	}

	public function s2mc_ajax_delete_batch(){

		check_ajax_referer( 's2mc-delete-batch-ajax-nonce', 'security' );
		if(!current_user_can( 'manage_options' ) ) {
			echo 'Admin Access Only';
			wp_die();
		}

		$result = $this->delete_batch_of_expired_users();

		echo $result;

		wp_die();
	}

}
