<?php

/*
 * Little but powerful library to easily handle detection of minimum system requirements in WordPress plugins.
 * Based on https://github.com/dsawardekar/wp-requirements 0.3 version
 * 
 * ChangeLog
 * 
 * 0.0.1
 * multilanguage added to 'requirements' slug
 * changed the name of classes
 * documentation missing the official version
 * Plugin_Requirements: only required the declaration, check the minimum value inserted, call directly the warning
 * Plugin_requirements: support multiple plugin
 * Requirement_Error: compacted code, better css, added deactivation of the plugin
 */

if ( class_exists( 'Plugin_Requirements' ) === false ) {

    /**
     * This class is the Boss of this library
     * public-facing side of the WordPress site.
     *
     * Complete example of use with all the sub-classes
     * 
     * new Plugin_Requirements( self::$plugin_name, self::$plugin_slug, array(
     *  'PHP' => new PHP_Requirement( '5.9.0' ),
     * 	'WP' => new WordPress_Requirement( '3.9.0' ),
     *  'Extension' => new PHP_Extension_Requirement( array('mysql', 'mysqli', 'session', 'pcre','json', 'gd', 'mbstring', 'zlib' ),
     *  'Plugin' => new Plugin_Requirement( array( 
     *     array( 'Plugin not installed', 'slug/slug.php' ) , 
     *     array( 'Plugin not installed 2', 'slug/slug2.php' ) 
     *   ) )
     * 	) );
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class Plugin_Requirements {

        /**
         *
         * Array that contain the Sub Classes
         *
         * @var      array
         */
        public $requirements = array();

        /**
         *
         * String that contain the plugin name
         *
         * @var      string
         */
        public $pluginName = '';

        /**
         *
         * String that contain the plugin slug
         *
         * @var      string
         */
        public $pluginSlug = '';

        /**
         * Initialize the library 
         * 
         * @param    string    $pluginname The Plugin Name used for the warning
         * @param    string    $pluginslug The Plugin slug used for the deactivation
         * @param    array    $args The subclasses
         */
        function __construct( $pluginname, $pluginslug, $args ) {
            $this->requirements = $args;
            $this->pluginName = $pluginname;
            $this->pluginSlug = $pluginslug;
            $this->satisfied();
        }

        /**
         * Load and check the missing default requirements
         * 
         * @return array Array of Sub-Classes
         */
        function getRequirements() {
            $requirements = $this->requirements;

            if ( !isset( $requirements[ 'PHP' ] ) ) {
                $requirements[ 'PHP' ] = new PHP_Requirement( '5.2.0' );
            }

            if ( !isset( $requirements[ 'WP' ] ) ) {
                $requirements[ 'WP' ] = new WordPress_Requirement( '3.8.0' );
            }

            if ( !isset( $requirements[ 'Extension' ] ) ) {
                $requirements[ 'Extension' ] = new PHP_Extension_Requirement( array(
                    'session', 'pcre', 'json', 'gd', 'mbstring', 'zlib'
                        ) );
            }

            return $requirements;
        }

        /**
         * Check the all requirements
         * 
         * @return true|false Successful
         */
        public function satisfied() {
            $requirements = $this->getRequirements();
            $results = array();
            $success = true;

            foreach ( $requirements as $requirement ) {
                $result = array(
                    'satisfied' => $requirement->check(),
                    'requirement' => $requirement
                );

                array_push( $results, $result );

                if ( !$result[ 'satisfied' ] ) {
                    $success = false;
                }
            }

            if ( !$success ) {
                new Requirement_Error( $this->pluginName, $this->pluginSlug, $results );
            }

            return $success;
        }

    }

    /**
     * Check the PHP environment, for example go to Plugin_Requirements documentation
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class PHP_Requirement {

        /**
         *
         * The minimum version of PHP
         *
         * @var      string
         */
        public $minimumVersion = '5.2.0';

        /**
         * Initialize the library 
         * 
         * @param    string    $minversion The minimum version of PHP
         */
        function __construct( $minversion ) {
            $this->minimumVersion = $minversion;
        }

        /**
         * Check the requirement
         * 
         * @return true|false Succesful
         */
        function check() {
            return version_compare(
                    phpversion(), $this->minimumVersion, '>='
            );
        }

        /**
         * Return the message warning 
         * 
         * @return string The warning message
         */
        function message() {
            return 'PHP <b>' . $this->minimumVersion . '+</b>' . __( " Required, Detected ", 'requirements' ) . '<b>' . phpversion() . '</b>';
        }

    }

    /**
     * Check the Wordpress environment, for example go to Plugin_Requirements documentation
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class WordPress_Requirement {

        /**
         *
         * The minimum version of Wordpress
         *
         * @var      string
         */
        public $minimumVersion = '3.8.0';

        /**
         * Initialize the library 
         * 
         * @param    string    $minversion The minimum version of WP
         */
        function __construct( $minversion ) {
            $this->minimumVersion = $minversion;
        }

        /**
         * Check the requirement
         * 
         * @return true|false Succesful
         */
        function check() {
            global $wp_version;
            return version_compare(
                    $wp_version, $this->minimumVersion, '>='
            );
        }

        /**
         * Return the message warning 
         * 
         * @return string The warning message
         */
        function message() {
            global $wp_version;
            return 'WordPress <b>' . $this->minimumVersion . '+</b>' . __( ' Required, Detected ', 'requirements' ) . '<b>' . $wp_version . '</b>';
        }

    }

    /**
     * Check the PHP extension, for example go to Plugin_Requirements documentation
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class PHP_Extension_Requirement {

        /**
         *
         * Array that contain the list of extension to check
         *
         * @var      array
         */
        public $extensions = array();

        /**
         *
         * Array that contain the missing extension
         *
         * @var      array
         */
        public $notFound = array();

        /**
         * Initialize the library 
         * 
         * @param    array    $extensions The extension list
         */
        function __construct( $extensions ) {
            $this->extensions = $extensions;
        }

        /**
         * Check the PHP extension if available
         * 
         * @return bool return the available of the extension
         */
        function check() {
            $result = true;
            $this->notFound = array();

            foreach ( $this->extensions as $extension ) {
                if ( !extension_loaded( $extension ) ) {
                    $result = false;
                    array_push( $this->notFound, $extension );
                }
            }

            return $result;
        }

        /**
         * Return the message warning 
         * 
         * @return string The warning message
         */
        function message() {
            $extensions = implode( ', ', $this->notFound );
            return __( "PHP Extensions Not Found: ", 'requirements' ) . '<b>' . $extensions . '</b>';
        }

    }

    /**
     * Check the plugin required, for example go to Plugin_Requirements documentation
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class Plugin_Requirement {

        /**
         *
         * Array that contain the plugins name and slug
         *
         * @var      array
         */
        public $plugins = array();

        /**
         *
         * Array that contain the missing plugins
         *
         * @var      array
         */
        public $notFound = array();

        /**
         * Initialize the library 
         * 
         * @param    array    $plugins The plugins to check
         */
        function __construct( $plugins ) {
            $this->plugins = $plugins;
        }

        /**
         * Check the requirement
         * 
         * @return true|false Succesful
         */
        function check() {
            $result = true;
            $this->notFound = array();

            foreach ( $this->plugins as $plugin ) {

                if ( !is_plugin_active( $plugin[ 1 ] ) ) {
                    $result = false;
                    array_push( $this->notFound, $plugin[ 0 ] );
                }
            }

            return $result;
        }

        /**
         * Return the message warning 
         * 
         * @return string The warning message
         */
        function message() {
            $plugins = implode( ', ', $this->notFound );
            return '<b>"' . $plugins . '"</b>' . __( ' Required', 'requirements' );
        }

    }

    /**
     * Generate the exception that stop the activation of the plugin
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class Plugin_Requirements_Exception extends \Exception {
        
    }

    /**
     * Generate the warning error and deactivate the plugin
     *
     * @package Plugin_Name
     * @author  Mte90 and dsawardekar
     */
    class Requirement_Error {

        /**
         *
         * String that contain the plugin name
         *
         * @var      string
         */
        public $pluginName = '';

        /**
         *
         * String that contain the plugin slug
         *
         * @var      string
         */
        public $pluginSlug = '';

        /**
         *
         * Array that contain the list of errors
         *
         * @var      array
         */
        public $results;

        /**
         * Initialize the library 
         * 
         * @param    string    $pluginName The mplugin name
         * @param	 string    $pluginSlug The plugin slug
         * @param	 array	   $results	   Array of requirements missing
         */
        function __construct( $pluginName, $pluginSlug, $results ) {
            $this->pluginName = $pluginName;
            $this->pluginSlug = $pluginSlug;
            $this->results = $results;
            $this->showError( $this->resultsToNotice() );
        }

        /**
         * Show the error 
         * 
         * @param    string    $message The HTML with the warnings
         */
        function showError( $message ) {
            if ( $this->isErrorScraper() ) {
                echo $message;
                $this->quit();
            } else {
                throw new Plugin_Requirements_Exception();
            }
        }

        /**
         * Check is PHPunit and deactivate the plugin 
         */
        function quit() {
            if ( !defined( 'PHPUNIT_RUNNER' ) ) {
                if ( is_file( $dir = WPMU_PLUGIN_DIR . $this->pluginSlug . '.php' ) ) {
                    deactivate_plugins( $dir );
                } elseif ( is_file( $dir = WP_PLUGIN_DIR . $this->pluginSlug . '.php' ) ) {
                    deactivate_plugins( $dir );
                }
                exit();
            }
        }

        /**
         * Check error scrape
         * 
         * @return    true|false    
         */
        function isErrorScraper() {
            return isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] === 'error_scrape';
        }

        /**
         * Generate the HTML of the warnings
         * 
         * @return    string  
         */
        function resultsToNotice() {
            $html = "<style type='text/css'>body { font: 12px sans-serif; color: #a00; } body, p, ul { margin:0; }</style>";
            $html .= "<div class='error'>" . '<p>' . __( "Minimum System Requirements not satisfied for: ", 'requirements' ) . '<strong>' . $this->pluginName . '</strong></p>';
            $html .= '<ul>';

            foreach ( $this->results as $result ) {
                if ( !$result[ 'satisfied' ] ) {
                    $html .= '<li>' . $result[ 'requirement' ]->message() . '</li>';
                }
            }
            $html .= '</ul></div>';

            return $html;
        }

    }

}
