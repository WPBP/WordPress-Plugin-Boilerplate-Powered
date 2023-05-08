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

namespace Plugin_Name\Frontend;

// WPBPGen{{#if libraries_inpsyde__assets}}
use Inpsyde\Assets\Asset;
use Inpsyde\Assets\AssetManager;
use Inpsyde\Assets\Script;
use Inpsyde\Assets\Style;
// {{/if}}
use Plugin_Name\Engine\Base;

/**
 * Enqueue stuff on the frontend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

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
		// Load public-facing style sheet and JavaScript.
		// WPBPGen{{#if public-assets_css}}
		$assets = $this->enqueue_styles();

		if ( !empty( $assets ) ) {
			foreach ( $assets as $asset ) {
				$asset_manager->register( $asset );
			}
		}

		// {{/if}}
		// WPBPGen{{#if public-assets_js}}
		$assets = $this->enqueue_scripts();

		if ( !empty( $assets ) ) {
			foreach ( $assets as $asset ) {
				$asset_manager->register( $asset );
			}
		}

		// {{/if}}
	}
	// {{/if}}

	// WPBPGen{{#if public-assets_css}}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since {{plugin_version}}
	 * @return array
	 */
	public function enqueue_styles() {
		$styles = array();
		// WPBPGen{{#if libraries_inpsyde__assets}}
		$styles[0] = new Style( PN_TEXTDOMAIN . '-plugin-styles', \plugins_url( 'assets/build/plugin-public.css', PN_PLUGIN_ABSOLUTE ) );
		$styles[0]->forLocation( Asset::FRONTEND )->useAsyncFilter()->withVersion( PN_VERSION );
		$styles[0]->dependencies();
		// {{/if}}

		return $styles;
	}

	// {{/if}}
	// WPBPGen{{#if public-assets_js}}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since {{plugin_version}}
	 * @return array
	 */
	public static function enqueue_scripts() {
		$scripts = array();
		// WPBPGen{{#if libraries_inpsyde__assets}}
		$scripts[0] = new Script( PN_TEXTDOMAIN . '-plugin-script', \plugins_url( 'assets/build/plugin-public.js', PN_PLUGIN_ABSOLUTE ) );
		$scripts[0]->forLocation( Asset::FRONTEND )->useAsyncFilter()->withVersion( PN_VERSION );
		$scripts[0]->dependencies();
		// WPBPGen{{#if frontend_wp-localize-script}}
		$scripts[0]->withLocalize(
			'exampleDemo',
			array(
				'alert'   => \__( 'Error!', PN_TEXTDOMAIN ),
				'nonce'   => \wp_create_nonce( 'demo_example' ),
				'wp_rest' => \wp_create_nonce( 'wp_rest' ),
			)
		);

		// {{/if}}
		// {{/if}}

		return $scripts;
	}

	// {{/if}}

}
