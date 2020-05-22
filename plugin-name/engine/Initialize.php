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
	public $classes = array();

	/**
	 * The Constructor that load the entry classes
	 *
	 * @since {{plugin_version}}
	 */
	public function __construct() {
		$this->is = new Engine\Is_Methods();

		$this->get_classes( 'Internals' );
		$this->get_classes( 'Integrations' );

		// WPBPGen{{#if system_rest}}
		if ( $this->is->request( 'rest' ) ) {
			$this->get_classes( 'Rest' );
		}

		// {{/if}}
		// WPBPGen{{#if wpcli}}
		if ( $this->is->request( 'cli' ) ) {
			$this->get_classes( 'Cli' );
		}

		// {{/if}}
		// WPBPGen{{#if ajax_public}}
		if ( $this->is->request( 'ajax' ) ) {
			$this->get_classes( 'Ajax' );
		}

		// {{/if}}

		if ( $this->is->request( 'backend' ) ) {
			$this->get_classes( 'Backend' );
		}

		if ( $this->is->request( 'frontend' ) ) {
			$this->get_classes( 'Frontend' );
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
			} catch ( \Exception $err ) {
				do_action( 'plugin_name_initialize_failed', $err );
				if ( WP_DEBUG ) {
					throw $err->getMessage();
				}
			}
		}

		return self::$instance;
	}

	private function get_classes( $namespace ) {
		$namespace = str_replace( '\\', '/', $namespace );
		$folder    = strtolower( $namespace );
		$classes   = array_diff( scandir( PN_PLUGIN_ROOT . $folder ), array( '..', '.', 'index.php' ) );
		$this->enqueue_classes( $namespace, $classes );
	}

	private function enqueue_classes( $namespace_to_append, $classes ) {
		foreach ( $classes as $php_file ) {
			$is_php_file = strpos( $php_file, '.php' );
			// File with lowercase names are not PSR-4
			if ( strtolower( $php_file ) !== $php_file ) {
				if ( $is_php_file !== false ) {
					$class_name      = substr( $php_file, 0, -4 );
					$this->classes[] = 'Plugin_Name\\' . str_replace( '/', '\\', $namespace_to_append ) . '\\' . $class_name;
				}

				continue;
			}

			if ( $is_php_file === false ) {
				$this->get_classes( $namespace_to_append . '\\' . strtolower( $php_file ) );
			}
		}
	}

}

