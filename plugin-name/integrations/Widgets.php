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
namespace Plugin_Name\Integrations;

use \Plugin_Name\Engine;

/**
 * This class contain the Widget stuff
 */
class Widgets extends Engine\Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
		include_once 'widgets/sample.php';
	}

}

