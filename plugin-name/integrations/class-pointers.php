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
 * All the WP pointers.
 */
class Pn_Pointers extends Pn_base {

	/**
	 * Initialize the Pointers.
	 *
	 * @since {{plugin_version}}
	 */
	public function initialize() {
        parent::initialize();
		new PointerPlus( array( 'prefix' => PN_TEXTDOMAIN ) );
		add_filter( PN_TEXTDOMAIN . '-pointerplus_list', array( $this, 'custom_initial_pointers' ), 10, 2 );
	}

	/**
	 * Add pointers.
	 * Check on https://github.com/Mte90/pointerplus/blob/master/pointerplus.php for examples
	 *
	 * @param array $pointers The list of pointers.
	 * @param array $prefix   For your pointers.
	 *
	 * @return mixed
	 */
	public function custom_initial_pointers( $pointers, $prefix ) {
		return array_merge( $pointers, array(
			$prefix . '_contextual_tab' => array(
				'selector'   => '#contextual-help-link',
				'title'      => __( 'Boilerplate Help', PN_TEXTDOMAIN ),
				'text'       => __( 'A pointer for help tab.<br>Go to Posts, Pages or Users for other pointers.', PN_TEXTDOMAIN ),
				'edge'       => 'top',
				'align'      => 'right',
				'icon_class' => 'dashicons-welcome-learn-more',
			),
		) );
	}

}

new Pn_Pointers();
