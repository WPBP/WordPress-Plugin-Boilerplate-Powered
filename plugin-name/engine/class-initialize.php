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
 * Plugin Name Initializer
 */
class Pn_Initialize {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * List of class to initialize.
	 *
	 * @var object
	 */
	public $classes = null;

	/**
	 * The Constructor that load the entry classes
	 *
	 * @since {{plugin_version}}
	 */
	public function __construct() {
        $this->is        = new Pn_Is_Methods();
        $this->classes   = array();
        // WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
        $this->classes[] = 'Pn_PostTypes';
        // {{/unless}}
        // WPBPGen{{#unless libraries_webdevstudios__cmb2}}
        $this->classes[] = 'Pn_CMB';
        // {{/unless}}
        // WPBPGen{{#unless libraries_wpbp__cronplus}}
        $this->classes[] = 'Pn_Cron';
        // {{/unless}}
        // WPBPGen{{#unless libraries_wpbp__fakepage}}
        $this->classes[] = 'Pn_FakePage';
        // {{/unless}}
        // WPBPGen{{#unless libraries_wpbp__template}}
        $this->classes[] = 'Pn_Template';
        // {{/unless}}
        // WPBPGen{{#unless libraries_wpbp__widgets-helper}}
        $this->classes[] = 'Pn_Widgets';
        // {{/unless}}
        // WPBPGen{{#unless system_rest}}
        $this->classes[] = 'Pn_Rest';
        // {{/unless}}
        // WPBPGen{{#unless system_transient}}
        $this->classes[] = 'Pn_Transient';
        // {{/unless}}

        // WPBPGen{{#unless wpcli}}
        if ( $this->is->request( 'cli' ) ) {
            $this->classes[] = 'Pn_Cli';
        }
        // {{/unless}}

        // WPBPGen{{#unless ajax_public}}
        if ( $this->is->request( 'ajax' ) ) {
            $this->classes[] = 'Pn_Ajax';
        }
        // {{/unless}}

        if ( $this->is->request( 'admin' ) ) {
			// WPBPGen{{#unless ajax_public}}
			if ( $this->is->request( 'ajax' ) ) {
				$this->classes[] = 'Pn_Ajax_Admin';
			}
			// {{/unless}}
			// WPBPGen{{#unless libraries_wpbp__pointerplus}}
            $this->classes[] = 'Pn_Pointers';
			// {{/unless}}
			// WPBPGen{{#unless libraries_mte90__wp-contextual-help}}
            $this->classes[] = 'Pn_ContextualHelp';
			// {{/unless}}
			// WPBPGen{{#unless act-deact_actdeact}}
            $this->classes[] = 'Pn_Admin_ActDeact';
			// {{/unless}}
			// WPBPGen{{#unless libraries_nathanielks__wp-admin-notice}}
            $this->classes[] = 'Pn_Admin_Notices';
			// {{/unless}}
			// WPBPGen{{#unless admin-assets_admin-page}}
            $this->classes[] = 'Pn_Admin_Settings_Page';
			// {{/unless}}
			// WPBPGen{{#unless admin-assets_admin-js && admin-assets_admin-css}}
            $this->classes[] = 'Pn_Admin_Enqueue';
			// {{/unless}}
			// WPBPGen{{#unless backend_impexp-settings}}
            $this->classes[] = 'Pn_Admin_ImpExp';
			// {{/unless}}
        }

        if ( $this->is->request( 'frontend' ) ) {
			// WPBPGen{{#unless public-assets_js && public-assets_css && frontend_wp-localize-script}}
            $this->classes[] = 'Pn_Enqueue';
            // {{/unless}}
            $this->classes[] = 'Pn_Extras';
        }

        $this->classes = apply_filters( 'pn_class_instances', $this->classes );

        return $this->load_classes();
    }

    private function load_classes() {
        foreach ( $this->classes as &$class ) {
            $class = apply_filters( strtolower( $class ) . '_instance', $class );
            $temp  = new $class;
            $temp->initialize();
        }
    }

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
            try {
                self::$instance = new self;
            } catch ( Exception $err ) {
                do_action( 'plugin_name_initialize_failed', $err );
                if ( WP_DEBUG ) {
                    throw $err->getMessage();
                }
            }
        }

        return self::$instance;
    }

}
