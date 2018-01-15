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
 * This class should ideally be used to work with the public-facing side of the WordPress site.
 */
class Plugin_Name {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public static function initialize() {
	//WPBPGen{{#if public-assets_css && public-assets_js && frontend_wp-localize-script}}
		require_once( PN_PLUGIN_ROOT . 'public/includes/PN_Enqueue.php' );
	//{{/if}}
		require_once( PN_PLUGIN_ROOT . 'public/includes/PN_Extras.php' );
	//WPBPGen{{#unless frontend_template-system}}
		require_once( PN_PLUGIN_ROOT . 'public/includes/PN_Template.php' );
	//{{/unless}}
	//WPBPGen{{#unless libraries_wpbp__widgets-helper}}
		require_once( PN_PLUGIN_ROOT . 'public/widgets/sample.php' );
	//{{/unless}}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			try {
				self::$instance = new self;
				self::initialize();
			} catch ( Exception $err ) {
				do_action( 'plugin_name_failed', $err );

				if ( WP_DEBUG ) {
					throw $err->getMessage();
				}
			}
		}

		return self::$instance;
	}

}

/*
 * @TODO:
 *
 * - 9999 is used for load the plugin as last for resolve some
 *   problems when the plugin use API of other plugins, remove
 *   if you don' want this
 */

add_action( 'plugins_loaded', array( 'Plugin_Name', 'get_instance' ), 9999 );
