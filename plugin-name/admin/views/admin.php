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

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php _e( 'Settings' ); ?></a></li>
			<li><a href="#tabs-2"><?php _e( 'Settings 2', $this->plugin_slug ); ?></a></li>
			<li><a href="#tabs-3"><?php _e( 'Import/Export', $this->plugin_slug ); ?></a></li>
		</ul>
		<div id="tabs-1">
			<?php

			$option_fields = array(
				'id' => $this->plugin_slug . '_options',
				'show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug ), ),
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

			cmb2_metabox_form( $option_fields, $this->plugin_slug . '-settings' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
		<div id="tabs-2">
			<?php

			$option_fields_second = array(
				'id' => $this->plugin_slug . '_options-second',
				'show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug ), ),
				'show_names' => true,
				'fields' => array(
					array(
						'name' => __( 'Text2', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_text-second',
						'type' => 'text',
					),
					array(
						'name' => __( 'Color Picker2', $this->plugin_slug ),
						'desc' => __( 'field description (optional)', $this->plugin_slug ),
						'id' => $this->plugin_slug . '_colorpicker-second',
						'type' => 'colorpicker',
						'default' => '#ffffff'
					),
				),
			);

			cmb2_metabox_form( $option_fields_second, $this->plugin_slug . '-settings-second' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
		<div id="tabs-3" class="metabox-holder">
			<div class="postbox">
				<h3 class="hndle"><span><?php _e( 'Export Settings', $this->plugin_slug ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', $this->plugin_slug ); ?></p>
					<form method="post">
						<p><input type="hidden" name="pn_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'pn_export_nonce', 'pn_export_nonce' ); ?>
							<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div>
			</div>

			<div class="postbox">
				<h3 class="hndle"><span><?php _e( 'Import Settings', $this->plugin_slug ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', $this->plugin_slug ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="pn_import_file"/>
						</p>
						<p>
							<input type="hidden" name="pn_action" value="import_settings" />
							<?php wp_nonce_field( 'pn_import_nonce', 'pn_import_nonce' ); ?>
							<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
