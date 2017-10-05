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
 * This class should ideally be used to work with the public-facing side of the WordPress site.
 */
class Plugin_Name {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	private static $instance;
	//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
	/**
	 * Array of cpts of the plugin
	 *
	 * @var array
	 */
	protected $cpts = array( 'demo' );

	//{{/unless}}

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'load_cpts' ) );
		//{{/unless}}
		//WPBPGen{{#unless frontend_body-class}}
		add_filter( 'body_class', array( $this, 'add_pn_class' ), 10, 3 );
		//{{/unless}}
		//WPBPGen{{#unless frontend_template-system}}
		// Override the template hierarchy for load /templates/content-demo.php
		add_filter( 'template_include', array( $this, 'load_content_demo' ) );
		//{{/unless}}
		//WPBPGen{{#unless public-assets_css}}
		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		//{{/unless}}
		//WPBPGen{{#unless public-assets_js}}
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//{{/unless}}
		//WPBPGen{{#unless frontend_wp-localize-script}}
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js_vars' ) );
		//{{/unless}}
		//WPBPGen{{#unless custom_action}}
		/**
		 * Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( '@TODO', array( $this, 'action_method_name' ) );
		//{{/unless}}
		//WPBPGen{{#unless custom_filter}}
		add_filter( '@TODO', array( $this, 'filter_method_name' ) );
		//{{/unless}}
		//WPBPGen{{#unless custom_shortcode}}
		add_shortcode( '@TODO', array( $this, 'shortcode_method_name' ) );
		//{{/unless}}
		//WPBPGen{{#unless libraries_wpbp__widgets-helper}}
		require_once( plugin_dir_path( __FILE__ ) . 'widgets/sample.php' );
		//{{/unless}}
	}

	//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
	/**
	 * Return the cpts
	 *
	 * @since {{plugin_version}}
	 *
	 * @return array
	 */
	public function get_cpts() {
		return $this->cpts;
	}

	//{{/unless}}

	/**
	 * Return an instance of this class.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
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
	//WPBPGen{{#unless public-assets_css}}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( PN_TEXTDOMAIN . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), PN_VERSION );
	}

	//{{/unless}}
	//WPBPGen{{#unless public-assets_js}}
	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( PN_TEXTDOMAIN . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), PN_VERSION );
	}

	//{{/unless}}
	//WPBPGen{{#unless frontend_wp-localize-script}}
	/**
	 * Print the PHP var in the HTML of the frontend for access by JavaScript
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public function enqueue_js_vars() {
		wp_localize_script( PN_TEXTDOMAIN . '-plugin-script', 'pn_js_vars', array(
			'alert' => __( 'Hey! You have clicked the button!', PN_TEXTDOMAIN )
				)
		);
	}

	//{{/unless}}
	//WPBPGen{{#unless frontend_body-class}}
	/**
	 * Add class in the body on the frontend
	 * 
	 * @param array $classes THe array with all the classes of the page.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return array
	 */
	public function add_pn_class( $classes ) {
		$classes[] = PN_TEXTDOMAIN;
		return $classes;
	}

	//{{/unless}}
	//WPBPGen{{#unless frontend_template-system}}
	/**
	 * Example for override the template system on the frontend
	 * 
	 * @param string $original_template The original templace HTML.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return string
	 */
	public function load_content_demo( $original_template ) {
		if ( is_singular( 'demo' ) && in_the_loop() ) {
			return wpbp_get_template_part( PN_TEXTDOMAIN, 'content', 'demo', false );
		}
		return $original_template;
	}

	//{{/unless}}
	//WPBPGen{{#unless custom_action}}
	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}

	//{{/unless}}
	//WPBPGen{{#unless custom_filter}}
	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 * 
	 * @param array $param The paramters.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return array
	 */
	public function filter_method_name( $param ) {
		// @TODO: Define your filter hook callback here
		return $param;
	}

	//{{/unless}}
	//WPBPGen{{#unless custom_shortcode}}
	/**
	 * NOTE:  Shortcode simple set of functions for creating macro codes for use
	 * 		  in post content.
	 *
	 *        Reference:  http://codex.wordpress.org/Shortcode_API
	 * 
	 * @param array $atts The paramters.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return array
	 */
	public function shortcode_method_name( $atts ) {
		//With this you can define the default proprietary for your shortcode
		$atts = shortcode_atts( array(
			'number' => '1',
				), $atts );
		// @TODO: Define your shortcode here
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

/*
 * @TODO:
 *
 * - 9999 is used for load the plugin as last for resolve some
 *   problems when the plugin use API of other plugins, remove
 *   if you don' want this
 */

add_action( 'plugins_loaded', array( 'Plugin_Name', 'get_instance' ), 9999 );
