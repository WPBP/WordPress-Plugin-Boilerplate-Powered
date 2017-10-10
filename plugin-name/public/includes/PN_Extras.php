<?php

/**
 * Plugin_name
 * 
 * @package   Plugin_name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * This class contain all the snippet or extra that improve the experience on the frontend
 */
class Pn_Extras {

	/**
	 * Initialize the snippet
	 */
	function initialize() {
		//WPBPGen{{#unless frontend_body-class}}
		add_filter( 'body_class', array( __CLASS__, 'add_pn_class' ), 10, 3 );
		//{{/unless}}
	}

	//WPBPGen{{#unless frontend_body-class}}
	/**
	 * Add class in the body on the frontend
	 * 
	 * @param array $classes THe array with all the classes of the page.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return array
	 */
	public static function add_pn_class( $classes ) {
		$classes[] = PN_TEXTDOMAIN;
		return $classes;
	}

	//{{/unless}}
}

$pn_extras = new Pn_Extras();
$pn_extras->initialize();

do_action( 'plugin_name_pn_extras_instance', $pn_extras );
