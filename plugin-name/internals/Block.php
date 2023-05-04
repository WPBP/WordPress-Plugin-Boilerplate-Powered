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

namespace Plugin_Name\Internals;

use Plugin_Name\Engine\Base;

/**
 * Block of this plugin
 */
class Block extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		\add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Registers and enqueue the block assets
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function register_block() {
		// Register the block by passing the location of block.json to register_block_type.
		$json = \PN_PLUGIN_ROOT . 'assets/block.json';

		\register_block_type( $json );
	}

}
