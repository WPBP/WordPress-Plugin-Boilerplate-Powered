<?php

/**
//WPBPGen{{#unless author_name}}
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
//{{/unless}}
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 *
 * Plugin Name:       {{plugin_name}}
 * Plugin URI:        @TODO
 * Description:       @TODO
 * Version:           {{plugin_version}}
 * Author:            {{author_name}}
 * Author URI:        {{author_url}}
 * Text Domain:       plugin-name
 * License:           {{author_license}}
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * Requires PHP:      5.6
 * WordPress-Plugin-Boilerplate-Powered: v2.3.0
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

define( 'PN_VERSION', '{{plugin_version}}' );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', '{{plugin_name}}' );
define( 'PN_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'PN_PLUGIN_ABSOLUTE', __FILE__ );

//WPBPGen{{#if language-files}}
/**
 * Load the textdomain of the plugin
 *
 * @return void
 */
function pn_load_plugin_textdomain() {
    $locale = apply_filters( 'plugin_locale', get_locale(), PN_TEXTDOMAIN );
    load_textdomain( PN_TEXTDOMAIN, trailingslashit( WP_PLUGIN_DIR ) . PN_TEXTDOMAIN . '/languages/' . PN_TEXTDOMAIN . '-' . $locale . '.mo' );
}

add_action( 'plugins_loaded', 'pn_load_plugin_textdomain', 1 );
//{{/if}}
if ( ! version_compare( PHP_VERSION, '5.6.0', '>=' ) ) {
	function pn_deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

	function pn_show_deactivation_notice() {
		echo wp_kses_post(
			sprintf(
				'<div class="notice notice-error"><p>%s</p></div>',
				__( '"Plugin Name" requires PHP 5.6 or newer.', PN_TEXTDOMAIN )
			)
		);
	}

	add_action( 'admin_init', 'pn_deactivate' );
	add_action( 'admin_notices', 'pn_show_deactivation_notice' );

	// Return early to prevent loading the other includes.
	return;
}

require_once( PN_PLUGIN_ROOT . 'vendor/autoload.php' );

require_once( PN_PLUGIN_ROOT . 'internals/functions.php' );
require_once( PN_PLUGIN_ROOT . 'internals/debug.php' );

//WPBPGen{{#unless libraries_freemius__wordpress-sdk}}
/**
 * Create a helper function for easy SDK access.
 *
 * @global type $pn_fs
 * @return object
 */
function pn_fs() {
	global $pn_fs;

	if ( !isset( $pn_fs ) ) {
		require_once( PN_PLUGIN_ROOT . 'vendor/freemius/wordpress-sdk/start.php' );
		$pn_fs = fs_dynamic_init(
			array(
				'id'             => '',
				'slug'           => 'plugin-name',
				'public_key'     => '',
				'is_live'        => false,
				'is_premium'     => true,
				'has_addons'     => false,
				'has_paid_plans' => true,
				'menu'           => array(
					'slug' => 'plugin-name',
				),
			)
		);
	}

	return $pn_fs;
}

// Init Freemius.
// pn_fs();
//{{/unless}}

if ( ! wp_installing() ) {
	add_action( 'plugins_loaded', array( 'Pn_Initialize', 'get_instance' ) );
}
