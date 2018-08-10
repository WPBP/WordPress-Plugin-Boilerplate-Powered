<?php

/**
 * Plugin name
 *
 * @package   Plugin_name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * This class contain the transient example
 */
class Pn_Transient extends Pn_Base {

	/**
	 * Initialize the snippet
	 */
	public function initialize() {
		!parent::initialize();
	}

	/**
	 * This method contain an example of caching a transient with an external request.
	 *
	 * @return object
	 */
	public function transient_caching_example() {
		$key = 'placeholder_json_transient';

		// Use wp-cache-remember package to retrive or save in transient
		return remember_transient(
             $key, function () use ( $key ) {
				// If there's no cached version we ask
				$response = wp_remote_get( 'https://jsonplaceholder.typicode.com/todos/' );
				if ( is_wp_error( $response ) ) {
					// In case API is down we return the last successful count
					return;
				}

				// If everything's okay, parse the body and json_decode it
				return json_decode( wp_remote_retrieve_body( $response ) );
			 }, DAY_IN_SECONDS
            );
	}

	/**
	 * Print the transient content
	 *
	 * @return void
	 */
	public function print_transient_output() {
		$transient = $this->transient_caching_example();
		echo '<div class="siteapi-bridge-container">';
		foreach ( $transient as &$value ) {
			echo '<div class="siteapi-bridge-single">';
			// $transient is an object so use -> to call children
			echo '</div>';
		}

		echo '</div>';
	}

}

