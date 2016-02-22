<?php

/**
 * Plugin Name.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Plugin_Name
 * @author  Your Name <email@example.com>
 */
class Plugin_Name {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.0.0';

    /**
     * @TODO - Rename "plugin-name" to the name of your plugin
     *
     * Unique identifier for your plugin.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @var      string
     *
     * @since    1.0.0
     */
    protected static $plugin_slug = 'plugin-name';

    /**
     * @TODO - Rename "Plugin Name" to the name of your plugin
     *
     * Unique identifier for your plugin.
     *
     * @var      string
     *
     * @since    1.0.0
     */
    protected static $plugin_name = 'Plugin Name';

    /**
     * Instance of this class.
     *
     * @var      object
     *
     * @since    1.0.0
     */
    protected static $instance = null;

    /**
     * Array of cpts of the plugin
     *
     * @var      array
     *
     * @since    1.0.0
     */
    protected $cpts = array( 'demo' );

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

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {
        // Activate plugin when new blog is added
        add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

        // Create Custom Post Type https://github.com/jtsternberg/CPT_Core/blob/master/README.md
        register_via_cpt_core(
                array( __( 'Demo', $this->get_plugin_slug() ), __( 'Demos', $this->get_plugin_slug() ), 'demo' ), array(
            'taxonomies' => array( 'demo-section' ),
            'capabilities' => array(
                'edit_post' => 'edit_demo',
                'edit_others_posts' => 'edit_others_demo',
            ),
            'map_meta_cap' => true
                )
        );

        add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );

        // Create Custom Taxonomy https://github.com/jtsternberg/Taxonomy_Core/blob/master/README.md
        register_via_taxonomy_core(
                array( __( 'Demo Section', $this->get_plugin_slug() ), __( 'Demo Sections', $this->get_plugin_slug() ), 'demo-section' ), array(
            'public' => true,
            'capabilities' => array(
                'assign_terms' => 'edit_posts',
            )
                ), array( 'demo' )
        );

        add_filter( 'body_class', array( $this, 'add_pn_class' ), 10, 3 );

        // Override the template hierarchy for load /templates/content-demo.php
        add_filter( 'template_include', array( $this, 'load_content_demo' ) );

        // Load public-facing style sheet and JavaScript.
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js_vars' ) );

        /*
         * Define custom functionality.
         * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */
        add_action( '@TODO', array( $this, 'action_method_name' ) );
        add_filter( '@TODO', array( $this, 'filter_method_name' ) );
        add_shortcode( '@TODO', array( $this, 'shortcode_method_name' ) );
    }

    /**
     * Return the plugin slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_plugin_slug() {
        return self::$plugin_slug;
    }

    /**
     * Return the plugin name.
     *
     * @since    1.0.0
     *
     * @return    Plugin name variable.
     */
    public function get_plugin_name() {
        return self::$plugin_name;
    }

    /**
     * Return the version
     *
     * @since    1.0.0
     *
     * @return    Version const.
     */
    public function get_plugin_version() {
        return self::VERSION;
    }

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
            self::$instance = new self;
        }

        return self::$instance;
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
     * Add support for custom CPT on the search box
     *
     * @since    1.0.0
     *
     * @param    object    $query   
     * @return object
     */
    public function filter_search( $query ) {
        if ( $query->is_search ) {
            // Mantain support for post
            $this->cpts[] = 'post';
            $query->set( 'post_type', $this->cpts );
        }
        return $query;
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
        // Requirements Detection System - read the doc/example in the library file
        require_once( plugin_dir_path( __FILE__ ) . 'includes/requirements.php' );
        new Plugin_Requirements( self::$plugin_name, self::$plugin_slug, array(
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
            $caps = ( array_key_exists( $role, self::$plugin_roles ) ) ? self::$plugin_roles[ $role ] : self::$plugin_roles[ 'subscriber' ];

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

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     * @return void
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->get_plugin_slug() . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->get_plugin_slug() . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
    }

    /**
     * Print the PHP var in the HTML of the frontend for access by JavaScript
     *
     * @since    1.0.0
     * @return void
     */
    public function enqueue_js_vars() {
        wp_localize_script( $this->get_plugin_slug() . '-plugin-script', 'pn_js_vars', array(
            'alert' => __( 'Hey! You have clicked the button!', $this->get_plugin_slug() )
                )
        );
    }

    /**
     * Add class in the body on the frontend
     *
     * @since    1.0.0
     * @param array $classes THe array with all the classes of the page.
     * @return array
     */
    public function add_pn_class( $classes ) {
        $classes[] = $this->get_plugin_slug();
        return $classes;
    }

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
        } else {
            return $original_template;
        }
    }

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

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {
        // @TODO: Define your filter hook callback here
    }

    /**
     * NOTE:  Shortcode simple set of functions for creating macro codes for use
     * 		  in post content.
     *
     *        Reference:  http://codex.wordpress.org/Shortcode_API
     *
     * @since    1.0.0
     */
    public function shortcode_method_name() {
        // @TODO: Define your shortcode here
    }

}
