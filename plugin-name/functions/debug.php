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

$pn_debug = new WPBP_Debug( __( 'Plugin Name', PN_TEXTDOMAIN ) );

/**
 * Log text inside the debugging plugins.
 *
 * @param string $text The text.
 * @return void
 */
function pn_log( string $text ) {
	global $pn_debug;
	$pn_debug->log( $text );
}
