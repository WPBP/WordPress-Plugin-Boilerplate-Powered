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
 * This class contain the Rest stuff
 */
class Pn_Rest extends Pn_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
		parent::initialize();
		add_action( 'rest_api_init', array( $this, 'add_custom_field' ) );
	}

	/**
	 * Examples
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function add_custom_field() {
        register_rest_field( 'demo', PN_TEXTDOMAIN . '_text', array(
            'get_callback'    => array( $this, 'get_text_field'),
            'update_callback' => array( $this, 'update_text_field'),
            'schema' => array(
                'description' => __( 'Text field demo of Post type' ),
                'type'        => 'string'
            ),
        ));

        // Only an example with 2 parameters
        register_rest_route( 'wp/v2', '/calc', array(
            'methods'         => WP_REST_Server::READABLE,
            'callback'        => array( $this, 'sum' ),
            'args'            => array(
				'first' => array(
					'default' => 10,
					'sanitize_callback' => 'absint',
				),
				'second' => array(
					'default' => 1,
					'sanitize_callback' => 'absint',
				),
            )
        ) );
    }

    public function get_text_field( $post_obj ) {
        $post_id = $post_obj['id'];
        return get_post_meta($post_id, PN_TEXTDOMAIN . '_text', true);
    }

    function update_text_field( $value, $post, $key ) {
        $post_id = update_post_meta( $post->ID, $key, $value );

        if ( false === $post_id ) {
            return new WP_Error(
            'rest_post_views_failed',
            __( 'Failed to update post views.' ),
            array( 'status' => 500 )
            );
        }

        return true;
    }

    public function sum( $data ) {
        echo json_encode( array( 'result' => $data[ 'first' ] + $data[ 'second' ] ) );
        die();
    }

}
