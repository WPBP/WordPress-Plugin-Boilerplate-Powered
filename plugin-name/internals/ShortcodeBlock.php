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

namespace Plugin_Name\Internals;

/**
 * Dynamic block: Hello World with Interactivity API support
 *
 * Registers a block via register_block_type() with a block.json
 * and a PHP render_callback that renders "Hello: {text}".
 */
class ShortcodeBlock {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		\add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Register the hello-world block.
	 *
	 * Blocks must be registered at init or later; the guard keeps the
	 * registration idempotent when plugins_loaded is fired more than once
	 * (the test suite does this by design to exercise class discovery).
	 *
	 * @return void
	 */
	public function register_block() {
		if ( \WP_Block_Type_Registry::get_instance()->is_registered( 'plugin-name/hello-world' ) ) {
			return;
		}

		\register_block_type(
			PN_PLUGIN_ROOT . 'assets/src/block/hello-world',
			array(
				'render_callback' => array( $this, 'render' ),
			)
		);
	}

		/**
         * Render callback for the hello-world block.
         *
         * @param array          $attributes Block attributes.
         * @param string         $content    Block content (not used for dynamic blocks).
         * @param \WP_Block|null $block     Block instance.
         * @return string Rendered block HTML.
         */
	public function render( array $attributes, string $content = '', ?\WP_Block $block = null ): string {
		$text = 'World';

		if ( isset( $attributes['text'] ) && \is_string( $attributes['text'] ) ) {
			$text = $attributes['text'];
		}

		$context     = array( 'text' => 'Hello: ' . $text );
		$class       = isset( $attributes['className'] ) ? ' class="' . \esc_attr( $attributes['className'] ) . '"' : '';
		$interactive = 'plugin-name/hello-world';

		return '<div data-wp-interactive="' . \esc_attr( $interactive ) . '" data-wp-context="' . \esc_attr( (string) \wp_json_encode( $context ) ) . '"' . $class . '>' .
			'<button type="button" data-wp-on--click="actions.toggle">' . \esc_html__( 'Toggle', 'plugin-name' ) . '</button> ' .
			'<span data-wp-text="context.text">' . \esc_html( $context['text'] ) . '</span>' .
		'</div>';
	}

}
