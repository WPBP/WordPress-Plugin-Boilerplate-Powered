<?php

/**
 * All the WP pointers.
 *
 * @package   Plugin_Name
 * @author  Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014-2015
 * @since    1.0.0
 */
class Pn_Pointers {

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    public function __construct() {
        $plugin = Plugin_Name::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();
        /*
         * Load PointerPlus for the Wp Pointer
         * 
         * Unique parameter is the prefix
         */
        if ( !class_exists( 'PointerPlus' ) ) {
            require_once( plugin_dir_path( __FILE__ ) . 'PointerPlus/class-pointerplus.php' );
        }
        new PointerPlus( array( 'prefix' => $this->plugin_slug ) );
        add_filter( $this->plugin_slug . '-pointerplus_list', array( $this, 'custom_initial_pointers' ), 10, 2 );
    }

    /**
     * Add pointers.
     * Check on https://github.com/Mte90/pointerplus/blob/master/pointerplus.php for examples
     *
     * @param array $pointers The list of pointers.
     * @param array $prefix For your pointers.
     *
     * @return mixed
     */
    function custom_initial_pointers( $pointers, $prefix ) {
        return array_merge( $pointers, array(
            $prefix . '_contextual_tab' => array(
                'selector' => '#contextual-help-link',
                'title' => __( 'Boilerplate Help', $this->plugin_slug ),
                'text' => __( 'A pointer for help tab.<br>Go to Posts, Pages or Users for other pointers.', $this->plugin_slug ),
                'edge' => 'top',
                'align' => 'right',
                'icon_class' => 'dashicons-welcome-learn-more',
            )
                ) );
    }

}

new Pn_Pointers();
