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

/**
 * This class contain the Post Types and Taxonomy initialize code
 */
class Pn_PostTypes {

	/**
	 * Initialize the snippet
	 */
	function __construct() {
		add_action( 'init', array( $this, 'load_cpts' ) );
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
		//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
		// Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
		$tax = register_extended_post_type( 'demo', array(
			# Show all posts on the post type archive:
			'archive' => array(
				'nopaging' => true
			),
			# Add some custom columns to the admin screen:
			'admin_cols' => array(
				'featured_image' => array(
					'title' => 'Featured Image',
					'featured_image' => 'thumbnail'
				),
				'title',
				'genre' => array(
					'taxonomy' => 'demo-section'
				),
				'p2p' => array(
					'title' => 'Connected Posts',
					'connection' => 'demo_to_pages',
					'link' => 'edit'
				),
				'custom_field' => array(
					'title' => 'By Lib',
					'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
					'cap' => 'manage_options',
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
			'plural' => __( 'Demos', PN_TEXTDOMAIN ),
			'slug' => 'demo',
			'capability_type' => array( 'demo', 'demoes' ),
				) );
		//{{/unless}}
		//WPBPGen{{#unless frontend_cpt-search-support}}
		add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );
		//{{/unless}}
		//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
		$tax->add_taxonomy( 'demo-section', array(
			'hierarchical' => false,
			'show_ui' => false,
		) );
		// Create Custom Taxonomy https://github.com/johnbillion/extended-taxos
		register_extended_taxonomy( 'demo-section', 'demo', array(
			# Use radio buttons in the meta box for this taxonomy on the post editing screen:
			'meta_box' => 'radio',
			# Show this taxonomy in the 'At a Glance' dashboard widget:
			'dashboard_glance' => true,
			# Add a custom column to the admin screen:
			'admin_cols' => array(
				'featured_image' => array(
					'title' => 'Featured Image',
					'featured_image' => 'thumbnail'
				),
			),
				), array(
			# Override the base names used for labels:
			'singular' => __( 'Demo Category', PN_TEXTDOMAIN ),
			'plural' => __( 'Demo Categories', PN_TEXTDOMAIN ),
			'slug' => 'demo-cat',
			//WPBPGen{{#unless system_capability-system}}
			'capabilities' => array(
				'manage_terms' => 'manage_demoes',
				'edit_terms' => 'manage_demoes',
				'delete_terms' => 'manage_demoes',
				'assign_terms' => 'read_demo',
			)
				//{{/unless}}
		) );
		//{{/unless}}
	}
	//{{/unless}}

}

new Pn_PostTypes();
