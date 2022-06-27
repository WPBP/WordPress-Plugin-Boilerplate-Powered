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

namespace Plugin_Name\Backend;

use Plugin_Name\Engine\Base;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
		// Load admin style sheet and JavaScript.
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		// {{/if}}
	}


	// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		// WPBPGen{{#if admin-assets_settings-css}}
		if ( !\is_null( $admin_page ) && 'toplevel_page_plugin-name' === $admin_page->id ) {
			\wp_enqueue_style( PN_TEXTDOMAIN . '-settings-styles', \plugins_url( 'assets/build/plugin-settings.css', PN_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PN_VERSION );
		}

		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-css}}
		\wp_enqueue_style( PN_TEXTDOMAIN . '-admin-styles', \plugins_url( 'assets/build/plugin-admin.css', PN_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PN_VERSION );
		// {{/if}}
	}

	// {{/if}}
	// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		// WPBPGen{{#if admin-assets_settings-js}}
		$admin_page = \get_current_screen();

		$settings_script_dependencies = include plugins_url( 'assets/build/plugin-settings.asset.php' , PN_PLUGIN_ABSOLUTE );
		if ( !\is_null( $admin_page ) && 'toplevel_page_plugin-name' === $admin_page->id ) {
			\wp_enqueue_script( PN_TEXTDOMAIN . '-settings-script', \plugins_url( 'assets/build/plugin-settings.js', PN_PLUGIN_ABSOLUTE ), array_merge($settings_script_dependencies['dependencies'], ['jquery', 'jquery-ui-tabs']), PN_VERSION, false );
		}

		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-js}}
		$admin_script_dependencies = include plugins_url( 'assets/build/plugin-admin.asset.php' , PN_PLUGIN_ABSOLUTE );
		\wp_enqueue_script( PN_TEXTDOMAIN . '-admin-script', \plugins_url( 'assets/build/plugin-admin.js', PN_PLUGIN_ABSOLUTE ), array_merge($admin_script_dependencies['dependencies'], ['jquery']), PN_VERSION, false );
		// {{/if}}
	}

	// {{/if}}

}
