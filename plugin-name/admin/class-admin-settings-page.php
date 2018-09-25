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
class Pn_Admin_Settings_Page extends Pn_Admin_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . PN_TEXTDOMAIN . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
	}

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

		 add_options_page( __( 'Page Title', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ) );
		 *
		 */
		/*
		 * Add a settings page for this plugin to the main menu
		 *
		 */
		add_menu_page( __( 'Plugin Name Settings', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ), 'dashicons-hammer', 90 );
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
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . PN_TEXTDOMAIN ) . '">' . __( 'Settings', PN_TEXTDOMAIN ) . '</a>',
				//WPBPGen{{#if backend_donate-link-plugin-list}}
				'donate'   => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=danielemte90@alice.it&item_name=Donation">' . __( 'Donate', PN_TEXTDOMAIN ) . '</a>',
				//{{/if}}
			),
            $links
		);
	}

}
