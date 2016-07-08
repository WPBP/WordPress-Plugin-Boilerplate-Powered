<?php

/**
 * This class contain the Posts 2 Posts code
 *
 * @package   Plugin_name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
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
   * @since    1.0.0
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
