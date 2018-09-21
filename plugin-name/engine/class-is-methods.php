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
 * Plugin Name Is Methods
 */
class Pn_Is_Methods {

	/**
	 * What type of request is this?
	 *
	 * @since {{plugin_version}}
	 *
	 * @param  string $type admin, ajax, cron, cli or frontend.
	 * @return bool
	 */
	public function request( $type ) {
		switch ( $type ) {
			case 'admin':
				return $this->is_admin();
			case 'ajax':
				return $this->is_ajax();
			case 'cron':
				return $this->is_cron();
			case 'frontend':
				return $this->is_frontend();
			case 'cli':
				return $this->is_cli();
		}
	}

	/**
	 * Is admin
	 *
	 * @return boolean
	 */
	public function is_admin() {
		return is_user_logged_in() && is_admin();
	}

	/**
	 * Is ajax
	 *
	 * @return boolean
	 */
	public function is_ajax() {
		return ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || defined( 'DOING_AJAX' );
	}

	/**
	 * Is cron
	 *
	 * @return boolean
	 */
	public function is_cron() {
		return defined( 'DOING_CRON' );
	}

	/**
	 * Is frontend
	 *
	 * @return boolean
	 */
	public function is_frontend() {
		return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
	}

	/**
	 * Is cli
	 *
	 * @return boolean
	 */
	public function is_cli() {
		return defined( 'WP_CLI' ) && WP_CLI;
	}

}
