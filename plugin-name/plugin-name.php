<?php

/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 *
 * Plugin Name:       @TODO
 * Plugin URI:        @TODO
 * Description:       @TODO
 * Version:           1.0.0
 * Author:            @TODO
 * Author URI:        @TODO
 * Text Domain:       plugin-name
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * WordPress-Plugin-Boilerplate-Powered: v2.0.0
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

define('PN_VERSION', '1.0.0');
define('PN_TEXTDOMAIN', 'plugin-name');
define('PN_NAME', 'Plugin Name');

/*
 * ------------------------------------------------------------------------------
 * Public-Facing Functionality
 * ------------------------------------------------------------------------------
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/load_textdomain.php' );

/*
 * Load library for simple and fast creation of Taxonomy and Custom Post Type
 */

require_once( plugin_dir_path( __FILE__ ) . 'includes/Taxonomy_Core/Taxonomy_Core.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/CPT_Core/CPT_Core.php' );

/*
 * Load template system
 */

require_once( plugin_dir_path( __FILE__ ) . 'includes/template.php' );

/** 
 * Create a helper function for easy SDK access.
 * 
 * @global type $pn_fs
 * @return object
 */
function pn_fs() {
    global $pn_fs;

    if ( ! isset( $pn_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/includes/freemius/start.php';

        $pn_fs = fs_dynamic_init( array(
            'id'                => '',
            'slug'              => 'plugin-name',
            'public_key'        => '',
            'is_live'           => false,
            'is_premium'        => true,
            'has_addons'        => false,
            'has_paid_plans'    => true,
            'menu'              => array(
                'slug'       => 'plugin-name'
            ),
        ) );
    }

    return $pn_fs;
}

// Init Freemius.
// pn_fs();

/*
 * Load Widgets Helper
 */

require_once( plugin_dir_path( __FILE__ ) . 'includes/Widgets-Helper/wph-widget-class.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/sample.php' );

/*
 * Load Fake Page class
 */

require_once( plugin_dir_path( __FILE__ ) . 'includes/fake-page.php' );

new Fake_Page(
	array(
    'slug' => 'fake_slug',
    'post_title' => 'Fake Page Title',
    'post_content' => 'This is the fake page content'
	)
);

/*
 * Load Language wrapper function for WPML/Ceceppa Multilingua/Polylang
 */

require_once( plugin_dir_path( __FILE__ ) . 'includes/language.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/Plugin_Name.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/PN_ActDeact.php' );

/*
 * -----------------------------------------------------------------------------
 * Dashboard and Administrative Functionality
 * -----------------------------------------------------------------------------
*/

/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */

if ( is_admin() && (!defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/Plugin_Name_Admin.php' );
}
