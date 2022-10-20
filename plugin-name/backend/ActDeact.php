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

namespace Plugin_Name\Backend;

use Plugin_Name\Engine\Base;

/**
 * Activate and deactive method of the plugin and relates.
 */
class ActDeact extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Activate plugin when new blog is added
		\add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// WPBPGen{{#if system_upgrade-procedure}}
		\add_action( 'admin_init', array( $this, 'upgrade_procedure' ) );
		// {{/if}}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @param int $blog_id ID of the new blog.
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function activate_new_site( int $blog_id ) {
		if ( 1 !== \did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		\switch_to_blog( $blog_id );
		self::single_activate();
		\restore_current_blog();
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param bool|null $network_wide True if active in a multiste, false if classic site.
	 * @since {{plugin_version}}
	 * @return void
	 */
	public static function activate( $network_wide ) {
		if ( \function_exists( 'is_multisite' ) && \is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				/** @var array<\WP_Site> $blogs */
				$blogs = \get_sites();

				foreach ( $blogs as $blog ) {
					\switch_to_blog( (int) $blog->blog_id );
					self::single_activate();
					\restore_current_blog();
				}

				return;
			}
		}

		self::single_activate();
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param bool $network_wide True if WPMU superadmin uses
	 * "Network Deactivate" action, false if
	 * WPMU is disabled or plugin is
	 * deactivated on an individual blog.
	 * @since {{plugin_version}}
	 * @return void
	 */
	public static function deactivate( bool $network_wide ) {
		if ( \function_exists( 'is_multisite' ) && \is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				/** @var array<\WP_Site> $blogs */
				$blogs = \get_sites();

				foreach ( $blogs as $blog ) {
					\switch_to_blog( (int) $blog->blog_id );
					self::single_deactivate();
					\restore_current_blog();
				}

				return;
			}
		}

		self::single_deactivate();
	}

	// WPBPGen{{#if system_capability-system}}
	/**
	 * Add admin capabilities
	 *
	 * @return void
	 */
	public static function add_capabilities() {
		// Add the capabilites to all the roles
		$caps  = array(
			'create_plugins',
			'read_demo',
			'read_private_demoes',
			'edit_demo',
			'edit_demoes',
			'edit_private_demoes',
			'edit_published_demoes',
			'edit_others_demoes',
			'publish_demoes',
			'delete_demo',
			'delete_demoes',
			'delete_private_demoes',
			'delete_published_demoes',
			'delete_others_demoes',
			'manage_demoes',
		);
		$roles = array(
			\get_role( 'administrator' ),
			\get_role( 'editor' ),
			\get_role( 'author' ),
			\get_role( 'contributor' ),
			\get_role( 'subscriber' ),
		);

		foreach ( $roles as $role ) {
			foreach ( $caps as $cap ) {
				if ( \is_null( $role ) ) {
					continue;
				}

				$role->add_cap( $cap );
			}
		}
	}

	/**
	 * Remove capabilities to specific roles
	 *
	 * @return void
	 */
	public static function remove_capabilities() {
		// Remove capabilities to specific roles
		$bad_caps = array(
			'create_demoes',
			'read_private_demoes',
			'edit_demo',
			'edit_demoes',
			'edit_private_demoes',
			'edit_published_demoes',
			'edit_others_demoes',
			'publish_demoes',
			'delete_demo',
			'delete_demoes',
			'delete_private_demoes',
			'delete_published_demoes',
			'delete_others_demoes',
			'manage_demoes',
		);
		$roles    = array(
			\get_role( 'author' ),
			\get_role( 'contributor' ),
			\get_role( 'subscriber' ),
		);

		foreach ( $roles as $role ) {
			foreach ( $bad_caps as $cap ) {
				if ( \is_null( $role ) ) {
					continue;
				}

				$role->remove_cap( $cap );
			}
		}
	}

	// {{/if}}
	// WPBPGen{{#if system_upgrade-procedure}}
	/**
	 * Upgrade procedure
	 *
	 * @return void
	 */
	public static function upgrade_procedure() {
		if ( !\is_admin() ) {
			return;
		}

		$version = \strval( \get_option( 'plugin-name-version' ) );

		if ( !\version_compare( PN_VERSION, $version, '>' ) ) {
			return;
		}

		\update_option( 'plugin-name-version', PN_VERSION );
		\delete_option( PN_TEXTDOMAIN . '_fake-meta' );
	}
	// {{/if}}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
		// WPBPGen{{#if system_capability-system}}
		// add_role( 'advanced', __( 'Advanced' ) ); //Add a custom roles
		self::add_capabilities();
		// {{/if}}
		// WPBPGen{{#if system_upgrade-procedure}}
		self::upgrade_procedure();
		// {{/if}}
		// Clear the permalinks
		\flush_rewrite_rules();
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
		// WPBPGen{{#if system_capability-system}}
		self::remove_capabilities();
		// {{/if}}
		// Clear the permalinks
		\flush_rewrite_rules();
	}

}
