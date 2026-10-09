<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

?>

		<div id="tabs-2" class="wrap">
			<?php
			// WPBPGen{{#if libraries_cmb2__cmb2}}
			$cmb = new_cmb2_box(
				array(
					'id'         => 'plugin-name_options-second',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( 'plugin-name' ) ),
					'show_names' => true,
					)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => '_text-second',
					'type'    => 'text',
					'default' => 'Default Text',
			)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => '_colorpicker-second',
					'type'    => 'colorpicker',
					'default' => '#bada55',
			)
			);

			cmb2_metabox_form( 'plugin-name_options-second', 'plugin-name-settings-second' );
			// {{/if}}
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
