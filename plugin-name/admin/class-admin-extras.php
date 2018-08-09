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
 * This class contain all the snippet or extra that improve the experience on the backend
 */
class Pn_Admin_Extras extends Pn_Admin_Base {

	/**
	 * Initialize the snippet
	 */
	function initialize() {
		if ( !parent::initialize() ) {
            return;
		}
//WPBPGen{{#unless libraries_wpbp__debug}}
		/*
		 * Debug mode
		 */
		$debug = new WPBP_Debug( 'WPBP' );
		$debug->log( __( 'Plugin Loaded', PN_TEXTDOMAIN ) );
//{{/unless}}
//WPBPGen{{#unless libraries_nathanielks__wp-admin-notice}}
		/*
		 * Load Wp_Admin_Notice for the notices in the backend
		 *
		 * First parameter the HTML, the second is the css class
		 */
		new WP_Admin_Notice( __( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
		new WP_Admin_Notice( __( 'Error Messages', PN_TEXTDOMAIN ), 'error' );
//{{/unless}}
//WPBPGen{{#unless libraries_julien731__wp-dismissible-notices-handler}}
		/*
		 * Dismissible notice
		 */
		dnh_register_notice( 'my_demo_notice', 'updated', __( 'This is my dismissible notice', PN_TEXTDOMAIN ) );
//{{/unless}}
//WPBPGen{{#unless libraries_julien731__wp-review-me}}
		/*
		 * Review Me notice
		 */
		new WP_Review_Me( array(
			'days_after' => 15,
			'type' => 'plugin',
			'slug' => PN_TEXTDOMAIN,
			'rating' => 5,
			'message' => __( 'Review me!', PN_TEXTDOMAIN ),
			'link_label' => __( 'Click here to review', PN_TEXTDOMAIN )
				) );
//{{/unless}}
//WPBPGen{{#unless libraries_yoast__i18n-module}}
		new Yoast_I18n_WordPressOrg_v3(
				array(
			'textdomain' => PN_TEXTDOMAIN,
			'plugin_name' => PN_NAME,
			'hook' => 'admin_notices',
				)
		);
//{{/unless}}
	}

	//{{/unless}}
	//WPBPGen{{#unless system_transient-example}}
	/**
	 * This method contain an example of code for caching a transient with an external request and parse the results.
	 *
	 * @return void
	 */
	public function transient_caching_example() {
		$key = 'siteapi_json_transient';

		// Let's see if we have a cached version
		$json_output = get_transient( $key );
		if ( $json_output === false || empty( $json_output ) ) {
			// If there's no cached version we ask
			$response = wp_remote_get( "http://www.siteapi.org/api/v1/projects?page=1" );
			if ( is_wp_error( $response ) ) {
				// In case API is down we return the last successful count
				return;
			}
			// If everything's okay, parse the body and json_decode it
			$json_output = json_decode( wp_remote_retrieve_body( $response ) );

			// Store the result in a transient, expires after 1 day
			// Also store it as the last successful using update_option
			set_transient( $key, $json_output, DAY_IN_SECONDS );
			update_option( $key, $json_output );
		}

		echo '<div class="siteapi-bridge-container">';
		foreach ( $json_output->projects as &$value ) {
			echo '<div class="siteapi-bridge-single">';
			// json_output is an object so use -> to call children
			echo '</div>';
		}
		echo '</div>';
	}

	//{{/unless}}
}
