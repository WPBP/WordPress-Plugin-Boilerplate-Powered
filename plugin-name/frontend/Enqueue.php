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

namespace Plugin_Name\Frontend;

use Plugin_Name\Engine\Base;

/**
 * Enqueue stuff on the frontend
 */
class Enqueue extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		// WPBPGen{{#if public-assets_css}}
		// Load public-facing style sheet and JavaScript.
		\add_action( 'wp_enqueue_scripts', array( self::class, 'enqueue_styles' ) );
		// {{/if}}
		// WPBPGen{{#if public-assets_js}}
		\add_action( 'wp_enqueue_scripts', array( self::class, 'enqueue_scripts' ) );
		// {{/if}}
		// WPBPGen{{#if frontend_wp-localize-script}}
		\add_action( 'wp_enqueue_scripts', array( self::class, 'enqueue_js_vars' ) );
		// {{/if}}
	}

	// WPBPGen{{#if public-assets_css}}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public static function enqueue_styles() {
		\wp_enqueue_style( PN_TEXTDOMAIN . '-plugin-styles', \plugins_url( 'assets/css/public.css', PN_PLUGIN_ABSOLUTE ), array(), PN_VERSION );
	}

	// {{/if}}
	// WPBPGen{{#if public-assets_js}}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public static function enqueue_scripts() {
		\wp_enqueue_script( PN_TEXTDOMAIN . '-plugin-script', \plugins_url( 'assets/js/public.js', PN_PLUGIN_ABSOLUTE ), array( 'jquery' ), PN_VERSION, false );
	}

	// {{/if}}
	// WPBPGen{{#if frontend_wp-localize-script}}

	/**
	 * Print the PHP var in the HTML of the frontend for access by JavaScript.
	 *
	 * @since {{plugin_version}}
	 * @return void
	 */
	public static function enqueue_js_vars() {
		\wp_localize_script(
			PN_TEXTDOMAIN . '-plugin-script',
			'pn_js_vars',
			array(
				'alert' => \__( 'Hey! You have clicked the button!', PN_TEXTDOMAIN ),
			)
		);
	}

	// {{/if}}

}
