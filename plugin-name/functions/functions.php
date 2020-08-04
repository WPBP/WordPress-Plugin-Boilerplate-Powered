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
 * Get the settings of the plugin in a filterable way
 *
 * @since {{plugin_version}}
 * @return array
 */
function pn_get_settings() {
	return apply_filters( 'pn_get_settings', get_option( PN_TEXTDOMAIN . '-settings' ) );
}
