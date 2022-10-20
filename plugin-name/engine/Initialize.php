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
 * Plugin_Name Initializer
 */
class Initialize {

	/**
	 * List of class to initialize.
	 *
	 * @var array
	 */
	public $classes = array();

	/**
	 * Instance of this Context.
	 *
	 * @var object
	 */
	protected $content = null;

	/**
	 * Composer autoload file list.
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
		$this->content  = new Engine\Context;
		$this->composer = $composer;

		$this->get_classes( 'Internals' );
		$this->get_classes( 'Integrations' );

		// WPBPGen{{#if system_rest}}
		if ( $this->content->request( 'rest' ) ) {
			$this->get_classes( 'Rest' );
		}

		// {{/if}}
		// WPBPGen{{#if wpcli}}
		if ( $this->content->request( 'cli' ) ) {
			$this->get_classes( 'Cli' );
		}

		// {{/if}}
		// WPBPGen{{#if ajax}}
		if ( $this->content->request( 'ajax' ) ) {
			$this->get_classes( 'Ajax' );
		}

		// {{/if}}

		if ( $this->content->request( 'backend' ) ) {
			$this->get_classes( 'Backend' );
		}

		if ( $this->content->request( 'frontend' ) ) {
			$this->get_classes( 'Frontend' );
		}

		$this->load_classes();
	}

	/**
	 * Initialize all the classes.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	private function load_classes() {
		$this->classes = \apply_filters( 'plugin_name_classes_to_execute', $this->classes );

		foreach ( $this->classes as $class ) {
			try {
				$this->initialize_plugin_class( $class );
			} catch ( \Throwable $err ) {
				\do_action( 'plugin_name_initialize_failed', $err );

				if ( WP_DEBUG ) {
					throw new \Exception( $err->getMessage() );
				}
			}
		}
	}

	/**
	 * Validate the class and initialize it.
	 *
	 * @param class-string $class Class name to validate.
	 * @since {{plugin_version}}
	 * @SuppressWarnings("MissingImport")
	 * @return void
	 */
	private function initialize_plugin_class( $class ) {
		$reflection = new \ReflectionClass( $class );

		if ( $reflection->isAbstract() ) {
			return;
		}

		$temp = new $class;

		if ( !\method_exists( $temp, 'initialize' ) ) {
			return;
		}

		$temp->initialize();
	}

	/**
	 * Based on the folder loads the classes automatically using the Composer autoload to detect the classes of a Namespace.
	 *
	 * @param string $namespace Class name to find.
	 * @since {{plugin_version}}
	 * @return array Return the classes.
	 */
	private function get_classes( string $namespace ) {
		$prefix    = $this->composer->getPrefixesPsr4();
		$classmap  = $this->composer->getClassMap();
		$namespace = 'Plugin_Name\\' . $namespace;

		// In case composer has autoload optimized
		if ( isset( $classmap[ 'Plugin_Name\\Engine\\Initialize' ] ) ) {
			$classes = \array_keys( $classmap );

			foreach ( $classes as $class ) {
				if ( 0 !== \strncmp( (string) $class, $namespace, \strlen( $namespace ) ) ) {
					continue;
				}

				$this->classes[] = $class;
			}

			return $this->classes;
		}

		$namespace .= '\\';

		// In case composer is not optimized
		if ( isset( $prefix[ $namespace ] ) ) {
			$folder    = $prefix[ $namespace ][0];
			$php_files = $this->scandir( $folder );
			$this->find_classes( $php_files, $folder, $namespace );

			if ( !WP_DEBUG ) {
				\wp_die( \esc_html__( 'Plugin Name is on production environment with missing `composer dumpautoload -o` that will improve the performance on autoloading itself.', PN_TEXTDOMAIN ) );
			}

			return $this->classes;
		}

		return $this->classes;
	}

	/**
	 * Get php files inside the folder/subfolder that will be loaded.
	 * This class is used only when Composer is not optimized.
	 *
	 * @param string $folder Path.
	 * @param string $exclude_str Exclude all files whose filename contain this. Defaults to `~`.
	 * @since {{plugin_version}}
	 * @return array List of files.
	 */
	private function scandir( string $folder, string $exclude_str = '~' ) {
		// Also exclude these specific scandir findings.
		$blacklist = array( '..', '.', 'index.php' );
		// Scan for files.
		$temp_files = \scandir( $folder );

		$files = array();

		if ( \is_array( $temp_files ) ) {
			foreach ( $temp_files as $temp_file ) {
				// Only include filenames that DO NOT contain the excluded string and ARE NOT on the scandir result blacklist.
				if (
					\is_string( $exclude_str ) && false !== \mb_strpos( $temp_file, $exclude_str )
					|| \in_array( $temp_file, $blacklist, true )
				) {
					continue;
				}

				$files[] = $temp_file;
			}
		}

		return $files;
	}

	/**
	 * Load namespace classes by files.
	 *
	 * @param array  $php_files List of files with the Class.
	 * @param string $folder Path of the folder.
	 * @param string $base Namespace base.
	 * @since {{plugin_version}}
	 * @return void
	 */
	private function find_classes( array $php_files, string $folder, string $base ) {
		foreach ( $php_files as $php_file ) {
			$class_name = \substr( $php_file, 0, -4 );
			$path       = $folder . '/' . $php_file;

			if ( \is_file( $path ) ) {
				$this->classes[] = $base . $class_name;

				continue;
			}

			// Verify the Namespace level
			if ( \substr_count( $base . $class_name, '\\' ) < 2 ) {
				continue;
			}

			if ( !\is_dir( $path ) || \strtolower( $php_file ) === $php_file ) {
				continue;
			}

			$sub_php_files = $this->scandir( $folder . '/' . $php_file );
			$this->find_classes( $sub_php_files, $folder . '/' . $php_file, $base . $php_file . '\\' );
		}
	}

}
