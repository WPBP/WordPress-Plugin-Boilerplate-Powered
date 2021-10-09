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

define( 'PN_PLUGIN_ROOT', __DIR__ );
define( 'PN_TEXTDOMAIN', 'plugin-name' );
define( 'PN_NAME', '{{plugin_name}}' );
define( 'PN_PLUGIN_ABSOLUTE', __DIR__ );
define( 'PN_VERSION', '{{plugin_version}}' );

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
