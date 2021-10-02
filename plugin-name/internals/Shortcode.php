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

use DecodeLabs\Tagged as Html;
use Plugin_Name\Engine\Base;

/**
 * Shortcodes of this plugin
 */
class Shortcode extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		\add_shortcode( 'foobar', array( $this, 'foobar_func' ) );
	}

	/**
	 * Shortcode example
	 *
	 * @param array $atts Parameters.
	 * @since {{plugin_version}}
	 * @return string
	 */
	public static function foobar_func( array $atts ) {
		\shortcode_atts( array( 'foo' => 'something', 'bar' => 'something else' ), $atts );

		return Html::{'span.foo'}( 'foo = ' . $atts['foo'] ) . Html::{'span.bar'}( 'bar = ' . $atts['bar'] );
	}

}
