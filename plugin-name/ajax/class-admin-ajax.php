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

if ( is_user_logged_in() ) {
    /**
     * AJAX in the admin
     */
    class Pn_Ajax_Admin {

        /**
         * Initialize the class
         */
        public function initialize() {
            if ( !apply_filters( 'plugin_name_pn_ajax_admin_initialize', true ) ) {
                return;
            }

            // For logged user
			add_action( 'wp_ajax_your_method', array( $this, 'your_method' ) );
		}

		/**
		 * The method to run on ajax
		 *
		 * @return void
		 */
		public function your_method() {
			$return = array(
				'message' => 'Saved',
				'ID'      => 2,
			);

			wp_send_json_success( $return );
			// wp_send_json_error( $return );
		}

	}
}
