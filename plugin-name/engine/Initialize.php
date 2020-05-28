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
     * Composer autoload.
     *
     * @var \Composer\Autoload\ClassLoader
     */
	private $composer;

	/**
	 * The Constructor that load the entry classes
	 *
	 * @param \Composer\Autoload\ClassLoader $composer Composer autoload output.
	 * @since {{plugin_version}}
	 */
	public function __construct( \Composer\Autoload\ClassLoader $composer ) {
		$this->is       = new Engine\Is_Methods();
		$this->composer = $composer;

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

	/**
     * Execute all the classes.
     *
     * @since {{plugin_version}}
     */
	private function load_classes() {
		foreach ( $this->classes as &$class ) {
			$class = apply_filters( strtolower( $class ) . '_instance', $class );
			try {
				$temp = new $class;
				$temp->initialize();
			} catch ( \Exception $err ) {
				do_action( 'plugin_name_initialize_failed', $err );
				if ( WP_DEBUG ) {
					throw new \Exception( $err->getMessage() );
				}
			}
		}
	}

	/**
	 * Using Composer autoload to detect the classes of a Namespace
	 *
	 * @param string $namespace Class name to find.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return array Return the classes.
	 */
	private function get_classes( string $namespace ) {
		$prefix   = $this->composer->getPrefixesPsr4();
		$classmap = $this->composer->getClassMap();
		$base     = 'Plugin_Name\\' . $namespace;

		// In case composer has autoload optimized
		if ( isset( $classmap[ 'Plugin_Name\\Engine\\Initialize' ] ) ) {
			$keys = array_keys( $classmap );
			foreach ( $keys as $key ) {
				if ( strncmp( $key, $base, strlen( $base ) ) === 0 ) {
					$this->classes[] = $key;
				}
			}

			return $this->classes;
		}

		$base = $base . '\\';
		// In case composer is not optimized
		if ( isset( $prefix[ $base ] ) ) {
			$folder  = $prefix[ $base ][0];
			$classes = $this->scandir( $folder );
			$this->find_classes( $classes, $folder, $base, true );
			return $this->classes;
		}

		return $this->classes;
	}

	/**
	 * Get php files inside the folders
	 *
	 * @param string $folder Path.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return array List of files.
	 */
	private function scandir( string $folder ) {
		$temp_files = scandir( $folder );
			$files  = array();
		if ( is_array( $temp_files ) ) {
			$files = $temp_files;
		}

		return array_diff( $files, array( '..', '.', 'index.php' ) );
	}

	/**
	 * Load namespace classes by files
	 *
	 * @param array  $classes List of files.
	 * @param string $folder Path folder.
	 * @param string $base Namespace base.
	 * @param bool   $loop_again To avoid a deep scanning.
	 *
	 * @since {{plugin_version}}
	 */
	private function find_classes( array $classes, string $folder, string $base, bool $loop_again = true ) {
		foreach ( $classes as $php_file ) {
			$class_name = substr( $php_file, 0, -4 );
			$path       = $folder . '/' . $php_file;

			if ( is_file( $path ) ) {
				$this->classes[] = $base . $class_name;
				continue;
			}

			if ( $loop_again ) {
				if ( is_dir( $path ) && strtolower( $php_file ) !== $php_file ) {
					$classes = $this->scandir( $folder . '/' . $php_file );
					$this->find_classes( $classes, $folder . '/' . $php_file, $base . $php_file . '\\', false );
				}
			}
		}
	}

}

