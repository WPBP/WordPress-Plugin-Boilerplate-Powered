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
		//WPBPGen{{#unless libraries_wpbp__debug}}
		/*
		 * Debug mode
		 */
		$debug = new WPBP_Debug( );
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
		//WPBPGen{{#unless libraries_wpbp__cronplus}}
		/*
		 * Load CronPlus 
		 */
		$args = array(
			'recurrence' => 'hourly',
			'schedule' => 'schedule',
			'name' => 'cronplusexample',
			// 'cb' => 'cronplus_example_cb',
			'plugin_root_file' => 'plugin-name.php'
		);

		$cronplus = new CronPlus( $args );
		$cronplus->schedule_event();
		//{{/unless}}
		//WPBPGen{{#unless libraries_wpbp__cpt_columns}}
		/*
		 * Load CPT_Columns
		 * 
		 * Check the file for example
		 */
		$post_columns = new CPT_columns( 'demo' );
		$post_columns->add_column( 'cmb2_field', array(
			'label' => __( 'CMB2 Field' ),
			'type' => 'post_meta',
			'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
			'orderby' => 'meta_value',
			'sortable' => true,
			'prefix' => '<b>',
			'suffix' => '</b>',
			'def' => 'Not defined', // Default value in case post meta not found
			'order' => '-1'
				)
		);
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
		//WPBPGen{{#unless libraries_yoast__whip}}
		whip_wp_check_versions( array(
			'php' => '>=5.6',
		) );
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
		//WPBPGen{{#unless backend_bubble-notification-pending-cpt && backend_dashboard-activity && system_push-notification && system_transient-example}}
		/*
		 * All the extras functions
		 */
		require_once( PN_PLUGIN_ROOT . 'admin/includes/PN_Extras.php' );
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
