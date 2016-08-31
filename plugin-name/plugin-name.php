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
 * @license   {{author_license}}
 * @link      {{author_url}}
 * @copyright {{author_copyright}}
 *
 * Plugin Name:       @TODO
 * Plugin URI:        @TODO
 * Description:       @TODO
 * Version:           {{plugin_version}}
 * Author:            @TODO
 * Author URI:        @TODO
 * Text Domain:       plugin-name
 * License:           {{author_license}}
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * WordPress-Plugin-Boilerplate-Powered: v2.0.0
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
  die;
}

define( 'PN_VERSION', '{{plugin_version}}' );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', '{{plugin_name}}' );

function pn_load_plugin_textdomain() {
  load_plugin_textdomain( PN_TEXTDOMAIN, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'pn_load_plugin_textdomain', 1 );

require_once( plugin_dir_path( __FILE__ ) . 'composer/autoload.php' );

//WPBPGen{{#unless libraries_freemius.wordpress-sdk}}
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

require_once( plugin_dir_path( __FILE__ ) . 'public/Plugin_Name.php' );
//WPBPGen{{#unless act-deact_actdeact}}
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_ActDeact.php' );
//{{/unless}}
//WPBPGen{{#unless act-deact_uninstall}}
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_Uninstall.php' );
//{{/unless}}
//WPBPGen{{#unless libraries_wpackagist-plugin.posts-to-posts}}
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_P2P.php' );
//{{/unless}}
//WPBPGen{{#unless libraries_wpbp.fakepage}}
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_FakePage.php' );
//{{/unless}}
//WPBPGen{{#unless admin-page}}
/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */

if ( is_admin() && (!defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
  require_once( plugin_dir_path( __FILE__ ) . 'admin/Plugin_Name_Admin.php' );
}
//{{/unless}}
