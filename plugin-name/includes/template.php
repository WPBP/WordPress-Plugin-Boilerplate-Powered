<?php

// NOTE: change the prefix of the function

/**
 * Load template files of the plugin also include a filter pn_get_template_part<br>
 * Based on WooCommerce function<br>
 *
 * @package   Plugin_Name
 * @author  Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014 
 * @since    1.0.0
 */
function pn_get_template_part( $slug, $name = '', $include = true ) {
	$template = '';
	$path = plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . 'templates/';
	$plugin = Plugin_Name::get_instance();
	$plugin_slug = $plugin->get_plugin_slug().'/';
	
	// Look in yourtheme/slug-name.php and yourtheme/plugin-name/slug-name.php
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", $plugin_slug . "{$slug}-{$name}.php" ) );
	} else {
		$template = locate_template( array( "{$slug}.php", $plugin_slug . "{$slug}.php" ) );
	}
	
	// Get default slug-name.php
	if ( !$template && $name && file_exists( $path . "{$slug}-{$name}.php" ) ) {
		$template = $path . "{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
	if ( !$template ) {
		$template = locate_template( array( "{$slug}.php", $plugin_slug . "{$slug}.php" ) );
	}

	// Allow 3rd party plugin filter template file from their plugin
	$template = apply_filters( 'pn_get_template_part', $template, $slug, $name );

	if ( $template && $include === true ) {
		load_template( $template, false );
	} else if($template && $include === false ) {
		return $template;
	}
}
