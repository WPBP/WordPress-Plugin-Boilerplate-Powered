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

namespace Plugin_Name\Rest;

use Plugin_Name\Engine\Base;

/**
 * Example class for REST
 */
class Example extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		\add_action( 'rest_api_init', array( $this, 'add_custom_stuff' ) );
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function add_custom_stuff() {
		$this->add_custom_field();
		$this->add_custom_ruote();
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function add_custom_field() {
		\register_rest_field(
			'demo',
			PN_TEXTDOMAIN . '_text',
			array(
				'get_callback'    => array( $this, 'get_text_field' ),
				'update_callback' => array( $this, 'update_text_field' ),
				'schema'          => array(
					'description' => \__( 'Text field demo of Post type', PN_TEXTDOMAIN ),
					'type'        => 'string',
				),
			)
		);
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public function add_custom_ruote() {
		// Only an example with 2 parameters
		\register_rest_route(
			'wp/v2',
			'/calc',
			array(
				'methods'  => \WP_REST_Server::READABLE,
				'callback' => array( $this, 'sum' ),
				'args'     => array(
					'first'  => array(
						'default'           => 10,
						'sanitize_callback' => 'absint',
					),
					'second' => array(
						'default'           => 1,
						'sanitize_callback' => 'absint',
					),
				),
			)
		);
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @param array $post_obj Post ID.
	 * @return string
	 */
	public function get_text_field( array $post_obj ) {
		$post_id = $post_obj['id'];

		return \get_post_meta( $post_id, PN_TEXTDOMAIN . '_text', true );
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @param string   $value Value.
	 * @param \WP_Post $post  Post object.
	 * @param string   $key   Key.
	 * @return bool|\WP_Error
	 */
	public function update_text_field( string $value, \WP_Post $post, string $key ) {
		$post_id = \update_post_meta( $post->ID, $key, $value );

		if ( false === $post_id ) {
			return new \WP_Error(
				'rest_post_views_failed',
				\__( 'Failed to update post views.', PN_TEXTDOMAIN ),
				array( 'status' => 500 )
			);
		}

		return true;
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 * @param array $data Values.
	 * @return array
	 */
	public function sum( array $data ) {
		return array( 'result' => $data[ 'first' ] + $data[ 'second' ] );
	}

}
