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
 * This class contain the Enqueue stuff for the frontend
 */
class Pn_Enqueue extends Pn_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
		parent::initialize();

		//WPBPGen{{#unless public-assets_css}}
		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );
		//{{/unless}}
		//WPBPGen{{#unless public-assets_js}}
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		//{{/unless}}
		//WPBPGen{{#unless frontend_wp-localize-script}}
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_js_vars' ) );
		//{{/unless}}
	}

	//WPBPGen{{#unless public-assets_css}}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public static function enqueue_styles() {
		wp_enqueue_style( PN_TEXTDOMAIN . '-plugin-styles', plugins_url( 'assets/css/public.css', PN_PLUGIN_ABSOLUTE ), array(), PN_VERSION );
	}

	//{{/unless}}
	//WPBPGen{{#unless public-assets_js}}
	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public static function enqueue_scripts() {
		wp_enqueue_script( PN_TEXTDOMAIN . '-plugin-script', plugins_url( 'assets/js/public.js', PN_PLUGIN_ABSOLUTE ), array( 'jquery' ), PN_VERSION );
	}

	//{{/unless}}
	//WPBPGen{{#unless frontend_wp-localize-script}}
	/**
	 * Print the PHP var in the HTML of the frontend for access by JavaScript
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public static function enqueue_js_vars() {
		wp_localize_script(
             PN_TEXTDOMAIN . '-plugin-script', 'pn_js_vars', array(
			'alert' => __( 'Hey! You have clicked the button!', PN_TEXTDOMAIN ),
		)
		);
	}

	//{{/unless}}
}
