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

namespace Plugin_Name\Backend;

use Plugin_Name\Engine\Base;

/**
 * All the WP pointers.
 */
class Pointers extends Base {

	/**
	 * Initialize the Pointers.
	 *
	 * @since {{plugin_version}}
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		new \PointerPlus( array( 'prefix' => PN_TEXTDOMAIN ) );
		\add_filter( PN_TEXTDOMAIN . '-pointerplus_list', array( $this, 'custom_initial_pointers' ), 10, 2 );
	}

	/**
	 * Add pointers.
	 * Check on https://github.com/wpbp/pointerplus/blob/master/pointerplus.php for examples
	 *
	 * @param array  $pointers The list of pointers.
	 * @param string $prefix   For your pointers.
	 * @since {{plugin_version}}
	 * @return array
	 */
	public function custom_initial_pointers( array $pointers, string $prefix ) {
		return \array_merge(
			$pointers,
			array(
				$prefix . '_contextual_help' => array(
					'selector'   => '.ui-tabs-anchor#ui-id-2',
					'title'      => \__( 'Boilerplate Help', PN_TEXTDOMAIN ),
					'text'       => \__( 'A pointer for help tab.<br>Go to Posts, Pages or Users for other pointers.', PN_TEXTDOMAIN ),
					'edge'       => 'top',
					'align'      => 'left',
					'icon_class' => 'dashicons-welcome-learn-more',
				),
			)
		);
	}

}
