<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
// If uninstall not called from WordPress, then exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb, $wp_roles;

$plugin_roles = array(
	'editor' => array(
		'edit_demo' => true,
		'edit_others_demo' => true,
	),
	'author' => array(
		'edit_demo' => true,
		'edit_others_demo' => false,
	),
	'subscriber' => array(
		'edit_demo' => false,
		'edit_others_demo' => false,
	),
);

if ( is_multisite() ) {

	$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );
	/* @TODO: delete all transient, options and files you may have added
	  delete_transient( 'TRANSIENT_NAME' );
	  delete_option('OPTION_NAME');
	  //info: remove custom file directory for main site
	  $upload_dir = wp_upload_dir();
	  $directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
	  if (is_dir($directory)) {
	  foreach(glob($directory.'*.*') as $v){
	  unlink($v);
	  }
	  rmdir($directory);
	  }
	 */
	if ( $blogs ) {

		foreach ( $blogs as $blog ) {
			switch_to_blog( $blog[ 'blog_id' ] );
			/* @TODO: delete all transient, options and files you may have added
			  delete_transient( 'TRANSIENT_NAME' );
			  delete_option('OPTION_NAME');
			  //info: remove custom file directory for main site
			  $upload_dir = wp_upload_dir();
			  $directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
			  if (is_dir($directory)) {
			  foreach(glob($directory.'*.*') as $v){
			  unlink($v);
			  }
			  rmdir($directory);
			  }
			  //info: remove and optimize tables
			  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."TABLE_NAME`");
			  $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
			 */

			if ( !isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles;
			}

			foreach ( $wp_roles->role_names as $role => $label ) {
				//if the role is a standard role, map the default caps, otherwise, map as a subscriber
				$caps = ( array_key_exists( $role, $plugin_roles ) ) ? $plugin_roles[ $role ] : $plugin_roles[ 'subscriber' ];

				//loop and assign
				foreach ( $caps as $cap => $grant ) {
					//check to see if the user already has this capability, if so, don't re-add as that would override grant
					if ( !isset( $wp_roles->roles[ $role ][ 'capabilities' ][ $cap ] ) ) {
						$wp_roles->remove_cap( $cap );
					}
				}
			}

			restore_current_blog();
		}
	}
} else {
	/* @TODO: delete all transient, options and files you may have added
	  delete_transient( 'TRANSIENT_NAME' );
	  delete_option('OPTION_NAME');
	  //info: remove custom file directory for main site
	  $upload_dir = wp_upload_dir();
	  $directory = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . "CUSTOM_DIRECTORY_NAME" . DIRECTORY_SEPARATOR;
	  if (is_dir($directory)) {
	  foreach(glob($directory.'*.*') as $v){
	  unlink($v);
	  }
	  rmdir($directory);
	  }
	  //info: remove and optimize tables
	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."TABLE_NAME`");
	  $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
	 */

	if ( !isset( $wp_roles ) ) {
		$wp_roles = new WP_Roles;
	}

	foreach ( $wp_roles->role_names as $role => $label ) {
		//if the role is a standard role, map the default caps, otherwise, map as a subscriber
		$caps = ( array_key_exists( $role, $plugin_roles ) ) ? $plugin_roles[ $role ] : $plugin_roles[ 'subscriber' ];

		//loop and assign
		foreach ( $caps as $cap => $grant ) {
			//check to see if the user already has this capability, if so, don't re-add as that would override grant
			if ( !isset( $wp_roles->roles[ $role ][ 'capabilities' ][ $cap ] ) ) {
				$wp_roles->remove_cap( $cap );
			}
		}
	}
}