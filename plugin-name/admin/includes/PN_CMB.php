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
     * Initialize CMB2.
     *
     * @since     1.0.0
     */
    public function __construct() {
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
            'title' => __( 'Demo Metabox', PN_TEXTDOMAIN ),
            'object_types' => array( 'demo', ), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
                ) );
        $cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
        $row = $cmb2Grid->addRow();
        $field1 = $cmb_demo->add_field( array(
            'name' => __( 'Text', PN_TEXTDOMAIN ),
            'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
            'id' => $prefix . PN_TEXTDOMAIN . '_text',
            'type' => 'text'
                ) );

        $field2 = $cmb_demo->add_field( array(
            'name' => __( 'Text Small', PN_TEXTDOMAIN ),
            'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
            'id' => $prefix . PN_TEXTDOMAIN . '_textsmall',
            'type' => 'text_small'
                ) );
        $row->addColumns( array( $field1, $field2 ) );
    }

}

new Pn_CMB();
