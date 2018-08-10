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
class Pn_Admin_Base extends Pn_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
        if ( is_admin() ) {
            return parent::initialize();
        }

		return false;
	}

}

