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
 * Plugin Name Initializer
 */
class Pn_Initialize {
    /**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * The Constructor that load the entry classes
	 *
	 * @since {{plugin_version}}
	 */
	public function __construct() {
        $classes = array();
        $classes[] = 'Pn_PostTypes';
        $classes[] = 'Pn_CMB';
        $classes[] = 'Pn_FakePage';
        $classes[] = 'Pn_P2P';
        $classes[] = 'Pn_Template';
        $classes[] = 'Pn_Widgets';
        $classes[] = 'Pn_Rest';

		if ( $this->is_request( 'cli' ) ) {
            $classes[] = 'Pn_Cli';
		}

		if ( $this->is_request( 'admin' ) ) {
            $classes[] = 'Pn_Pointers';
            $classes[] = 'Pn_ContextualHelp';
            $classes[] = 'Pn_Admin_ActDeact';
            $classes[] = 'Pn_Admin_Enqueue';
            $classes[] = 'Pn_Admin_Extras';
            $classes[] = 'Pn_Admin_ImpExp';
		}

		if ( $this->is_request( 'frontend' ) ) {
            $classes[] = 'Pn_Enqueue';
            $classes[] = 'Pn_Extras';
		}

		$this->load_classes( $classes );
	}

    /**
	 * What type of request is this?
	 *
	 * @since {{plugin_version}}
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return (function_exists( 'wp_doing_ajax' ) && wp_doing_ajax()) || defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
            case 'cli':
				return defined( 'WP_CLI' ) && WP_CLI;
		}
	}

	private function load_classes( $classes ) {
        foreach( $classes as &$class ) {
            $class = apply_filters( strtolower( $class ) . '_instance', $class );
            $temp = new $class;
            $temp->initialize();
        }
	}

    /**
	 * Return an instance of this class.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			try {
				self::$instance = new self;
			} catch ( Exception $err ) {
				do_action( 'plugin_name_initialize_failed', $err );
				if ( WP_DEBUG ) {
					throw $err->getMessage();
				}
			}
		}
		return self::$instance;
	}

}
