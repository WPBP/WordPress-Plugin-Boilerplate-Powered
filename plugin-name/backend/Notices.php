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

use I18n_Notice_WordPressOrg;
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
		\wpdesk_wp_notice( \__( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
		// {{/if}}

		// WPBPGen{{#if libraries_wpbp__page-madness-detector && libraries_wpdesk__wp-notice}}
		$builder = new \Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entropy() ) {
			\wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', PN_TEXTDOMAIN ), 'error', true );
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
		// WPBPGen{{#if libraries_wpbp__i18n-notice}}
		if ( \apply_filters( 'plugin_name_alert_localization', true ) ) {
			new I18n_Notice_WordPressOrg(
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
