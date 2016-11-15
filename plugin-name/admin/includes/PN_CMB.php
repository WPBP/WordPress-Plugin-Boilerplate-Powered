<?php

/**
 * All the CMB related code.
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @license   {{author_license}}
 * @link      {{author_url}}
 * @copyright {{author_copyright}}
 */
class Pn_CMB {

    /**
     * Initialize CMB2.
     *
     * @since     {{plugin_version}}
     */
    public function __construct() {
        add_action( 'cmb2_init', array( $this, 'cmb_demo_metaboxes' ) );
    }

    /**
     * NOTE:     Your metabox on Demo CPT
     *
     * @since    {{plugin_version}}
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
        //WPBPGen{{#unless libraries_origgami__cmb2-grid}}
        $cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
        $row = $cmb2Grid->addRow();
        //{{/unless}}
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
        //WPBPGen{{#unless libraries_origgami__cmb2-grid}}
        $row->addColumns( array( $field1, $field2 ) );
        //{{/unless}}
    }

}

new Pn_CMB();
