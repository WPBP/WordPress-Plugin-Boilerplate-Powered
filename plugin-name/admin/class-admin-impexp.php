<?php

/**
 * Plugin_Name
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * Provide Import and Export of the settings of the plugin
 */
class Pn_Admin_ImpExp extends Pn_Admin_Base {

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
            return;
		}

		// Add the export settings method
		add_action( 'admin_init', array( $this, 'settings_export' ) );
		// Add the import settings method
		add_action( 'admin_init', array( $this, 'settings_import' ) );
	}

	/**
	 * Process a settings export from config
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function settings_export() {
		if ( empty( $_POST[ 'pn_action' ] ) || 'export_settings' !== esc_html( $_POST[ 'pn_action' ] ) ) {
			return;
		}

		if ( !wp_verify_nonce( esc_html( $_POST[ 'pn_export_nonce' ] ), 'pn_export_nonce' ) ) {
			return;
		}

		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}

		$settings[ 0 ] = get_option( PN_TEXTDOMAIN . '-settings' );
		$settings[ 1 ] = get_option( PN_TEXTDOMAIN . '-settings-second' );

		ignore_user_abort( true );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=pn-settings-export-' . date( 'm-d-Y' ) . '.json' );
		header( 'Expires: 0' );

		echo wp_json_encode( $settings, JSON_PRETTY_PRINT );

		exit;
	}

	/**
	 * Process a settings import from a json file
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function settings_import() {
		if ( empty( $_POST[ 'pn_action' ] ) || 'import_settings' !== esc_html( $_POST[ 'pn_action' ] ) ) {
			return;
		}

		if ( !wp_verify_nonce( esc_html( $_POST[ 'pn_import_nonce' ] ), 'pn_import_nonce' ) ) {
			return;
		}

		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}

		$extension = end( explode( '.', $_FILES[ 'import_file' ][ 'name' ] ) );

		if ( $extension !== 'json' ) {
			wp_die( __( 'Please upload a valid .json file', PN_TEXTDOMAIN ) );
		}

		$import_file = $_FILES[ 'import_file' ][ 'tmp_name' ];

		if ( empty( $import_file ) ) {
			wp_die( __( 'Please upload a file to import', PN_TEXTDOMAIN ) );
		}

		// Retrieve the settings from the file and convert the json object to an array.
		$settings = (array) wp_json_decode( file_get_contents( $import_file ) );

		update_option( PN_TEXTDOMAIN . '-settings', get_object_vars( $settings[ 0 ] ) );
		update_option( PN_TEXTDOMAIN . '-settings-second', get_object_vars( $settings[ 1 ] ) );

		wp_safe_redirect( admin_url( 'options-general.php?page=' . PN_TEXTDOMAIN ) );
		exit;
	}

}
