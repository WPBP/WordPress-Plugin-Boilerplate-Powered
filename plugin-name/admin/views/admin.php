<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

<script>
	//Required for multi CMB form
	jQuery(document).ready(function($) {
		jQuery('.cmb-form #wp_meta_box_nonce').appendTo('.cmb-form');
	});
</script>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php _e( 'Settings' ); ?></a></li>
			<li><a href="#tabs-2"><?php _e( 'Settings 2', $this->plugin_slug ); ?></a></li>
		</ul>
		<div id="tabs-1">
			<?php
			// NOTE:Code for CMBF!

			$option_fields = array(
				'id' => $this->plugin_slug . '_options',
				'cmb_show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug . '-settings', ), ),
				'show_names' => true,
				'fields' => array(
					array(
						'name' => __( 'Text', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_text',
						'type' => 'text',
					),
					array(
						'name' => __( 'Color Picker', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_colorpicker',
						'type' => 'colorpicker',
						'default' => '#ffffff'
					),
				),
			);

			cmb_metabox_form( $option_fields, $this->plugin_slug . '-settings' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
		<div id="tabs-2">
			<?php
			// NOTE:Code for CMBF!

			$option_fields = array(
				'id' => $this->plugin_slug . '_options',
				'cmb_show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug . '-settings', ), ),
				'show_names' => true,
				'fields' => array(
					array(
						'name' => __( 'Text2', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_text2',
						'type' => 'text',
					),
					array(
						'name' => __( 'Color Picker2', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_colorpicker2',
						'type' => 'colorpicker',
						'default' => '#ffffff'
					),
				),
			);

			cmb_metabox_form( $option_fields, $this->plugin_slug . '-settings2' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
	</div>
</div>
