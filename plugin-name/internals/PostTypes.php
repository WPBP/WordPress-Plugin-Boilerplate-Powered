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

namespace Plugin_Name\Internals;

use Plugin_Name\Engine\Base;

/**
 * Post Types and Taxonomies
 */
class PostTypes extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() { // phpcs:ignore
		parent::initialize();

		// WPBPGen{{#if libraries_johnbillion__extended-cpts}}
		\add_action( 'init', array( $this, 'load_cpts' ) );
		// {{/if}}
		// WPBPGen{{#if libraries_wpbp__cpt_columns}}
		/*
		 * Custom Columns
		 */
		$post_columns = new \CPT_columns( 'demo' );
		$post_columns->add_column(
			'cmb2_field',
			array(
				'label'    => \__( 'CMB2 Field', PN_TEXTDOMAIN ),
				'type'     => 'post_meta',
				'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text', // phpcs:ignore WordPress.DB
				'orderby'  => 'meta_value',
				'sortable' => true,
				'prefix'   => '<b>',
				'suffix'   => '</b>',
				'def'      => 'Not defined', // Default value in case post meta not found
				'order'    => '-1',
			)
		);
		// {{/if}}
		// WPBPGen{{#if libraries_seravo__wp-custom-bulk-actions}}
		/*
		 * Custom Bulk Actions
		 */
		$bulk_actions = new \Seravo_Custom_Bulk_Action( array( 'post_type' => 'demo' ) );
		$bulk_actions->register_bulk_action(
			array(
				'menu_text'    => 'Mark meta',
				'admin_notice' => 'Written something on custom bulk meta',
				'callback'     => static function( $post_ids ) {
					foreach ( $post_ids as $post_id ) {
						\update_post_meta( $post_id, '_demo_' . PN_TEXTDOMAIN . '_text', 'Random stuff' );
					}

					return true;
				},
			)
		);
		$bulk_actions->init();
		// {{/if}}
		// WPBPGen{{#if backend_bubble-notification-pending-cpt}}
		// Add bubble notification for cpt pending
		\add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
		// {{/if}}
		// WPBPGen{{#if frontend_cpt-search-support}}
		\add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );
		// {{/if}}
	}

	// WPBPGen{{#if frontend_cpt-search-support}}
	/**
	 * Add support for custom CPT on the search box
	 *
	 * @param \WP_Query $query WP_Query.
	 * @since {{plugin_version}}
	 * @return \WP_Query
	 */
	public function filter_search( \WP_Query $query ) {
		if ( $query->is_search && !\is_admin() ) {
			$post_types = $query->get( 'post_type' );

			if ( 'post' === $post_types ) {
				$post_types = array( $post_types );
				$query->set( 'post_type', \array_push( $post_types, array( 'demo' ) ) );
			}
		}

		return $query;
	}
	// {{/if}}

	// WPBPGen{{#if libraries_johnbillion__extended-cpts}}
	/**
	 * Load CPT and Taxonomies on WordPress
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function load_cpts() { //phpcs:ignore
		// Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
		$demo_cpt = \register_extended_post_type(
				'demo',
				array(
					// Show all posts on the post type archive:
					'archive'            => array(
						'nopaging' => true,
					),
					'slug'               => 'demo',
					'show_in_rest'       => true,
					'dashboard_activity' => true,
					// WPBPGen{{#if system_capability-system}}
					'capability_type'    => array( 'demo', 'demoes' ),
					// {{/if}}
					// Add some custom columns to the admin screen
					'admin_cols'         => array(
						'featured_image' => array(
							'title'          => 'Featured Image',
							'featured_image' => 'thumbnail',
						),
						'title',
						'genre'          => array(
							'taxonomy' => 'demo-section',
						),
						'custom_field'   => array(
							'title'    => 'By Lib',
							'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text', // phpcs:ignore
							'cap'      => 'manage_options',
						),
						'date'           => array(
							'title'   => 'Date',
							'default' => 'ASC',
						),
					),
					// Add a dropdown filter to the admin screen:
					'admin_filters'      => array(
						'genre' => array(
							'taxonomy' => 'demo-section',
						),
					),
			),
			array(
				// Override the base names used for labels:
				'singular' => \__( 'Demo', PN_TEXTDOMAIN ),
				'plural'   => \__( 'Demos', PN_TEXTDOMAIN ),
			)
		);

		$demo_cpt->add_taxonomy( 'demo-section', array( 'hierarchical' => false, 'show_ui' => false ) );
		// Create Custom Taxonomy https://github.com/johnbillion/extended-taxos
		\register_extended_taxonomy(
			'demo-section',
			'demo',
			array(
				// Use radio buttons in the meta box for this taxonomy on the post editing screen:
				'meta_box'         => 'radio',
				// Show this taxonomy in the 'At a Glance' dashboard widget:
				'dashboard_glance' => true,
				// Add a custom column to the admin screen:
				'admin_cols'       => array(
					'featured_image' => array(
						'title'          => 'Featured Image',
						'featured_image' => 'thumbnail',
					),
				),
				'slug'             => 'demo-cat',
				'show_in_rest'     => true,
				// WPBPGen{{#if system_capability-system}}
				'capabilities'     => array(
					'manage_terms' => 'manage_demoes',
					'edit_terms'   => 'manage_demoes',
					'delete_terms' => 'manage_demoes',
					'assign_terms' => 'read_demo',
				),
				// {{/if}}
			),
			array(
				// Override the base names used for labels:
				'singular' => \__( 'Demo Category', PN_TEXTDOMAIN ),
				'plural'   => \__( 'Demo Categories', PN_TEXTDOMAIN ),
			)
		);
	}
	// {{/if}}

	// WPBPGen{{#if backend_bubble-notification-pending-cpt}}
	/**
	 * Bubble Notification for pending cpt<br>
	 * NOTE: add in $post_types your cpts<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function pending_cpt_bubble() {
		global $menu;

		$post_types = array( 'demo' );

		foreach ( $post_types as $type ) {
			if ( !\post_type_exists( $type ) ) {
				continue;
			}

			// Count posts
			$cpt_count = \wp_count_posts( $type );

			if ( !$cpt_count->pending ) {
				continue;
			}

			// Locate the key of
			$key = self::recursive_array_search_php( 'edit.php?post_type=' . $type, $menu );

			// Not found, just in case
			if ( !$key ) {
				return;
			}

			// Modify menu item
			$menu[ $key ][ 0 ] .= \sprintf( //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				'<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>',
				$cpt_count->pending
			);
		}
	}

	/**
	 * Required for the bubble notification<br>
	 *
	 *  Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @param string $needle First parameter.
	 * @param array  $haystack Second parameter.
	 * @since {{plugin_version}}
	 * @return string|bool
	 */
	private function recursive_array_search_php( string $needle, array $haystack ) {
		foreach ( $haystack as $key => $value ) {
			$current_key = $key;

			if (
				$needle === $value ||
				( \is_array( $value ) &&
				false !== self::recursive_array_search_php( $needle, $value ) )
			) {
				return $current_key;
			}
		}

		return false;
	}
	// {{/if}}

}
