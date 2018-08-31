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
class Pn_Shortcode extends Pn_Base {

	/**
	 * Initialize the snippet
	 */
	public function initialize() {
		parent::initialize();
        add_shortcode( 'foobar', array( $this, 'foobar_func' ) );
	}

	/**
	 * Shortcode example
	 *
	 * @param array $atts Parameters.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return string
	 */
	public static function foobar_func( $atts ) {
		shortcode_atts(
			array(
				'foo' => 'something',
				'bar' => 'something else',
			), $atts
		);

		return '<span class="foo">foo = ' . $atts[ 'foo' ] . '</span>' .
			'<span class="bar">foo = ' . $atts[ 'bar' ] . '</span>';
	}

}
