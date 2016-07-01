<?php

/**
 * Load the plugin text domain for translation.
 *
 * @since    1.0.0
 * @package   Plugin_Name
 * @author  Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014-2015
 * 
 * @return void
 */
function pn_load_plugin_textdomain() {
	$locale = apply_filters( 'plugin_locale', get_locale(), PN_TEXTDOMAIN );

	load_textdomain( PN_TEXTDOMAIN, trailingslashit( WP_LANG_DIR ) . PN_TEXTDOMAIN . '/' . PN_TEXTDOMAIN . '-' . $locale . '.mo' );
	load_plugin_textdomain( PN_TEXTDOMAIN, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'pn_load_plugin_textdomain', 1 );
