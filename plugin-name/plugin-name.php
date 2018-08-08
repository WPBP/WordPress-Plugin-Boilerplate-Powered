<?php

/**
//WPBPGen{{#unless author_name}}
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
//{{/unless}}
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
define( 'PN_PLUGIN_ABSOLUTE',  __FILE__  );

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

require_once( PN_PLUGIN_ROOT . 'vendor/autoload.php' );

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
		$pn_fs = fs_dynamic_init( array(
			'id' => '',
			'slug' => 'plugin-name',
			'public_key' => '',
			'is_live' => false,
			'is_premium' => true,
			'has_addons' => false,
			'has_paid_plans' => true,
			'menu' => array(
				'slug' => 'plugin-name'
			),
				) );
	}

	return $pn_fs;
}

// Init Freemius.
// pn_fs();
//{{/unless}}

/**
 * Auto load our class files
 *
 * @param string $class Class name.
 *
 * @return void
 */
function pn_auto_load( $class ) {
	static $classes = null;
	if ( $classes === null ) {
		$folders = array(
			"admin",
			"ajax",
			"cli",
			"includes",
			"integrations",
			"public"
		);
		foreach($folders as $folder) {
            $files = glob( PN_PLUGIN_ROOT . $folder . '/*.{php}', GLOB_BRACE);
            foreach($files as $file) {
                if( false !== strpos($file, 'index.php') ) {
                    continue;
                }

                $class_name = ucwords(basename($file,'.php'), '-');
                $class_name = str_replace('Class', 'Pn', $class_name );
                $class_name = str_replace('-', '_', $class_name);
                // TODO: check classname
                error_log((print_r($class_name, true)));
                if ( ! class_exists( $class_name )  ) {
                    //require_once $file;
                }
            }
        }
	}

}

if ( function_exists( 'spl_autoload_register' ) ) {
	spl_autoload_register( 'pn_auto_load' );
}
