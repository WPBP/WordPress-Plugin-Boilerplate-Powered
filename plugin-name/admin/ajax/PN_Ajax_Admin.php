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
	function initialize() {
		if ( !apply_filters( 'plugin_name_pn_ajax_admin_initialize', true ) ) {
			return;
		}
		
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

$pn_ajax_admin = new Pn_Ajax_Admin();
$pn_ajax_admin->initialize();

do_action( 'plugin_name_pn_ajax_admin_instance', $pn_ajax_admin );
