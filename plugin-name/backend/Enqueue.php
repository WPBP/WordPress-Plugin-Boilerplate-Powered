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

// WPBPGen{{#if libraries_inpsyde__assets}}
use Inpsyde\Assets\Asset;
use Inpsyde\Assets\AssetManager;
use Inpsyde\Assets\Script;
use Inpsyde\Assets\Style;
// {{/if}}
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

		// WPBPGen{{#if libraries_inpsyde__assets}}
		\add_action( AssetManager::ACTION_SETUP, array( $this, 'enqueue_assets' ) );
		// {{/if}}
	}
	// WPBPGen{{#if libraries_inpsyde__assets}}

	/**
	 * Enqueue assets with Inpyside library https://inpsyde.github.io/assets
	 *
	 * @param \Inpsyde\Assets\AssetManager $asset_manager The class.
	 * @return void
	 */
	public function enqueue_assets( AssetManager $asset_manager ) {
		// Load admin style sheet and JavaScript.
		// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
		$assets = $this->enqueue_admin_styles();

		if ( !empty( $assets ) ) {
			foreach ( $assets as $asset ) {
				$asset_manager->register( $asset );
			}
		}

		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
		$assets = $this->enqueue_admin_scripts();

		if ( !empty( $assets ) ) {
			foreach ( $assets as $asset ) {
				$asset_manager->register( $asset );
			}
		}

		// {{/if}}
	}
	// {{/if}}

	// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since {{plugin_version}}
	 * @return array
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();
		$styles     = array();

		// WPBPGen{{#if libraries_inpsyde__assets}}
		// WPBPGen{{#if admin-assets_settings-css && libraries_inpsyde__assets}}
		if ( !\is_null( $admin_page ) && 'toplevel_page_plugin-name' === $admin_page->id ) {
			$styles[0] = new Style( PN_TEXTDOMAIN . '-settings-style', \plugins_url( 'assets/build/plugin-settings.css', PN_PLUGIN_ABSOLUTE ) );
			$styles[0]->forLocation( Asset::BACKEND )->withVersion( PN_VERSION );
			$styles[0]->withDependencies( 'dashicons' );
		}

		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-css && libraries_inpsyde__assets}}
		$styles[1] = new Style( PN_TEXTDOMAIN . '-admin-style', \plugins_url( 'assets/build/plugin-admin.css', PN_PLUGIN_ABSOLUTE ) );
		$styles[1]->forLocation( Asset::BACKEND )->withVersion( PN_VERSION );
		$styles[1]->withDependencies( 'dashicons' );
		// {{/if}}
		// {{/if}}

		return $styles;
	}

	// {{/if}}
	// WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since {{plugin_version}}
	 * @return array
	 */
	public function enqueue_admin_scripts() {
		$admin_page = \get_current_screen();
		$scripts    = array();
		// WPBPGen{{#if libraries_inpsyde__assets}}
		// WPBPGen{{#if admin-assets_settings-js && libraries_inpsyde__assets}}

		if ( !\is_null( $admin_page ) && 'toplevel_page_plugin-name' === $admin_page->id ) {
			$scripts[0] = new Script( PN_TEXTDOMAIN . '-settings-script', \plugins_url( 'assets/build/plugin-settings.js', PN_PLUGIN_ABSOLUTE ) );
			$scripts[0]->forLocation( Asset::BACKEND )->withVersion( PN_VERSION );
			$scripts[0]->withDependencies( 'jquery-ui-tabs' );
			$scripts[0]->canEnqueue(
				function() {
					return \current_user_can( 'manage_options' );
				}
			);
		}

		// {{/if}}
		// WPBPGen{{#if admin-assets_admin-js && libraries_inpsyde__assets}}
		$scripts[1] = new Script( PN_TEXTDOMAIN . '-settings-admin', \plugins_url( 'assets/build/plugin-admin.js', PN_PLUGIN_ABSOLUTE ) );
		$scripts[1]->forLocation( Asset::BACKEND )->withVersion( PN_VERSION );
		$scripts[1]->dependencies();
		// {{/if}}
		// {{/if}}

		return $scripts;
	}
	// {{/if}}

}
