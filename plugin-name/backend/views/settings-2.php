		<div id="tabs-2" class="wrap">
			<?php
			// WPBPGen{{#if libraries_cmb2__cmb2}}
			$cmb = new_cmb2_box(
				array(
					'id'         => PN_TEXTDOMAIN . '_options-second',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( PN_TEXTDOMAIN ) ),
					'show_names' => true,
					)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => '_text-second',
					'type'    => 'text',
					'default' => 'Default Text',
			)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => '_colorpicker-second',
					'type'    => 'colorpicker',
					'default' => '#bada55',
			)
			);

			cmb2_metabox_form( PN_TEXTDOMAIN . '_options-second', PN_TEXTDOMAIN . '-settings-second' );
			// {{/if}}
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
