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

namespace Plugin_Name\Backend;

use WPBP_Vendor_I18n_Notice_WordPressOrg as I18n_Notice_WordPressOrg;
use Plugin_Name\Engine\Base;

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
		wpbp_vendor_wpdesk_wp_notice( \__( 'Updated Messages', 'plugin-name' ), 'updated' );
		// {{/if}}

		// WPBPGen{{#if libraries_wpbp__page-madness-detector && libraries_wpdesk__wp-notice}}
		$builder = new \WPBP_Vendor_Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entropy() ) {
			wpbp_vendor_wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', 'plugin-name' ), 'error', true );
		}

		// {{/if}}
		// WPBPGen{{#if libraries_julien731__wp-review-me}}
		/*
		 * Review plugin notice.
		 */
		new \WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => 'plugin-name',
				'rating'     => 5,
				'message'    => \__( 'Review me!', 'plugin-name' ),
				'link_label' => \__( 'Click here to review', 'plugin-name' ),
			)
		);

		// {{/if}}
		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
		// WPBPGen{{#if libraries_wpbp__i18n-notice}}
		if ( \apply_filters( 'plugin_name_alert_localization', true ) ) {
			new I18n_Notice_WordPressOrg(
			array(
				'textdomain'  => 'plugin-name',
				'plugin_name' => PN_NAME,
				'hook'        => 'admin_notices',
			),
			true
			);
		}

		// {{/if}}
	}

}
