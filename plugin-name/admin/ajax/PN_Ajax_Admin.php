<?php

/**
 * Plugin_name
 * 
 * @package   Plugin_name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * AJAX in the admin
 */
class Pn_Ajax_Admin {

	/**
	 * Initialize the class
	 */
	function __construct() {
		$plugin = Plugin_Name_Admin::get_instance();
		$this->cpts = $plugin->get_cpts();

		// For logged user
		add_action( 'wp_ajax_{your_method}', array( $this, 'your_method' ) );
	}

	/**
	 * The method to run on ajax
	 * 
	 * @return void
	 */
	public function your_method() {
		$return = array(
			'message' => 'Saved',
			'ID' => 1
		);

		wp_send_json_success( $return );
		// wp_send_json_error( $return );
	}

}

new Pn_Ajax_Admin();
