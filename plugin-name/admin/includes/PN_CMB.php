<?php

/**
 * All the CMB related code.
 *
 * @package   Plugin_Name
 * @author  Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014-2015
 * @since    1.0.0
 */
class Pn_CMB {

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
         * CMB 2 for metabox and many other cool things!
         * https://github.com/WebDevStudios/CMB2
         */
        require_once( plugin_dir_path( __FILE__ ) . '/CMB2/init.php' );
        /*
         * CMB2 CMB2-Google-Maps support 
         * Check on the repo for the example and documentation 
         * https://github.com/mustardBees/cmb_field_map
         */
        require_once( plugin_dir_path( __FILE__ ) . '/CMB2-Google-Maps/cmb-field-map.php' );
        /*
         * CMB2 Grid 
         * Check on the repo for the example and documentation 
         * https://github.com/origgami/CMB2-grid
         */
        require_once( plugin_dir_path( __FILE__ ) . '/CMB2-grid/Cmb2GridPlugin.php' );

        /*
         * Add metabox
         */
        add_action( 'cmb2_init', array( $this, 'cmb_demo_metaboxes' ) );
    }

    /**
     * NOTE:     Your metabox on Demo CPT
     *
     * @since    1.0.0
     * 
     * @return void
     */
    public function cmb_demo_metaboxes() {
        // Start with an underscore to hide fields from custom fields list
        $prefix = '_demo_';
        $cmb_demo = new_cmb2_box( array(
            'id' => $prefix . 'metabox',
            'title' => __( 'Demo Metabox', $this->plugin_slug ),
            'object_types' => array( 'demo', ), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
                ) );
        $cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
        $row = $cmb2Grid->addRow();
        $field1 = $cmb_demo->add_field( array(
            'name' => __( 'Text', $this->plugin_slug ),
            'desc' => __( 'field description (optional)', $this->plugin_slug ),
            'id' => $prefix . $this->plugin_slug . '_text',
            'type' => 'text'
                ) );

        $field2 = $cmb_demo->add_field( array(
            'name' => __( 'Text Small', $this->plugin_slug ),
            'desc' => __( 'field description (optional)', $this->plugin_slug ),
            'id' => $prefix . $this->plugin_slug . '_textsmall',
            'type' => 'text_small'
                ) );
        $row->addColumns( array( $field1, $field2 ) );
    }

}

new Pn_CMB();
