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

function pn_log( $text ) {
	global $pn_debug;
	$pn_debug->log( $text );
}

