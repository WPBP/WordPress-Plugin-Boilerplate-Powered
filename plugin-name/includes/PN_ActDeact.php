<?php

/**
 * This class contain the activate and deactive method and relates.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 */
class Pn_ActDeact {

  /**
   * Initialize the Act/Deact
   */
  function __construct() {
    $plugin = Plugin_Name::get_instance();
    $this->plugin_roles = $plugin->get_plugin_roles();
    // Activate plugin when new blog is added
    add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

    register_activation_hook( __FILE__, array( $this, 'activate' ) );
    register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
  }

  /**
   * Fired when the plugin is activated.
   *
   * @since    1.0.0
   *
   * @param boolean $network_wide True if active in a multiste, false if classic site.
   * 
   * @return void
   */
  public static function activate( $network_wide ) {
    if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	if ( $network_wide ) {
	  // Get all blog ids
	  $blog_ids = self::get_blog_ids();
	  foreach ( $blog_ids as $blog_id ) {
	    switch_to_blog( $blog_id );
	    self::single_activate();
	    restore_current_blog();
	  }
	} else {
	  self::single_activate();
	}
    } else {
	self::single_activate();
    }
  }

  /**
   * Fired when the plugin is deactivated.
   *
   * @since    1.0.0
   *
   * @param boolean $network_wide True if WPMU superadmin uses
   *                              "Network Deactivate" action, false if
   *                              WPMU is disabled or plugin is
   *                              deactivated on an individual blog.
   * 
   * @return void
   */
  public static function deactivate( $network_wide ) {
    if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	if ( $network_wide ) {
	  // Get all blog ids
	  $blog_ids = self::get_blog_ids();
	  foreach ( $blog_ids as $blog_id ) {
	    switch_to_blog( $blog_id );
	    self::single_deactivate();
	    restore_current_blog();
	  }
	} else {
	  self::single_deactivate();
	}
    } else {
	self::single_deactivate();
    }
  }

  /**
   * Fired when a new site is activated with a WPMU environment.
   *
   * @since    1.0.0
   *
   * @param integer $blog_id ID of the new blog.
   * 
   * @return void
   */
  public function activate_new_site( $blog_id ) {
    if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
	return;
    }

    switch_to_blog( $blog_id );
    self::single_activate();
    restore_current_blog();
  }

  /**
   * Get all blog ids of blogs in the current network that are:
   * - not archived
   * - not spam
   * - not deleted
   *
   * @since    1.0.0
   *
   * @return array|false The blog ids, false if no matches.
   */
  private static function get_blog_ids() {
    global $wpdb;

    // Get an array of blog ids
    $sql = 'SELECT blog_id FROM ' . $wpdb->blogs .
		" WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

    return $wpdb->get_col( $sql );
  }

  /**
   * Fired for each blog when the plugin is activated.
   *
   * @since    1.0.0
   * @return void
   */
  private static function single_activate() {
    $plugin = Plugin_Name::get_instance();
    $plugin_slug = $plugin->get_plugin_slug();
    $plugin_name = $plugin->get_plugin_name();
    $plugin_roles = $plugin->get_plugin_roles();
    // Requirements Detection System - read the doc/example in the library file
    require_once( plugin_dir_path( __FILE__ ) . 'requirements.php' );
    new Plugin_Requirements( $plugin_name, $plugin_slug, array(
	  'WP' => new WordPress_Requirement( '4.1.0' )
		) );

    // @TODO: Define activation functionality here
    // add_role( 'advanced', __( 'Advanced' ) ); //Add a custom roles

    global $wp_roles;
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
	    $wp_roles->add_cap( $role, $cap, $grant );
	  }
	}
    }
    // Clear the permalinks
    flush_rewrite_rules();
  }

  /**
   * Fired for each blog when the plugin is deactivated.
   *
   * @since    1.0.0
   * @return void
   */
  private static function single_deactivate() {
    // @TODO: Define deactivation functionality here
    // Clear the permalinks
    flush_rewrite_rules();
  }

}

new Pn_ActDeact();
