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
 * This class is the base skeleton of the plugin
 */
class Pn_Base {
    var $settings = array();

	/**
	 * Initialize the class
	 */
	function initialize() {
        $this->settings = get_option( PN_TEXTDOMAIN . '-settings' );
        return true;
	}

}
