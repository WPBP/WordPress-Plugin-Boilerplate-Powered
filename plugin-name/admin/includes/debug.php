<?php

/**
 * Provides interface for debugging variables with Debug Bar
 * 
 * @package   PN_Ad_Admin
 * @author    Benjamin J. Balter <ben@balter.com> & Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014 
 *
 */
class Pn_Debug {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Check user cap and WP_DEBUG on init to see if class should continue loading
	 */
	function __construct( ) {
		if ( !current_user_can( 'manage_options' ) || !WP_DEBUG ) {
			return;
		}

		add_filter( 'debug_bar_panels', array( $this, 'init_panel' ));
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
		if ( !current_user_can( 'manage_options' ) || !WP_DEBUG ) {
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

		$GLOBALS['YAD_Debug'][] = $debug;

		//allow this to be used as a filter
		return $var;
	}
	
	/**
	 * Extend Debug_Bar_Panel
	 * @param array $panels the default panels
	 * @return array passback the original panels
	 */
	function init_panel( $panels ) {
		if ( !class_exists( 'PN_Debug_Panel' ) ) {
			require_once('PN_Debug_Panel.php');
			$panels[] = new PN_Debug_Panel();
		}
		return $panels;
	}

}
