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
 * Plugin_name
 *
 * @package   Plugin_name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

namespace Plugin_Name\Backend;

use Plugin_Name\Engine\Base;
use Yoast_I18n_WordPressOrg_v3;

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// WPBPGen{{#if libraries_wpdesk__wp-notice}}
		\wpdesk_wp_notice( \__( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
		\wpdesk_wp_notice( \__( 'This is my dismissible notice', PN_TEXTDOMAIN ), 'error', true );
		// {{/if}}

		// WPBPGen{{#if libraries_julien731__wp-review-me}}
		/*
		 * Review plugin notice.
		 */
		new \WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => PN_TEXTDOMAIN,
				'rating'     => 5,
				'message'    => \__( 'Review me!', PN_TEXTDOMAIN ),
				'link_label' => \__( 'Click here to review', PN_TEXTDOMAIN ),
			)
		);

		// {{/if}}
		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
		// WPBPGen{{#if libraries_yoast__i18n-module}}
		if ( \apply_filters( 'plugin_name_alert_localization', true ) ) {
			new Yoast_I18n_WordPressOrg_v3(
			array(
				'textdomain'  => PN_TEXTDOMAIN,
				'plugin_name' => PN_NAME,
				'hook'        => 'admin_notices',
			),
			true
			);
		}

		// {{/if}}
	}

}
