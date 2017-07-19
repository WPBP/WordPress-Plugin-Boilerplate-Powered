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
 * This class contain the Posts 2 Posts code
 */
class Pn_P2P {

	/**
	 * Initialize the snippet
	 */
	function __construct() {
		add_action( 'p2p_init', array( $this, 'my_connection_types' ) );
	}

	/**
	 * https://github.com/scribu/wp-posts-to-posts/wiki/Basic-usage
	 * 
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	public function my_connection_types() {
		p2p_register_connection_type( array(
			'name' => 'demo_to_pages',
			'from' => 'demo',
			'to' => 'page'
		) );
	}

}

new Pn_P2P();
