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

/**
 * This class contain all the snippet or extra that improve the experience on the backend
 */
class Pn_Admin_Notices extends Pn_Admin_Base {

	/**
	 * Initialize the snippet
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// WPBPGen{{#unless libraries_nathanielks__wp-admin-notice}}
		/*
		 * Load Wp_Admin_Notice for the notices in the backend
		 *
		 * First parameter the HTML, the second is the css class
		 */
		new WP_Admin_Notice( __( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
		new WP_Admin_Notice( __( 'Error Messages', PN_TEXTDOMAIN ), 'error' );
		// {{/unless}}
		// WPBPGen{{#unless libraries_julien731__wp-dismissible-notices-handler}}
		/*
		 * Dismissible notice
		 */
		dnh_register_notice( 'my_demo_notice', 'updated', __( 'This is my dismissible notice', PN_TEXTDOMAIN ) );
		// {{/unless}}
		// WPBPGen{{#unless libraries_julien731__wp-review-me}}
		/*
		 * Review Me notice
		 */
		new WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => PN_TEXTDOMAIN,
				'rating'     => 5,
				'message'    => __( 'Review me!', PN_TEXTDOMAIN ),
				'link_label' => __( 'Click here to review', PN_TEXTDOMAIN ),
			)
		);
		// {{/unless}}
		// WPBPGen{{#unless libraries_yoast__i18n-module}}
		new Yoast_I18n_WordPressOrg_v3(
			array(
				'textdomain'  => PN_TEXTDOMAIN,
				'plugin_name' => PN_NAME,
				'hook'        => 'admin_notices',
			)
		);
		// {{/unless}}
	}

}
