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
 * This class contain the Enqueue stuff for the backend
 */
class Pn_Admin_Enqueue extends Pn_Admin_Base {

	//WPBPGen{{#if admin-assets_admin-page}}
	/**
	 * Slug of the plugin screen.
	 *
	 * @var string
	 */
	protected $admin_view_page = null;

	//{{/if}}
	/**
	 * Initialize the class
	 */
	public function initialize() {
		if ( !apply_filters( 'plugin_name_pn_enqueue_admin_initialize', true ) ) {
			return;
		}
		if ( !parent::initialize() ) {
            return;
		}
//WPBPGen{{#if admin-assets_admin-page}}
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . PN_TEXTDOMAIN . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
//{{/if}}

//WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
//{{/if}}
//WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
//{{/if}}
	}


	//WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-css && admin-assets_admin-css}}
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return mixed Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		if ( !isset( $this->admin_view_page ) ) {
			return;
		}

//WPBPGen{{#if admin-assets_settings-css}}
		$screen = get_current_screen();
		if ( $this->admin_view_page === $screen->id || strpos( $_SERVER[ 'REQUEST_URI' ], 'index.php' ) || strpos( $_SERVER[ 'REQUEST_URI' ], get_bloginfo( 'wpurl' ) . '/wp-admin/' ) ) {
			wp_enqueue_style( PN_TEXTDOMAIN . '-settings-styles', plugins_url( 'assets/css/settings.css', PN_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PN_VERSION );
		}
//{{/if}}
//WPBPGen{{#if admin-assets_admin-css}}
		wp_enqueue_style( PN_TEXTDOMAIN . '-admin-styles', plugins_url( 'assets/css/admin.css', PN_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PN_VERSION );
//{{/if}}
	}

	//{{/if}}
	//WPBPGen{{#if admin-assets_admin-page && admin-assets_settings-js && admin-assets_admin-js}}
	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return mixed Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		if ( !isset( $this->admin_view_page ) ) {
			return;
		}

//WPBPGen{{#if admin-assets_settings-js}}
		$screen = get_current_screen();
		if ( $this->admin_view_page === $screen->id ) {
			wp_enqueue_script( PN_TEXTDOMAIN . '-settings-script', plugins_url( 'assets/js/settings.js', PN_PLUGIN_ABSOLUTE ), array( 'jquery', 'jquery-ui-tabs' ), PN_VERSION );
		}
//{{/if}}
//WPBPGen{{#if admin-assets_admin-js}}
		wp_enqueue_script( PN_TEXTDOMAIN . '-admin-script', plugins_url( 'assets/js/admin.js', PN_PLUGIN_ABSOLUTE ), array( 'jquery' ), PN_VERSION );
//{{/if}}
	}
	//{{/if}}

	//WPBPGen{{#if admin-assets_admin-page}}
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu
		 *
		 * @TODO:
		 *
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities

		  $this->admin_view_page = add_options_page(
		  __( 'Page Title', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' )
		  );
		 *
		 */
		/*
		 * Add a settings page for this plugin to the main menu
		 *
		 */
		$this->admin_view_page = add_menu_page( __( 'Page Title', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ), 'dashicons-hammer', 90 );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function display_plugin_admin_page() {
		include_once( PN_PLUGIN_ROOT . 'admin/views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since {{plugin_version}}
	 *
	 * @param array $links Array of links.
	 *
	 * @return array
	 */
	public function add_action_links( $links ) {
		return array_merge(
				array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=' . PN_TEXTDOMAIN ) . '">' . __( 'Settings' ) . '</a>',
//WPBPGen{{#if backend_donate-link-plugin-list}}
			'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=danielemte90@alice.it&item_name=Donation">' . __( 'Donate', PN_TEXTDOMAIN ) . '</a>'
//{{/if}}
				), $links
		);
	}
	//{{/if}}

}
