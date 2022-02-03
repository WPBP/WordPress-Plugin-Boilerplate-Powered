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

namespace Plugin_Name\Internals;

use Plugin_Name\Engine\Base;
use \stdClass; // phpcs:ignore

/**
 * Transient used by the plugin
 */
class Transient extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();
	}

	/**
	 * This method contain an example of caching a transient with an external request.
	 *
	 * @since {{plugin_version}}
	 * @return mixed
	 */
	public function transient_caching_example() { // phpcs:ignore
		$key = 'placeholder_json_transient';

		// Use wp-cache-remember package to retrive or save in transient
		return \remember_transient(
		$key,
		static function () {
			// If there's no cached version we ask
			$response = \wp_remote_get( 'https://jsonplaceholder.typicode.com/todos/' );

			if ( \is_wp_error( $response ) ) {
				// In case API is down we return an empty object
				return new \stdClass; // phpcs:ignore
			}

			// If everything's okay, parse the body and json_decode it
			return \json_decode( \wp_remote_retrieve_body( $response ) );
		},
		DAY_IN_SECONDS
		);
	}

	/**
	 * Print the transient content
	 *
	 * @since {{plugin_version}}
	 * @return string
	 */
	public function print_transient_output() {
		$transient = $this->transient_caching_example();

		if ( !\is_iterable( $transient ) ) {
			return '';
		}

		echo '<div class="siteapi-bridge-container">';

		foreach ( $transient as $value ) { // phpcs:ignore
			echo '<div class="siteapi-bridge-single">';
			// $transient is an object so use -> to call children
			echo '</div>';
		}

		echo '</div>';

		return '';
	}

}
