<?php
/*
* This file is part of WordPress Plugin Boilerplate Powered.
*
* WordPress Plugin Boilerplate Powered is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* WordPress Plugin Boilerplate Powered is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Foobar.  If not, see <https://www.gnu.org/licenses/>.
*/

/**
 * Plugin_Name
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

namespace Plugin_Name\Engine;

/**
 * Plugin Name Is Methods
 */
class Is_Methods {

	/**
	 * What type of request is this?
	 *
	 * @since {{plugin_version}}
	 * @param  string $type admin, ajax, cron, cli, amp or frontend.
	 * @return bool
	 */
	public function request( string $type ) {
		switch ( $type ) {
			case 'backend':
				return $this->is_admin_backend();

			case 'ajax':
				return $this->is_ajax();

			case 'installing_wp':
				return $this->is_installing_wp();

			case 'rest':
				return $this->is_rest();

			case 'cron':
				return $this->is_cron();

			case 'frontend':
				return $this->is_frontend();

			case 'cli':
				return $this->is_cli();

			case 'amp':
				return $this->is_amp();

			default:
				\_doing_it_wrong( __METHOD__, \esc_html( \sprintf( 'Unknown request type: %s', $type ) ), '1.0.0' );

				return false;
		}
	}

	/**
	 * Is installing WP
	 *
	 * @return bool
	 */
	public function is_installing_wp() {
		return \defined( 'WP_INSTALLING' );
	}

	/**
	 * Is admin
	 *
	 * @return bool
	 */
	public function is_admin_backend() {
		return \is_user_logged_in() && \is_admin();
	}

	/**
	 * Is ajax
	 *
	 * @return bool
	 */
	public function is_ajax() {
		return ( \function_exists( 'wp_doing_ajax' ) && \wp_doing_ajax() ) || \defined( 'DOING_AJAX' );
	}

	/**
	 * Is rest
	 *
	 * @return bool
	 */
	public function is_rest() {
		if ( \defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return true;
		}

		global $wp_rewrite;

		if ( $wp_rewrite === null ) {
			$wp_rewrite = new \WP_Rewrite; //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		}

		$rest_url    = \wp_parse_url( \trailingslashit( \rest_url() ) );
		$current_url = \wp_parse_url( \add_query_arg( array() ) );

		return \strpos( $current_url[ 'path' ], \substr( $rest_url[ 'path' ], 0, \strlen( $rest_url[ 'path' ] ) - 1 ) ) === 0;
	}

	/**
	 * Is cron
	 *
	 * @return bool
	 */
	public function is_cron() {
		return ( \function_exists( 'wp_doing_cron' ) && \wp_doing_cron() ) || \defined( 'DOING_CRON' );
	}

	/**
	 * Is frontend
	 *
	 * @return bool
	 */
	public function is_frontend() {
		return ( ! $this->is_admin_backend() || ! $this->is_ajax() ) && ! $this->is_cron() && ! $this->is_rest();
	}

	/**
	 * Is cli
	 *
	 * @return bool
	 */
	public function is_cli() {
		return \defined( 'WP_CLI' ) && WP_CLI || \php_sapi_name() === 'cli';
	}

	/**
	 * Is AMP
	 *
	 * @return bool
	 */
	public function is_amp() {
		return \function_exists( 'is_amp_endpoint' ) && \is_amp_endpoint();
	}

	/**
	 * Whether given user is an administrator.
	 *
	 * @param \WP_User|null $user The given user.
	 * @return bool
	 */
	public static function is_user_admin( \WP_User $user = null ) { //phpcs:ignore
		if ( \is_null( $user ) ) {
			$user = \wp_get_current_user();
		}

		if ( ! $user instanceof \WP_User ) {
			\_doing_it_wrong( __METHOD__, 'To check if the user is admin is required a WP_User object.', '{{plugin_version}}' );
		}

		return \is_multisite() ? \user_can( $user, 'manage_network' ) : \user_can( $user, 'manage_options' );
	}

}
