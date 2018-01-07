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
class Pn_Extras_Admin {

	/**
	 * Initialize the snippet
	 */
	function initialize() {
//WPBPGen{{#unless libraries_wpbp__debug}}
		/*
		 * Debug mode
		 */
		$debug = new WPBP_Debug( 'WPBP' );
		$debug->log( __( 'Plugin Loaded', PN_TEXTDOMAIN ) );
//{{/unless}}
//WPBPGen{{#unless libraries_nathanielks__wp-admin-notice}}
		/*
		 * Load Wp_Admin_Notice for the notices in the backend
		 * 
		 * First parameter the HTML, the second is the css class
		 */
		new WP_Admin_Notice( __( 'Updated Messages', PN_TEXTDOMAIN ), 'updated' );
		new WP_Admin_Notice( __( 'Error Messages', PN_TEXTDOMAIN ), 'error' );
//{{/unless}}
//WPBPGen{{#unless libraries_julien731__wp-dismissible-notices-handler}}
		/*
		 * Dismissible notice
		 */
		dnh_register_notice( 'my_demo_notice', 'updated', __( 'This is my dismissible notice', PN_TEXTDOMAIN ) );
//{{/unless}}
//WPBPGen{{#unless libraries_julien731__wp-review-me}}
		/*
		 * Review Me notice
		 */
		new WP_Review_Me( array(
			'days_after' => 15,
			'type' => 'plugin',
			'slug' => PN_TEXTDOMAIN,
			'rating' => 5,
			'message' => __( 'Review me!', PN_TEXTDOMAIN ),
			'link_label' => __( 'Click here to review', PN_TEXTDOMAIN )
				) );
//{{/unless}}
//WPBPGen{{#unless libraries_wpbp__cronplus}}
		/*
		 * Load CronPlus 
		 */
		$args = array(
			'recurrence' => 'hourly',
			'schedule' => 'schedule',
			'name' => 'cronplusexample',
			// 'cb' => 'cronplus_example_cb',
			'plugin_root_file' => 'plugin-name.php'
		);

		$cronplus = new CronPlus( $args );
		$cronplus->schedule_event();
//{{/unless}}
//WPBPGen{{#unless libraries_wpbp__cpt_columns}}
		/*
		 * Load CPT_Columns
		 * 
		 * Check the file for example
		 */
		$post_columns = new CPT_columns( 'demo' );
		$post_columns->add_column( 'cmb2_field', array(
			'label' => __( 'CMB2 Field' ),
			'type' => 'post_meta',
			'meta_key' => '_demo_' . PN_TEXTDOMAIN . '_text',
			'orderby' => 'meta_value',
			'sortable' => true,
			'prefix' => '<b>',
			'suffix' => '</b>',
			'def' => 'Not defined', // Default value in case post meta not found
			'order' => '-1'
				)
		);
//{{/unless}}
//WPBPGen{{#unless libraries_yoast__i18n-module}}
		new Yoast_I18n_WordPressOrg_v3(
				array(
			'textdomain' => PN_TEXTDOMAIN,
			'plugin_name' => PN_NAME,
			'hook' => 'admin_notices',
				)
		);
//{{/unless}}
//WPBPGen{{#unless libraries_yoast__whip}}
		whip_wp_check_versions( array(
			'php' => '>=5.6',
		) );
//{{/unless}}
//WPBPGen{{#unless libraries_johnbillion__extended-cpts}}
		$plugin = Plugin_Name::get_instance();
		$this->cpts = $plugin->get_cpts();
//{{/unless}}
		//WPBPGen{{#unless backend_dashboard-activity && libraries_johnbillion__extended-cpts}}
// Activity Dashboard widget for your cpts
		add_filter( 'dashboard_recent_posts_query_args', array( $this, 'cpt_activity_dashboard_support' ), 10, 1 );
//{{/unless}}
//WPBPGen{{#unless libraries_johnbillion__extended-cpts && backend_bubble-notification-pending-cpt}}
		// Add bubble notification for cpt pending
		add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
//{{/unless}}
//WPBPGen{{#unless libraries_wpbp__backbone-modal-view}}
		new BB_Modal_View( array(
			'id' => 'test', // ID of the modal view
			'hook' => 'admin_notices', // Where return or print the button
			'input' => 'checkbox', // Or radio
			'label' => __( 'Open Modal' ), // Button text
			'data' => array( 'rand' => rand() ), // Array of custom datas
			'ajax' => array( $this, 'ajax_posts' ), // Ajax function for the list to show on the modal
			'ajax_on_select' => array( $this, 'ajax_posts_selected' ), // Ajax function to execute on Select button
			'echo_button' => true // Do you want echo the button in the hook chosen or only return?
				) );
//{{/unless}}
	}

