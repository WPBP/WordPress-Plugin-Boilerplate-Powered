<?php

/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 *
 * Plugin Name:       @TODO
 * Plugin URI:        @TODO
 * Description:       @TODO
 * Version:           1.0.0
 * Author:            @TODO
 * Author URI:        @TODO
 * Text Domain:       plugin-name
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * WordPress-Plugin-Boilerplate-Powered: v2.0.0
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
  die;
}

define( 'PN_VERSION', '1.0.0' );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', 'Plugin Name' );

function pn_load_plugin_textdomain() {
  load_plugin_textdomain( PN_TEXTDOMAIN, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'pn_load_plugin_textdomain', 1 );

require_once( plugin_dir_path( __FILE__ ) . 'composer/autoload.php' );

/*
 * Posts 2 Posts integration
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_P2P.php' );

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

new Fake_Page(
	  array(
    'slug' => 'fake_slug',
    'post_title' => 'Fake Page Title',
    'post_content' => 'This is the fake page content'
	  )
);

require_once( plugin_dir_path( __FILE__ ) . 'public/Plugin_Name.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_ActDeact.php' );

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

add_action( 'after_uninstall', 'pn_uninstall_hook' );

function pn_uninstall_hook() {
  global $wpdb;

  if ( is_multisite() ) {
    $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );
    if ( $blogs ) {
	foreach ( $blogs as $blog ) {
	  switch_to_blog( $blog[ 'blog_id' ] );
	  pn_uninstall();
	  restore_current_blog();
	}
    }
  } else {
    pn_uninstall();
  }
}

function pn_uninstall() {
  global $wp_roles;

  $plugin_roles = Plugin_Name::get_plugin_roles();

  /* 
    @TODO
    // Delete all transient and options
    delete_transient( 'TRANSIENT_NAME' );
    delete_option( 'OPTION_NAME' );
    remove_role( 'advanced' );
    // Remove custom file directory
    $upload_dir = wp_upload_dir();
    $directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
    if (is_dir($directory)) {
	foreach(glob($directory.'*.*') as $v){
	unlink($v);
    }
    rmdir($directory);
    // Delete post meta data
    $posts = get_posts(array('posts_per_page' => -1));
    foreach ($posts as $post) {
	$post_meta = get_post_meta($post->ID);
	delete_post_meta($post->ID, 'your-post-meta');
    }
    // Delete user meta data
    $users = get_users();
    foreach ($users as $user) {
	  delete_user_meta($user->ID, 'your-user-meta');
    }
    // Remove and optimize tables
    $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."TABLE_NAME`");
    $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
   */

  if ( !isset( $wp_roles ) ) {
    $wp_roles = new WP_Roles;
  }

  foreach ( $wp_roles->role_names as $role => $label ) {
    // If the role is a standard role, map the default caps, otherwise, map as a subscriber
    $caps = ( array_key_exists( $role, $plugin_roles ) ) ? $plugin_roles[ $role ] : $plugin_roles[ 'subscriber' ];

    // Loop and assign
    foreach ( $caps as $cap => $grant ) {
	// Check to see if the user already has this capability, if so, don't re-add as that would override grant
	if ( !isset( $wp_roles->roles[ $role ][ 'capabilities' ][ $cap ] ) ) {
	  $wp_roles->remove_cap( $cap );
	}
    }
  }
}
