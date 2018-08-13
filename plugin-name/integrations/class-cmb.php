<?php

/**
 * Plugin_Name
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * All the CMB related code.
 */
class Pn_CMB extends Pn_Base {

	/**
	 * Initialize CMB2.
	 *
	 * @since {{plugin_version}}
	 */
	public function initialize() {
        parent::initialize();
		require_once(  PN_PLUGIN_ROOT . 'vendor/cmb2/init.php' );
		//WPBPGen{{#unless libraries_origgami__cmb2-grid}}
		require_once(  PN_PLUGIN_ROOT . 'vendor/cmb2-grid/Cmb2GridPluginLoad.php' );
		//{{/unless}}
		add_action( 'cmb2_init', array( $this, 'cmb_demo_metaboxes' ) );
	}

	/**
	 * Your metabox on Demo CPT
	 *
	 * @since {{plugin_version}}
	 *
	 * @return void
	 */
	public function cmb_demo_metaboxes() {
		// Start with an underscore to hide fields from custom fields list
		$prefix   = '_demo_';
		$cmb_demo = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Demo Metabox', PN_TEXTDOMAIN ),
			'object_types'  => array( 'demo' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			//WPBPGen{{#unless libraries_rubengc__cmb2-tabs}}
			'vertical_tabs' => true, // Set vertical tabs, default false
			'tabs'          => array(
				array(
					'id'     => 'tab-1',
					'icon'   => 'dashicons-admin-site',
					'title'  => 'Tab 1',
					'fields' => array(
						PN_TEXTDOMAIN . '_text',
						PN_TEXTDOMAIN . '_text2',
					),
				),
				array(
					'id'     => 'tab-2',
					'icon'   => 'dashicons-align-left',
					'title'  => 'Tab 2',
					'fields' => array(
                        PN_TEXTDOMAIN . '_textsmall',
						PN_TEXTDOMAIN . '_textsmall2',
					),
				),
			),
		//{{/unless}}
		) );
		//WPBPGen{{#unless libraries_origgami__cmb2-grid}}
		$cmb2Grid = new \Cmb2Grid\Grid\Cmb2Grid( $cmb_demo );
		$row = $cmb2Grid->addRow();
		//{{/unless}}
		$field1 = $cmb_demo->add_field( array(
			'name' => __( 'Text', PN_TEXTDOMAIN ),
			'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
			'id'   => $prefix . PN_TEXTDOMAIN . '_text',
			'type' => 'text',
				) );
		$field2 = $cmb_demo->add_field( array(
			'name' => __( 'Text 2', PN_TEXTDOMAIN ),
			'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
			'id'   => $prefix . PN_TEXTDOMAIN . '_text2',
			'type' => 'text',
				) );

		$field3 = $cmb_demo->add_field( array(
			'name' => __( 'Text Small', PN_TEXTDOMAIN ),
			'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
			'id'   => $prefix . PN_TEXTDOMAIN . '_textsmall',
			'type' => 'text_small',
				) );
		$field4 = $cmb_demo->add_field( array(
			'name' => __( 'Text Small 2', PN_TEXTDOMAIN ),
			'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
			'id'   => $prefix . PN_TEXTDOMAIN . '_textsmall2',
			'type' => 'text_small',
		) );
		//WPBPGen{{#unless libraries_origgami__cmb2-grid}}
		$row->addColumns( array( $field1, $field2 ) );
		$row = $cmb2Grid->addRow();
		$row->addColumns( array( $field3, $field4 ) );
		//{{/unless}}
	}

}
