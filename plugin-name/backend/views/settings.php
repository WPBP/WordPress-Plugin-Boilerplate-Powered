<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/*
 * Retrieve these settings on front end in either of these ways:
 *   $my_setting = cmb2_get_option( 'plugin-name' . '-settings', 'some_setting', 'default' );
 *   $my_settings = get_option( 'plugin-name' . '-settings', 'default too' );
 * CMB2 Snippet: https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 */
?>
<div id="tabs-1" class="wrap">
			<?php
			// WPBPGen{{#if libraries_cmb2__cmb2}}
			$cmb = new_cmb2_box(
				array(
					'id'         => 'plugin-name_options',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( 'plugin-name' ) ),
					'show_names' => true,
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => 'text',
					'type'    => 'text',
					'default' => 'Default Text',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => 'colorpicker',
					'type'    => 'colorpicker',
					'default' => '#bada55',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Medium', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_textmedium',
					'type' => 'text_medium',
					// 'repeatable' => true,
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Website URL', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_url',
					'type' => 'text_url',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Email', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_email',
					'type' => 'text_email',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Time', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_time',
					'type' => 'text_time',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_textdate',
					'type' => 'text_date',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker (UNIX timestamp)', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_textdate_timestamp',
					'type' => 'text_date_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Test Money', 'plugin-name' ),
					'desc'         => __( 'field description (optional)', 'plugin-name' ),
					'id'           => '_textmoney',
					'type'         => 'text_money',
					'before_field' => '€', // Override '$' symbol if needed
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_textarea',
					'type' => 'textarea',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area for Code', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_textarea_code',
					'type' => 'textarea_code',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Title Weeeee', 'plugin-name' ),
					'desc' => __( 'This is a title description', 'plugin-name' ),
					'id'   => '_title',
					'type' => 'title',
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Select', 'plugin-name' ),
					'desc'             => __( 'field description (optional)', 'plugin-name' ),
					'id'               => '_select',
					'type'             => 'select',
					'show_option_none' => true,
					'options'          => array(
						'standard' => __( 'Option One', 'plugin-name' ),
						'custom'   => __( 'Option Two', 'plugin-name' ),
						'none'     => __( 'Option Three', 'plugin-name' ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Radio inline', 'plugin-name' ),
					'desc'             => __( 'field description (optional)', 'plugin-name' ),
					'id'               => '_radio_inline',
					'type'             => 'radio_inline',
					'show_option_none' => 'No Selection',
					'options'          => array(
						'standard' => __( 'Option One', 'plugin-name' ),
						'custom'   => __( 'Option Two', 'plugin-name' ),
						'none'     => __( 'Option Three', 'plugin-name' ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Radio', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => '_radio',
					'type'    => 'radio',
					'options' => array(
						'option1' => __( 'Option One', 'plugin-name' ),
						'option2' => __( 'Option Two', 'plugin-name' ),
						'option3' => __( 'Option Three', 'plugin-name' ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Radio', 'plugin-name' ),
					'desc'     => __( 'field description (optional)', 'plugin-name' ),
					'id'       => '_text_taxonomy_radio',
					'type'     => 'taxonomy_radio',
					'taxonomy' => 'category', // Taxonomy Slug
					// 'inline'  => true, // Toggles display to inline
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Select', 'plugin-name' ),
					'desc'     => __( 'field description (optional)', 'plugin-name' ),
					'id'       => '_taxonomy_select',
					'type'     => 'taxonomy_select',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Multi Checkbox', 'plugin-name' ),
					'desc'     => __( 'field description (optional)', 'plugin-name' ),
					'id'       => '_multitaxonomy',
					'type'     => 'taxonomy_multicheck',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Checkbox', 'plugin-name' ),
					'desc' => __( 'field description (optional)', 'plugin-name' ),
					'id'   => '_checkbox',
					'type' => 'checkbox',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Multi Checkbox', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => '_multicheckbox',
					'type'    => 'multicheck',
					'options' => array(
						'check1' => __( 'Check One', 'plugin-name' ),
						'check2' => __( 'Check Two', 'plugin-name' ),
						'check3' => __( 'Check Three', 'plugin-name' ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test wysiwyg', 'plugin-name' ),
					'desc'    => __( 'field description (optional)', 'plugin-name' ),
					'id'      => '_wysiwyg',
					'type'    => 'wysiwyg',
					'options' => array( 'textarea_rows' => 5 ),
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Image', 'plugin-name' ),
					'desc' => __( 'Upload an image or enter a URL.', 'plugin-name' ),
					'id'   => '_image',
					'type' => 'file',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Multiple Files', 'plugin-name' ),
					'desc'         => __( 'Upload or add multiple images/attachments.', 'plugin-name' ),
					'id'           => '_file_list',
					'type'         => 'file_list',
					'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'oEmbed', 'plugin-name' ),
					'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'plugin-name' ),
					'id'   => '_embed',
					'type' => 'oembed',
				)
			);
			$cmb->add_field(
				array(
					'name'         => 'Testing Field Parameters',
					'id'           => '_parameters',
					'type'         => 'text',
					'before_row'   => '<p>before_row_if_2</p>', // Callback
					'before'       => '<p>Testing <b>"before"</b> parameter</p>',
					'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
					'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
					'after'        => '<p>Testing <b>"after"</b> parameter</p>',
					'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
				)
			);

			cmb2_metabox_form( 'plugin-name_options', 'plugin-name-settings' );
			// {{/if}}
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
