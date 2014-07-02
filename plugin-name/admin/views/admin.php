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

	<?php
	
	// NOTE:Code for CMBF!
	
	$option_fields = array(
		'id' => $this->plugin_slug . '_options',
		'show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug . '-settings', ), ),
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
