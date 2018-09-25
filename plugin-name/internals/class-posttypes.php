<?php

/**
 * Plugin_name
 *
 * @package   Plugin_name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * This class contain the Post Types and Taxonomy initialize code
 */
class Pn_PostTypes extends Pn_Base {

	/**
	 * Initialize the custom post types
	 */
	public function initialize() {
		parent::initialize();
		//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
		add_action( 'init', array( $this, 'load_cpts' ) );
		//{{/unless}}
		//WPBPGen{{#unless libraries_wpbp__cpt_columns}}
		/*
		 * Custom Columns
		 */
		$post_columns = new CPT_columns( 'demo' );
		$post_columns->add_column( 'cmb2_field', array(
				'label'    => __( 'CMB2 Field', PN_TEXTDOMAIN ),
				'type'     => 'post_meta',
				'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
				'orderby'  => 'meta_value',
				'sortable' => true,
				'prefix'   => '<b>',
				'suffix'   => '</b>',
				'def'      => 'Not defined', // Default value in case post meta not found
				'order'    => '-1',
			)
		);
		//{{/unless}}
		//WPBPGen{{#unless libraries_johnbillion__extended-cpts && backend_dashboard-activity}}
		// Activity Dashboard widget for your cpts
		add_filter( 'dashboard_recent_posts_query_args', array( $this, 'cpt_activity_dashboard_support' ), 10, 1 );
		//{{/unless}}
		//WPBPGen{{#unless libraries_johnbillion__extended-cpts && backend_bubble-notification-pending-cpt}}
		// Add bubble notification for cpt pending
		add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
		//{{/unless}}
		//WPBPGen{{#unless frontend_cpt-search-support}}
		add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );
		//{{/unless}}
	}

	//WPBPGen{{#unless frontend_cpt-search-support}}
	/**
	 * Add support for custom CPT on the search box
	 *
	 * @param object $query Wp_Query.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return object
	 */
	public function filter_search( $query ) {
		if ( $query->is_search && !is_admin() ) {
			$post_types = $query->get( 'post_type' );
			if ( $post_types === 'post' ) {
				$post_types = array();
				$query->set( 'post_type', array_push( $post_types, $this->cpts ) );
			}
		}

		return $query;
	}
	//{{/unless}}

	//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
	/**
	 * Load CPT and Taxonomies on WordPress
	 *
	 * @return void
	 */
	public function load_cpts() {
		// Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
		$tax = register_extended_post_type( 'demo', array(
			// Show all posts on the post type archive:
			'archive' => array(
				'nopaging' => true
			),
			'slug'            => 'demo',
			'show_in_rest'    => true,
			'capability_type' => array( 'demo', 'demoes' ),
			// Add some custom columns to the admin screen:
			'admin_cols' => array(
				'featured_image' => array(
					'title'          => 'Featured Image',
					'featured_image' => 'thumbnail'
				),
				'title',
				'genre' => array(
					'taxonomy' => 'demo-section'
				),
				'custom_field' => array(
					'title' => 'By Lib',
					'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
					'cap'      => 'manage_options',
				),
				'date' => array(
					'title' => 'Date',
					'default' => 'ASC',
				),
			),
			# Add a dropdown filter to the admin screen:
			'admin_filters' => array(
				'genre' => array(
					'taxonomy' => 'demo-section'
				)
			)
		), array(
			# Override the base names used for labels:
			'singular' => __( 'Demo', PN_TEXTDOMAIN ),
			'plural'   => __( 'Demos', PN_TEXTDOMAIN ),
			)
		);

		$tax->add_taxonomy( 'demo-section', array(
			'hierarchical' => false,
			'show_ui' => false,
		) );
		// Create Custom Taxonomy https://github.com/johnbillion/extended-taxos
		register_extended_taxonomy( 'demo-section', 'demo', array(
			// Use radio buttons in the meta box for this taxonomy on the post editing screen:
			'meta_box'         => 'radio',
			// Show this taxonomy in the 'At a Glance' dashboard widget:
			'dashboard_glance' => true,
			// Add a custom column to the admin screen:
			'admin_cols'       => array(
				'featured_image' => array(
					'title'          => 'Featured Image',
					'featured_image' => 'thumbnail'
				),
			),
			'slug'             => 'demo-cat',
			'show_in_rest'     => true,
			//WPBPGen{{#unless system_capability-system}}
			'capabilities'     => array(
				'manage_terms' => 'manage_demoes',
				'edit_terms'   => 'manage_demoes',
				'delete_terms' => 'manage_demoes',
				'assign_terms' => 'read_demo',
			),
			//{{/unless}}
		), array(
			// Override the base names used for labels:
			'singular' => __( 'Demo Category', PN_TEXTDOMAIN ),
			'plural'   => __( 'Demo Categories', PN_TEXTDOMAIN ),
		)
		);
	}
	//{{/unless}}

	//WPBPGen{{#unless backend_dashboard-activity && libraries_johnbillion__extended-cpts}}
	/**
	 * Add the recents post type in the activity widget<br>
	 * NOTE: add in $post_types your cpts
	 *
	 * @param array $query_args The content of the widget.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return array
	 */
	public function cpt_activity_dashboard_support( $query_args ) {
		if ( !is_array( $query_args[ 'post_type' ] ) ) {
			// Set default post type
			$query_args[ 'post_type' ] = array( 'page' );
		}

		$query_args[ 'post_type' ] = array_merge( $query_args[ 'post_type' ], array( 'demo' ) );
		return $query_args;
	}

	//{{/unless}}
	//WPBPGen{{#unless libraries_johnbillion__extended-cpts && backend_bubble-notification-pending-cpt}}
	/**
	 * Bubble Notification for pending cpt<br>
	 * NOTE: add in $post_types your cpts<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function pending_cpt_bubble() {
		global $menu;

		$post_types = array( 'demo' );
		foreach ( $post_types as $type ) {
			if ( !post_type_exists( $type ) ) {
				continue;
			}

			// Count posts
			$cpt_count = wp_count_posts( $type );

			if ( $cpt_count->pending ) {
				// Menu link suffix, Post is different from the rest
				$suffix = ( 'post' === $type ) ? '' : '?post_type=' . $type;

				// Locate the key of
				$key = self::recursive_array_search_php( 'edit.php' . $suffix, $menu );

				// Not found, just in case
				if ( !$key ) {
					return;
				}

				// Modify menu item
				$menu[ $key ][ 0 ] .= sprintf(
					'<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>', $cpt_count->pending
				);
			}
		}
	}

	/**
	 * Required for the bubble notification<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @param array $needle   First parameter.
	 * @param array $haystack Second parameter.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return mixed
	 */
	private function recursive_array_search_php( $needle, $haystack ) {
		foreach ( $haystack as $key => $value ) {
			$current_key = $key;
			if ( $needle === $value || ( is_array( $value ) && self::recursive_array_search_php( $needle, $value ) !== false ) ) {
				return $current_key;
			}
		}

		return false;
	}
	//{{/unless}}

}
