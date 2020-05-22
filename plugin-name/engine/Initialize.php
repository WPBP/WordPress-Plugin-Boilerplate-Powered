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
namespace Plugin_Name\Engine;
use Plugin_Name\Engine;
/**
 * Plugin Name Initializer
 */
class Initialize {

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
        $this->is      = new Is_Methods();
        $this->classes = array();
        // WPBPGen{{#if libraries_johnbillion__extended-cpts}}
        $this->classes[] = 'Plugin_Name\\Internals\\PostTypes';
        // {{/if}}
        // WPBPGen{{#if libraries_cmb2__cmb2}}
        $this->classes[] = 'Plugin_Name\\Integrations\\CMB';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__cronplus}}
        $this->classes[] = 'Plugin_Name\\Integrations\\Cron';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__fakepage}}
        $this->classes[] = 'Plugin_Name\\Integrations\\FakePage';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__template}}
        $this->classes[] = 'Plugin_Name\\Integrations\\Template';
        // {{/if}}
        // WPBPGen{{#if libraries_wpbp__widgets-helper}}
        $this->classes[] = 'Plugin_Name\\Integrations\\Widgets';
        // {{/if}}
		// WPBPGen{{#if system_rest}}
		if ( $this->is->request( 'rest' ) ) {
			$this->classes[] = 'Plugin_Name\\Rest\\Example';
		}

		// {{/if}}
		// WPBPGen{{#if system_transient}}
		$this->classes[] = 'Plugin_Name\\Internals\\Transient';
		// {{/if}}
		// WPBPGen{{#if wpcli}}
		if ( $this->is->request( 'cli' ) ) {
			$this->classes[] = 'Plugin_Name\\Cli\\Example';
		}

		// {{/if}}
		// WPBPGen{{#if ajax_public}}
		if ( $this->is->request( 'ajax' ) ) {
			$this->classes[] = 'Plugin_Name\\Ajax\\Ajax';
		}

		// {{/if}}

		if ( $this->is->request( 'admin_backend' ) ) {
			// WPBPGen{{#if ajax_public}}
			if ( $this->is->request( 'ajax' ) ) {
				$this->classes[] = 'Plugin_Name\\Ajax\\Ajax_Admin';
			}

			// {{/if}}
			// WPBPGen{{#if libraries_wpbp__pointerplus}}
			$this->classes[] = 'Plugin_Name\\Admin\\Pointers';
			// {{/if}}
			// WPBPGen{{#if act-deact_actdeact}}
			$this->classes[] = 'Plugin_Name\\Admin\\ActDeact';
			// {{/if}}
			// WPBPGen{{#if libraries_wpdesk__wp-notice}}
			$this->classes[] = 'Plugin_Name\\Admin\\Notices';
			// {{/if}}
			// WPBPGen{{#if admin-assets_admin-page}}
			$this->classes[] = 'Plugin_Name\\Admin\\Settings_Page';
			// {{/if}}
			// WPBPGen{{#if admin-assets_admin-js && admin-assets_admin-css}}
			$this->classes[] = 'Plugin_Name\\Admin\\Enqueue';
			// {{/if}}
			// WPBPGen{{#if backend_impexp-settings}}
			$this->classes[] = 'Plugin_Name\\Admin\\ImpExp';
			// {{/if}}
		}

		if ( $this->is->request( 'frontend' ) ) {
			// WPBPGen{{#if public-assets_js && public-assets_css && frontend_wp-localize-script}}
			$this->classes[] = 'Plugin_Name\\Frontend\\Enqueue';
			// {{/if}}
			$this->classes[] = 'Plugin_Name\\Frontend\\Extras';
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