	//WPBPGen{{#unless backend_dashboard-activity && libraries_johnbillion__extended-cpts}}
	/**
	 * Add the recents post type in the activity widget<br>
	 * NOTE: add in $post_types your cpts
	 * 
	 * @param array $query_args The content of the widget.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return array
	 */
	function cpt_activity_dashboard_support( $query_args ) {
		if ( !is_array( $query_args[ 'post_type' ] ) ) {
			// Set default post type
			$query_args[ 'post_type' ] = array( 'page' );
		}
		$query_args[ 'post_type' ] = array_merge( $query_args[ 'post_type' ], $this->cpts );
		return $query_args;
	}

	//{{/unless}}
	//WPBPGen{{#unless libraries_johnbillion__extended-cpts && backend_bubble-notification-pending-cpt}}
	/**
	 * Bubble Notification for pending cpt<br>
	 * NOTE: add in $post_types your cpts<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return void
	 */
	function pending_cpt_bubble() {
		global $menu;

		$post_types = $this->cpts;
		foreach ( $post_types as $type ) {
			if ( !post_type_exists( $type ) ) {
				continue;
			}
			// Count posts
			$cpt_count = wp_count_posts( $type );

			if ( $cpt_count->pending ) {
				// Menu link suffix, Post is different from the rest
				$suffix = ( 'post' === $type ) ? '' : '?post_type=' . $type;

				// Locate the key of 
				$key = self::recursive_array_search_php( 'edit.php' . $suffix, $menu );

				// Not found, just in case 
				if ( !$key ) {
					return;
				}

				// Modify menu item
				$menu[ $key ][ 0 ] .= sprintf(
						'<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>', $cpt_count->pending
				);
			}
		}
	}

	/**
	 * Required for the bubble notification<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * 
	 * @param array $needle   First parameter.
	 * @param array $haystack Second parameter.
	 *
	 * @since {{plugin_version}}
	 * 
	 * @return mixed
	 */
	private function recursive_array_search_php( $needle, $haystack ) {
		foreach ( $haystack as $key => $value ) {
			$current_key = $key;
			if ( $needle === $value OR ( is_array( $value ) && self::recursive_array_search_php( $needle, $value ) !== false) ) {
				return $current_key;
			}
		}
		return false;
	}

	//{{/unless}}
	//WPBPGen{{#unless system_transient-example}}
	/**
	 * This method contain an example of code for caching a transient with an external request and parse the results.
	 * 
	 * @return void
	 */
	public function transient_caching_example() {
		$key = 'siteapi_json_transient';

		// Let's see if we have a cached version
		$json_output = get_transient( $key );
		if ( $json_output === false || empty( $json_output ) ) {
			// If there's no cached version we ask 
			$response = wp_remote_get( "http://www.siteapi.org/api/v1/projects?page=1" );
			if ( is_wp_error( $response ) ) {
				// In case API is down we return the last successful count
				return;
			}
			// If everything's okay, parse the body and json_decode it
			$json_output = json_decode( wp_remote_retrieve_body( $response ) );

			// Store the result in a transient, expires after 1 day
			// Also store it as the last successful using update_option
			set_transient( $key, $json_output, DAY_IN_SECONDS );
			update_option( $key, $json_output );
		}

		echo '<div class="siteapi-bridge-container">';
		foreach ( $json_output->projects as &$value ) {
			echo '<div class="siteapi-bridge-single">';
			// json_output is an object so use -> to call children
			echo '</div>';
		}
		echo '</div>';
	}

	//{{/unless}}
	//WPBPGen{{#unless system_push-notification}}
	/**
	 * Send a Push notification on the users browser using the Web Push plugin for WordPress
	 * 
	 * PN_Extras->web_push_notification( 'Title', 'Content', 'http://domain.tld');
	 * 
	 * @param string $title   Title.
	 * @param string $content Content.
	 * @param string $url     URL.
	 * @param string $icon    Icon.
	 */
	public function web_push_notification( $title, $content, $url, $icon = '' ) {
		if ( class_exists( 'WebPush_Main' ) ) {
			if ( empty( $icon ) ) {
				$icon_option = get_option( 'webpush_icon' );
				if ( $icon_option === 'blog_icon' ) {
					$icon = get_site_icon_url();
				} elseif ( $icon_option !== 'blog_icon' && $icon_option !== '' && $icon_option !== 'post_icon' ) {
					$icon = $icon_option;
				}
			}
			WebPush_Main::sendNotification( $title, $content, $icon, $url, null );
		}
		return true;
	}

	//{{/unless}}
}

$pn_extras_admin = new Pn_Extras_Admin();
$pn_extras_admin->initialize();

do_action( 'plugin_name_pn_extras_admin_instance', $pn_extras_admin );
