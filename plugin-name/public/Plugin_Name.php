<?php

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @license   {{author_license}}
 * @link      {{author_url}}
 * @copyright {{author_copyright}}
 */
class Plugin_Name {

  /**
   * Instance of this class.
   *
   * @var      object
   *
   * @since    1.0.0
   */
  private static $instance;
  //WPBPGen{{#unless libraries_webdevstudios__cpt-core}}
  /**
   * Array of cpts of the plugin
   *
   * @var      array
   *
   * @since    1.0.0
   */
  protected $cpts = array( 'demo' );
  //{{/unless}}
  //WPBPGen{{#unless system_capability-system}}
  /**
   * Array of capabilities by roles
   * 
   * @var array
   * 
   * @since 1.0.0
   */
  protected static $plugin_roles = array(
	'administrator' => array(
	    'edit_demo' => true,
	    'edit_others_demo' => true,
	),
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

  //{{/unless}}

  /**
   * Initialize the plugin by setting localization and loading public scripts
   * and styles.
   *
   * @since     1.0.0
   */
  private function __construct() {
    //WPBPGen{{#unless libraries_webdevstudios__cpt-core}}
    // Create Custom Post Type https://github.com/jtsternberg/CPT_Core/blob/master/README.md
    register_via_cpt_core(
		array( __( 'Demo', PN_TEXTDOMAIN ), __( 'Demos', PN_TEXTDOMAIN ), 'demo' ), array(
	  'taxonomies' => array( 'demo-section' ),
	  'capabilities' => array(
		'edit_post' => 'edit_demo',
		'edit_others_posts' => 'edit_others_demo',
	  ),
	  'map_meta_cap' => true
		)
    );
    //{{/unless}}
    //WPBPGen{{#unless frontend_cpt-search-support}}
    add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );
    //{{/unless}}
    //WPBPGen{{#unless libraries_webdevstudios__taxonomy_core}}
    // Create Custom Taxonomy https://github.com/jtsternberg/Taxonomy_Core/blob/master/README.md
    register_via_taxonomy_core(
		array( __( 'Demo Section', PN_TEXTDOMAIN ), __( 'Demo Sections', PN_TEXTDOMAIN ), 'demo-section' ), array(
	  'public' => true,
	  'capabilities' => array(
		'assign_terms' => 'edit_posts',
	  )
		), array( 'demo' )
    );
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
    /*
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

  //WPBPGen{{#unless system_capability-system}}
  /**
   * Return the version
   *
   * @since    1.0.0
   *
   * @return    Version const.
   */
  public function get_plugin_roles() {
    return self::$plugin_roles;
  }

  //{{/unless}}
  //WPBPGen{{#unless libraries_webdevstudios__cpt_core}}
  /**
   * Return the cpts
   *
   * @since    1.0.0
   *
   * @return    Cpts array
   */
  public function get_cpts() {
    return $this->cpts;
  }

  //{{/unless}}

  /**
   * Return an instance of this class.
   *
   * @since     1.0.0
   *
   * @return    object    A single instance of this class.
   */
  public static function get_instance() {
    // If the single instance hasn't been set, set it now.
    if ( null == self::$instance ) {
	self::$instance = new self();
    }

    return self::$instance;
  }

  //WPBPGen{{#unless frontend_cpt-search-support}}
  /**
   * Add support for custom CPT on the search box
   *
   * @since    1.0.0
   *
   * @param    object    $query   
   * @return object
   */
  public function filter_search( $query ) {
    if ( $query->is_search ) {
	$post_types = $query->get( 'post_type' );
	if ( $post_types === 'post' ) {
	  $post_types = array();
	} elseif ( !is_array( $post_types ) && !empty( $post_types ) ) {
	  $post_types = explode( ',', $post_types );
	}
	$query->set( 'post_type', array_push( $post_types, $this->cpts ) );
    }
    return $query;
  }

  //{{/unless}}
  //WPBPGen{{#unless public-assets_css}}
  /**
   * Register and enqueue public-facing style sheet.
   *
   * @since    1.0.0
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
   * @since    1.0.0
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
   * @since    1.0.0
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
   * @since    1.0.0
   * @param array $classes THe array with all the classes of the page.
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
   * @since    1.0.0
   * @param string $original_template The original templace HTML.
   * @return string
   */
  public function load_content_demo( $original_template ) {
    if ( is_singular( 'demo' ) && in_the_loop() ) {
	return pn_get_template_part( 'content', 'demo', false );
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
   * @since    1.0.0
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
   * @since    1.0.0
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
   * @since    1.0.0
   */
  public function shortcode_method_name( $atts ) {
    //With this you can define the default proprietary for your shortcode
    $atts = shortcode_atts( array(
	  'number' => '1',
		), $atts );
    // @TODO: Define your shortcode here
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
