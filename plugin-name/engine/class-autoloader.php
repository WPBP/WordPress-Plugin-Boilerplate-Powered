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
 * Plugin Name Autoloader
 */
class Pn_Autoloader {

	/**
	 * The Constructor.
	 */
	public function __construct() {
		spl_autoload_register( array( $this, '__autoload' ) );
		add_action( 'plugins_loaded', array( 'Pn_Initialize', 'get_instance' ) );
	}

    /**
    * Auto load our class files to reduce memory consumption.
    *
    * @param string $class Class name.
    *
    * @return void
    */
    function __autoload( $class ) {
        if ( false !== strpos($class, 'Pn') ) {
            $folders = array(
                "admin",
                "ajax",
                "cli",
                "includes",
                "integrations",
                "public"
            );
            $filename = $this->get_file_name_from_class($class);
            foreach($folders as $folder) {
                $path = PN_PLUGIN_ROOT . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename;
                if ( file_exists( $path ) ) {
                    require_once $path;
                    return true;
                }
            }
        }
    }

	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class Class name.
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
        $class = str_replace( 'Pn_', '', $class );
        $class = strtolower( $class );
        $class = str_replace( '_', '-', $class );
		return 'class-' . $class . '.php';
	}

}
