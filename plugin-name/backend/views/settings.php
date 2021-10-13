<?php
/*
 * Retrieve these settings on front end in either of these ways:
 *   $my_setting = cmb2_get_option( PN_TEXTDOMAIN . '-settings', 'some_setting', 'default' );
 *   $my_settings = get_option( PN_TEXTDOMAIN . '-settings', 'default too' );
 * CMB2 Snippet: https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 */
?>
<div id="tabs-1" class="wrap">
			<?php
			// WPBPGen{{#if libraries_cmb2__cmb2}}
			$cmb = new_cmb2_box(
				array(
					'id'         => PN_TEXTDOMAIN . '_options',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( PN_TEXTDOMAIN ) ),
					'show_names' => true,
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => 'text',
					'type'    => 'text',
					'default' => 'Default Text',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => 'colorpicker',
					'type'    => 'colorpicker',
					'default' => '#bada55',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Medium', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_textmedium',
					'type' => 'text_medium',
					// 'repeatable' => true,
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Website URL', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_url',
					'type' => 'text_url',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Email', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_email',
					'type' => 'text_email',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Time', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_time',
					'type' => 'text_time',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_textdate',
					'type' => 'text_date',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker (UNIX timestamp)', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_textdate_timestamp',
					'type' => 'text_date_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Test Money', PN_TEXTDOMAIN ),
					'desc'         => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'           => '_textmoney',
					'type'         => 'text_money',
					'before_field' => '€', // Override '$' symbol if needed
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_textarea',
					'type' => 'textarea',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area for Code', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_textarea_code',
					'type' => 'textarea_code',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Title Weeeee', PN_TEXTDOMAIN ),
					'desc' => __( 'This is a title description', PN_TEXTDOMAIN ),
					'id'   => '_title',
					'type' => 'title',
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Select', PN_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'               => '_select',
					'type'             => 'select',
					'show_option_none' => true,
					'options'          => array(
						'standard' => __( 'Option One', PN_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', PN_TEXTDOMAIN ),
						'none'     => __( 'Option Three', PN_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Radio inline', PN_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'               => '_radio_inline',
					'type'             => 'radio_inline',
					'show_option_none' => 'No Selection',
					'options'          => array(
						'standard' => __( 'Option One', PN_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', PN_TEXTDOMAIN ),
						'none'     => __( 'Option Three', PN_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Radio', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => '_radio',
					'type'    => 'radio',
					'options' => array(
						'option1' => __( 'Option One', PN_TEXTDOMAIN ),
						'option2' => __( 'Option Two', PN_TEXTDOMAIN ),
						'option3' => __( 'Option Three', PN_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Radio', PN_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'       => '_text_taxonomy_radio',
					'type'     => 'taxonomy_radio',
					'taxonomy' => 'category', // Taxonomy Slug
					// 'inline'  => true, // Toggles display to inline
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Select', PN_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'       => '_taxonomy_select',
					'type'     => 'taxonomy_select',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Multi Checkbox', PN_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'       => '_multitaxonomy',
					'type'     => 'taxonomy_multicheck',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Checkbox', PN_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'   => '_checkbox',
					'type' => 'checkbox',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Multi Checkbox', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => '_multicheckbox',
					'type'    => 'multicheck',
					'options' => array(
						'check1' => __( 'Check One', PN_TEXTDOMAIN ),
						'check2' => __( 'Check Two', PN_TEXTDOMAIN ),
						'check3' => __( 'Check Three', PN_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test wysiwyg', PN_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', PN_TEXTDOMAIN ),
					'id'      => '_wysiwyg',
					'type'    => 'wysiwyg',
					'options' => array( 'textarea_rows' => 5 ),
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Image', PN_TEXTDOMAIN ),
					'desc' => __( 'Upload an image or enter a URL.', PN_TEXTDOMAIN ),
					'id'   => '_image',
					'type' => 'file',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Multiple Files', PN_TEXTDOMAIN ),
					'desc'         => __( 'Upload or add multiple images/attachments.', PN_TEXTDOMAIN ),
					'id'           => '_file_list',
					'type'         => 'file_list',
					'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'oEmbed', PN_TEXTDOMAIN ),
					'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', PN_TEXTDOMAIN ),
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

			cmb2_metabox_form( PN_TEXTDOMAIN . '_options', PN_TEXTDOMAIN . '-settings' );
			// {{/if}}
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
