<?php

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * @package   Plugin_Name_Admin
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 */
class Plugin_Name_Admin {

  /**
   * Instance of this class.
   *
   * @var      object
   *
   * @since    1.0.0
   */
  protected static $instance = null;

  /**
   * Slug of the plugin screen.
   *
   * @var      string
   *
   * @since    1.0.0
   */
  protected $admin_view_page = null;

  /**
   * Initialize the plugin by loading admin scripts & styles and adding a
   * settings page and menu.
   *
   * @since     1.0.0
   */
  private function __construct() {

    /*
     * @TODO :
     *
     * - Uncomment following lines if the admin class should only be available for super admins
      if( ! is_super_admin() ) {
	  return;
      }
     */

    $plugin = Plugin_Name::get_instance();
    $this->cpts = $plugin->get_cpts();
    
    // Load admin style sheet and JavaScript.
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    // Load admin style in dashboard for the At glance widget
    add_action( 'admin_head-index.php', array( $this, 'enqueue_admin_styles' ) );

    // Add the options page and menu item.
    add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

    // Add an action link pointing to the options page.
    $plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . PN_TEXTDOMAIN . '.php' );
    add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

    /*
     * Load CMB
     */
    require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_CMB.php' );

    /*
     * Define custom functionality.
     *
     * Read more about actions and filters:
     * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
     */
    add_action( '@TODO', array( $this, 'action_method_name' ) );
    add_filter( '@TODO', array( $this, 'filter_method_name' ) );

    /*
     * Import Export settings
     */
    require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_ImpExp.php' );
    /*
     * Contextual Help
     */
    require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_ContextualHelp.php' );

    /*
     * Debug mode
     */
    $debug = new WPBP_Debug( );
    $debug->log( __( 'Plugin Loaded', PN_TEXTDOMAIN ) );

    /*
     * Load Wp_Admin_Notice for the notices in the backend
     * 
     * First parameter the HTML, the second is the css class
     */
    new WP_Admin_Notice( __( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
    new WP_Admin_Notice( __( 'Error Messages', PN_TEXTDOMAIN ), 'error' );
    /*
     * Dismissible notice
     */
    dnh_register_notice( 'my_demo_notice', 'updated', __( 'This is my dismissible notice', PN_TEXTDOMAIN ) );
    /*
     * Review Me notice
     */
    new WP_Review_Me( array(
	  'days_after' => 15,
	  'type' => 'plugin',
	  'slug' => PN_TEXTDOMAIN,
	  'rating' => 5,
	  'message' => __( 'Review me!', PN_TEXTDOMAIN ),
	  'link_label' => __( 'Click here to review', PN_TEXTDOMAIN )
		) );

    /*
     * All the pointers
     */
    require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_Pointers.php' );

    /*
     * Load CronPlus 
     */
    $args = array(
	  'recurrence' => 'hourly',
	  'schedule' => 'schedule',
	  'name' => 'cronplusexample',
		// 'cb' => 'cronplus_example_cb'
    );

    $cronplus = new CronPlus( $args );
    $cronplus->schedule_event();

    /*
     * Load CPT_Columns
     * 
     * Check the file for example
     */
    $post_columns = new CPT_columns( 'demo' );
    $post_columns->add_column( 'cmb2_field', array(
	  'label' => __( 'CMB2 Field' ),
	  'type' => 'post_meta',
	  'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
	  'orderby' => 'meta_value',
	  'sortable' => true,
	  'prefix' => '<b>',
	  'suffix' => '</b>',
	  'def' => 'Not defined', // Default value in case post meta not found
	  'order' => '-1'
		)
    );

    /*
     * All the extras functions
     */
    require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_Extras.php' );
  }

  /**
   * Return an instance of this class.
   *
   * @since     1.0.0
   *
   * @return    object    A single instance of this class.
   */
  public static function get_instance() {

    /*
     * @TODO :
     *
     * - Uncomment following lines if the admin class should only be available for super admins
     if( ! is_super_admin() ) {
	  return;
     }
     */

    // If the single instance hasn't been set, set it now.
    if ( null == self::$instance ) {
	self::$instance = new self;
    }

    return self::$instance;
  }

  /**
   * Register and enqueue admin-specific style sheet.
   *
   * @since     1.0.0
   *
   * @return    mixed    Return early if no settings page is registered.
   */
  public function enqueue_admin_styles() {
    if ( !isset( $this->admin_view_page ) ) {
	return;
    }

    $screen = get_current_screen();
    if ( $this->admin_view_page == $screen->id || strpos( $_SERVER[ 'REQUEST_URI' ], 'index.php' ) || strpos( $_SERVER[ 'REQUEST_URI' ], get_bloginfo( 'wpurl' ) . '/wp-admin/' ) ) {
	wp_enqueue_style( PN_TEXTDOMAIN . '-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array( 'dashicons' ), PN_VERSION );
    }
  }

  /**
   * Register and enqueue admin-specific JavaScript.
   *
   * @since     1.0.0
   *
   * @return    mixed    Return early if no settings page is registered.
   */
  public function enqueue_admin_scripts() {
    if ( !isset( $this->admin_view_page ) ) {
	return;
    }

    $screen = get_current_screen();
    if ( $this->admin_view_page == $screen->id ) {
	wp_enqueue_script( PN_TEXTDOMAIN . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), PN_VERSION );
    }
  }

  /**
   * Register the administration menu for this plugin into the WordPress Dashboard menu.
   *
   * @since    1.0.0
   * 
   * @return void
   */
  public function add_plugin_admin_menu() {

    /*
     * Add a settings page for this plugin to the Settings menu
     *
     * @TODO:
     *
     * - Change 'manage_options' to the capability you see fit
     *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
     
    $this->admin_view_page = add_options_page(
		__( 'Page Title', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' )
    );
     * 
     */
    /*
     * Add a settings page for this plugin to the main menu
     * 
     */
    $this->admin_view_page = add_menu_page( __( 'Page Title', PN_TEXTDOMAIN ), PN_NAME, 'manage_options', PN_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ), 'dashicons-hammer', 90 );
  }

  /**
   * Render the settings page for this plugin.
   *
   * @since    1.0.0
   */
  public function display_plugin_admin_page() {
    include_once( 'views/admin.php' );
  }

  /**
   * Add settings action link to the plugins page.
   *
   * @since    1.0.0
   * @param array $links
   * @return array
   */
  public function add_action_links( $links ) {
    return array_merge(
		array(
	  'settings' => '<a href="' . admin_url( 'options-general.php?page=' . PN_TEXTDOMAIN ) . '">' . __( 'Settings' ) . '</a>',
	  'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=danielemte90@alice.it&item_name=Donation">' . __( 'Donate', PN_TEXTDOMAIN ) . '</a>'
		), $links
    );
  }

  /**
   * NOTE:     Actions are points in the execution of a page or process
   *           lifecycle that WordPress fires.
   *
   *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
   *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
   *
   * @since    1.0.0
   */
  public function action_method_name() {
    // @TODO: Define your action hook callback here
  }

  /**
   * NOTE:     Filters are points of execution in which WordPress modifies data
   *           before saving it or sending it to the browser.
   *
   *           Filters: http://codex.wordpress.org/Plugin_API#Filters
   *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
   *
   * @since    1.0.0
   */
  public function filter_method_name() {
    // @TODO: Define your filter hook callback here
  }

}

add_action( 'plugins_loaded', array( 'Plugin_Name_Admin', 'get_instance' ) );
