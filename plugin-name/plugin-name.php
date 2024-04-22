<?php

/**
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
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.4
 * WordPress-Plugin-Boilerplate-Powered: v3.3.0
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
define( 'PN_MIN_PHP_VERSION', '7.4' );
define( 'PN_WP_VERSION', '5.3' );

// WPBPGen{{#if language-files}}
add_action(
	'init',
	static function () {
		load_plugin_textdomain( PN_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	);

// {{/if}}

$plugin_name_libraries = require PN_PLUGIN_ROOT . 'vendor/autoload.php'; //phpcs:ignore

require_once PN_PLUGIN_ROOT . 'functions/functions.php';
// WPBPGen{{#if libraries_wpbp__debug}}
require_once PN_PLUGIN_ROOT . 'functions/debug.php';
// {{/if}}

// Add your new plugin on the wiki: https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate

// WPBPGen{{#if libraries_micropackage__requirements}}
$requirements = new \Micropackage\Requirements\Requirements(
	'Plugin Name',
	array(
		'php'            => PN_MIN_PHP_VERSION,
		'php_extensions' => array( 'mbstring' ),
		'wp'             => PN_WP_VERSION,
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
			$pn_fs->add_filter(
				'support_forum_url',
				static function ( $wp_org_support_forum_url ) { //phpcs:ignore
					return 'https://your-url.test';
				}
			);
		}
	}

	return $pn_fs;
}

// pn_fs();
// {{/if}}

// WPBPGen{{#if libraries_yahnis-elsts__plugin-update-checker}}
// Documentation to integrate GitHub, GitLab or BitBucket https://github.com/YahnisElsts/plugin-update-checker/blob/master/README.md
Puc_v4_Factory::buildUpdateChecker( 'https://github.com/user-name/repo-name/', __FILE__, 'unique-plugin-or-theme-slug' );
// {{/if}}

if ( ! wp_installing() ) {
	// WPBPGen{{#if act-deact_actdeact}}
	register_activation_hook( PN_TEXTDOMAIN . '/' . PN_TEXTDOMAIN . '.php', array( new \Plugin_Name\Backend\ActDeact, 'activate' ) );
	register_deactivation_hook( PN_TEXTDOMAIN . '/' . PN_TEXTDOMAIN . '.php', array( new \Plugin_Name\Backend\ActDeact, 'deactivate' ) );
	// {{/if}}
	add_action(
		'plugins_loaded',
		static function () use ( $plugin_name_libraries ) {
			new \Plugin_Name\Engine\Initialize( $plugin_name_libraries );
		}
	);
}
