<?php

/**
 * Provides interface for debugging variables with Debug Bar
 * 
 * @package   Plugin_Name_Admin
 * @author    Benjamin J. Balter <ben@balter.com> & Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014 
 *
 */
class Pn_Debug {

	public $history = array();
	private $parent;

	/**
	 * Register with WordPress API on construct
	 * @param class $parent the parent class
	 */
	function __construct( &$parent ) {
		$this->parent = &$parent;

		add_action( 'init', array( $this, 'init' ), 5 );
	}

	/**
	 * Check user cap and WP_DEBUG on init to see if class should continue loading
	 */
	function init() {
		if ( !WP_DEBUG || !current_user_can( 'manage_options' ) ) {
			return;
		}

		add_filter( 'debug_bar_panels', array( $this, 'init_panel' ) );
		add_filter( 'debug_bar_panels', array( $this, 'register_panel' ), 20 );
	}

	/**
	 * Debugs a variable
	 * Only visible to admins if WP_DEBUG is on
	 * @param mixed $var the var to debug
	 * @param bool $die (optional) whether to die after outputting
	 * @param string $function (optional) the function to call, usually either print_r or var_dump, but can be anything
	 * @return unknown
	 */
	function log( $var, $die = false, $function = 'var_dump' ) {
		if ( !WP_DEBUG || !current_user_can( 'manage_options' ) ) {
			return;
		}

		ob_start();
		if ( is_string( $var ) ) {
			echo "- " . $var . "\n";
		} else {
			call_user_func( $function, $var );
		}

		if ( $die ) {
			die();
		}

		$debug = ob_get_clean();

		$this->history[] = $debug;

		//allow this to be used as a filter
		return $var;
	}

	/**
	 * Registers panel with debug bar
	 * @param array $panels default panels
	 * @return array the modified panels
	 */
	function register_panel( $panels ) {
		$panels[] = new Pn_Debug_Panel( $this->parent->plugin_name . ' Debug', $this->history );
		return $panels;
	}

	/**
	 * Because you can't declare a class within a class, create an anonymous function to extend Debug_Bar_Panel
	 * @param array $panels the default panels
	 * @return array passback the original panels
	 */
	function init_panel( $panels ) {
		$init = create_function( '', 'class Pn_Debug_Panel extends Debug_Bar_Panel {
			protected $history;

			function __construct( $name, &$instance ) {
				$this->history = &$instance;
				parent::__construct( $name );
			}

			function render() {
				echo "<pre>";
				foreach ( $this->history as $debug ) {
					echo $debug;
				}
                echo "</pre>";
			}

			function prerender() {
				if ( empty( $this->history ) ) {
					$this->set_visible( false );
				}
			}

		}' );

		$init();

		return $panels;
	}

}
