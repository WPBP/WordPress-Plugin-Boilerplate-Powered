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
 * This class should ideally be used to work with the administrative side of the WordPress site.
 */
class Plugin_Name_Admin {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public static function initialize() {
		if ( !apply_filters( 'plugin_name_pn_admin_initialize', true ) ) {
			return;
		}
		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		  if( ! is_super_admin() ) {
		  return;
		  }
		 */
//WPBPGen{{#unless admin-assets_admin-page}}
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_Enqueue_Admin.php' );
//{{/unless}}
//WPBPGen{{#unless libraries_webdevstudios__cmb2}}
		/*
		 * Load CMB
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_CMB.php' );
//{{/unless}}
//WPBPGen{{#unless backend_impexp-settings}}
		/*
		 * Import Export settings
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_ImpExp.php' );
//{{/unless}}
//WPBPGen{{#unless libraries_kevinlangleyjr__wp-contextual-help}}
		/*
		 * Contextual Help
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_ContextualHelp.php' );
//{{/unless}}
//WPBPGen{{#unless libraries_wpbp__pointerplus}}
		/*
		 * All the pointers
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_Pointers.php' );
//{{/unless}}
		/*
		 * All the extras functions
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_Extras_Admin.php' );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		  if( ! is_super_admin() ) {
		  return;
		  }
		 */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			try {
				self::$instance = new self;
				self::initialize();
			} catch ( Exception $err ) {
				do_action( 'plugin_name_admin_failed', $err );

				if ( WP_DEBUG ) {
					throw $err->getMessage();
				}
			}
		}

		return self::$instance;
	}

}

add_action( 'plugins_loaded', array( 'Plugin_Name_Admin', 'get_instance' ) );
