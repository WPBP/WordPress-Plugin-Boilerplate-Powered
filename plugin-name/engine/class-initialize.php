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
	 * Instance of this Pn_Is_Methods.
	 *
	 * @var object
	 */
	protected $is = null;

	/**
	 * List of class to initialize.
	 *
	 * @var array
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
        // WPBPGen{{#if libraries_johnbillion__extended-cpts}}
        $this->classes[] = 'Pn_PostTypes';
        // {{/if}}
        // WPBPGen{{#if libraries_cmb2__cmb2}}
        $this->classes[] = 'Pn_CMB';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__cronplus}}
        $this->classes[] = 'Pn_Cron';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__fakepage}}
        $this->classes[] = 'Pn_FakePage';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__template}}
        $this->classes[] = 'Pn_Template';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__widgets-helper}}
        $this->classes[] = 'Pn_Widgets';
        // {{/if}}
		// WPBPGen{{#if system_rest}}
		if ( $this->is->request( 'rest' ) ) {
			$this->classes[] = 'Pn_Rest';
		}
		// {{/if}}
		// WPBPGen{{#if system_transient}}
		$this->classes[] = 'Pn_Transient';
		// {{/if}}
		// WPBPGen{{#if wpcli}}
		if ( $this->is->request( 'cli' ) ) {
			$this->classes[] = 'Pn_Cli';
		}
		// {{/if}}
		// WPBPGen{{#if ajax_public}}
		if ( $this->is->request( 'ajax' ) ) {
			$this->classes[] = 'Pn_Ajax';
		}
		// {{/if}}

		if ( $this->is->request( 'admin_backend' ) ) {
			// WPBPGen{{#if ajax_public}}
			if ( $this->is->request( 'ajax' ) ) {
				$this->classes[] = 'Pn_Ajax_Admin';
			}
			// {{/if}}
			// WPBPGen{{#if libraries_wpbp__pointerplus}}
			$this->classes[] = 'Pn_Pointers';
			// {{/if}}
			// WPBPGen{{#if libraries_mte90__wp-contextual-help}}
			$this->classes[] = 'Pn_ContextualHelp';
			// {{/if}}
			// WPBPGen{{#if act-deact_actdeact}}
			$this->classes[] = 'Pn_Admin_ActDeact';
			// {{/if}}
			// WPBPGen{{#if libraries_nathanielks__wp-admin-notice}}
			$this->classes[] = 'Pn_Admin_Notices';
			// {{/if}}
			// WPBPGen{{#if admin-assets_admin-page}}
			$this->classes[] = 'Pn_Admin_Settings_Page';
			// {{/if}}
			// WPBPGen{{#if admin-assets_admin-js && admin-assets_admin-css}}
			$this->classes[] = 'Pn_Admin_Enqueue';
			// {{/if}}
			// WPBPGen{{#if backend_impexp-settings}}
			$this->classes[] = 'Pn_Admin_ImpExp';
			// {{/if}}
		}

		if ( $this->is->request( 'frontend' ) ) {
			// WPBPGen{{#if public-assets_js && public-assets_css && frontend_wp-localize-script}}
			$this->classes[] = 'Pn_Enqueue';
			// {{/if}}
			$this->classes[] = 'Pn_Extras';
		}

		$this->classes = apply_filters( 'pn_class_instances', $this->classes );

		$this->load_classes();
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
