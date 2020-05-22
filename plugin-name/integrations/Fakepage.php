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
 * This class contain the Fake Page
 */
class FakePage extends Engine\Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
        parent::initialize();
        new \Fake_Page(
            array(
            'slug'         => 'fake_slug',
            'post_title'   => 'Fake Page Title',
            'post_content' => 'This is the fake page content',
            )
        );
    }

}
