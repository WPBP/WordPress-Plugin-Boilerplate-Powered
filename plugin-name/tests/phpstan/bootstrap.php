<?php

define( 'PN_PLUGIN_ROOT', __DIR__ );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', '{{plugin_name}}' );
define( 'PN_PLUGIN_ABSOLUTE', __DIR__ );
define( 'PN_VERSION', '{{plugin_version}}' );

// WPBPGen{{#if libraries_cmb2__cmb2}}
// Load CMB2
define( 'CMB2_DIR', dirname( __DIR__, 2 ) . '/vendor/cmb2/' );
require_once CMB2_DIR . 'includes/helper-functions.php';
spl_autoload_register( 'cmb2_autoload_classes' );

// Load Cmb2Grid
spl_autoload_register( function ( $class ) {
	$prefix = 'Cmb2Grid\\';
	$base_dir = dirname( __DIR__, 2 ) . '/vendor/cmb2-grid/';
	$sep = '/';
	$length = strlen( $prefix );
	if ( strncmp( $prefix, $class, $length ) !== 0 ) {
		return;
	}
	$relative_class = substr( $class, $length );
	$file = $base_dir . str_replace( '\\', $sep, $relative_class ) . '.php';
	if ( file_exists( $file ) ) {
		require_once $file;
	}
} );
// {{/if}}
