<?php

/**
//WPBPGen{{#if author_name}}
 * The WordPress Plugin Boilerplate Powered.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
//{{/if}}
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 *
 * Plugin Name:     {{plugin_name}}
 * Plugin URI:      @TODO
 * Description:     @TODO
 * Version:         {{plugin_version}}
 * Author:          {{author_name}}
 * Author URI:      {{author_url}}
 * Text Domain:     plugin-name
 * License:         {{author_license}}
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.0
 * WordPress-Plugin-Boilerplate-Powered: v3.2.0
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

define( 'PN_VERSION', '{{plugin_version}}' );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', '{{plugin_name}}' );
define( 'PN_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'PN_PLUGIN_ABSOLUTE', __FILE__ );

// WPBPGen{{#if language-files}}
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
// {{/if}}
if ( version_compare( PHP_VERSION, '5.6.0', '<' ) ) {

	function pn_deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

	function pn_show_deactivation_notice() {
		echo wp_kses_post(
			sprintf(
				'<div class="notice notice-error"><p>%s</p></div>',
				__( '"{{plugin_name}}" requires PHP 5.6 or newer.', PN_TEXTDOMAIN )
			)
		);
	}

	add_action( 'admin_init', 'pn_deactivate' );
	add_action( 'admin_notices', 'pn_show_deactivation_notice' );

	// Return early to prevent loading the other includes.
	return;
}

require_once PN_PLUGIN_ROOT . 'vendor/autoload.php';

require_once PN_PLUGIN_ROOT . 'functions/functions.php';
// WPBPGen{{#if libraries_wpbp__debug}}
require_once PN_PLUGIN_ROOT . 'functions/debug.php';
// {{/if}}

// Add your new plugin on the wiki: https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate

// WPBPGen{{#if libraries_micropackage__requirements}}
$requirements = new \Micropackage\Requirements\Requirements(
     'Plugin Name',
    array(
	'php'            => '7.0',
	'php_extensions' => array( 'mbstring' ),
	'wp'             => '5.3',
	// 'plugins'            => array(
	// array( 'file' => 'hello-dolly/hello.php', 'name' => 'Hello Dolly', 'version' => '1.5' )
	// ),
)
    );
if ( ! $requirements->satisfied() ) {
	$requirements->print_notice();
	return;
}

// {{/if}}

// WPBPGen{{#if libraries_freemius__wordpress-sdk}}
/**
 * Create a helper function for easy SDK access.
 *
 * @global type $pn_fs
 * @return object
 */
function pn_fs() {
	global $pn_fs;

	if ( !isset( $pn_fs ) ) {
		require_once PN_PLUGIN_ROOT . 'vendor/freemius/wordpress-sdk/start.php';
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


		if ( $pn_fs->is_premium() ) {
			$pn_fs->add_filter( 'support_forum_url', 'gt_premium_support_forum_url' );

			function gt_premium_support_forum_url( $wp_org_support_forum_url ) {
				return 'http://your url';
			}

		}
	}

	return $pn_fs;
}

// Init Freemius.
// pn_fs();
// {{/if}}

// WPBPGen{{#if libraries_yahnis-elsts__plugin-update-checker}}
// Documentation to integrate GitHub, GitLab or BitBucket https://github.com/YahnisElsts/plugin-update-checker/blob/master/README.md
$my_update_checker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/user-name/repo-name/',
	__FILE__,
	'unique-plugin-or-theme-slug'
);
// {{/if}}

if ( ! wp_installing() ) {
	add_action( 'plugins_loaded', 'Plugin_Name\\Engine\\Initialize\\get_instance' );
}
