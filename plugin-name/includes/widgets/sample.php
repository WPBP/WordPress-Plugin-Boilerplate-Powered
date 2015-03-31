<?php

// Create custom widget class extending WPH_Widget
class My_Recent_Posts_Widget extends WPH_Widget {

	function __construct() {
		
		$plugin = Plugin_Name::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Configure widget array
		$args = array(
			'label' => __( 'My Recent Posts', $this->plugin_slug ),
			'description' => __( 'My Recent Posts Widget Description', $this->plugin_slug ),
		);

		// Configure the widget fields
		// Example for: Title ( text ) and Amount of posts to show ( select box )
		$args[ 'fields' ] = array(
			// Title field
			array(
				// field name/label									
				'name' => __( 'Title', $this->plugin_slug ),
				// field description					
				'desc' => __( 'Enter the widget title.', $this->plugin_slug ),
				// field id		
				'id' => 'title',
				// field type ( text, checkbox, textarea, select, select-group )								
				'type' => 'text',
				// class, rows, cols								
				'class' => 'widefat',
				// default value						
				'std' => __( 'Recent Posts', $this->plugin_slug ),
				/*
				  Set the field validation type/s
				  ///////////////////////////////

				  'alpha_dash'
				  Returns FALSE if the value contains anything other than alpha-numeric characters, underscores or dashes.

				  'alpha'
				  Returns FALSE if the value contains anything other than alphabetical characters.

				  'alpha_numeric'
				  Returns FALSE if the value contains anything other than alpha-numeric characters.

				  'numeric'
				  Returns FALSE if the value contains anything other than numeric characters.

				  'boolean'
				  Returns FALSE if the value contains anything other than a boolean value ( true or false ).

				  ----------

				  You can define custom validation methods. Make sure to return a boolean ( TRUE/FALSE ).
				  Example:

				  'validate' => 'my_custom_validation',

				  Will call for: $this->my_custom_validation( $value_to_validate );

				 */
				'validate' => 'alpha_dash',
				/*

				  Filter data before entering the DB
				  //////////////////////////////////

				  strip_tags ( default )
				  wp_strip_all_tags
				  esc_attr
				  esc_url
				  esc_textarea

				 */
				'filter' => 'strip_tags|esc_attr'
			),
			// Amount Field
			array(
				'name' => __( 'Amount' ),
				'desc' => __( 'Select how many posts to show.', $this->plugin_slug ),
				'id' => 'amount',
				'type' => 'select',
				// selectbox fields			
				'fields' => array(
					array(
						// option name
						'name' => __( '1 Post', $this->plugin_slug ),
						// option value			
						'value' => '1'
					),
					array(
						'name' => __( '2 Posts', $this->plugin_slug ),
						'value' => '2'
					),
					array(
						'name' => __( '3 Posts', $this->plugin_slug ),
						'value' => '3'
					)

				// add more options
				),
				'validate' => 'my_custom_validation',
				'filter' => 'strip_tags|esc_attr',
			),
			// Output type checkbox
			array(
				'name' => __( 'Output as list', $this->plugin_slug ),
				'desc' => __( 'Wraps posts with the <li> tag.', $this->plugin_slug ),
				'id' => 'list',
				'type' => 'checkbox',
				// checked by default: 
				'std' => 1, // 0 or 1
				'filter' => 'strip_tags|esc_attr',
			),
				// add more fields
		); // fields array
		// create widget
		$this->create_widget( $args );
	}

	// Custom validation for this widget 

	function my_custom_validation( $value ) {
		if ( strlen( $value ) > 1 ) {
			return false;
		} else {
			return true;
		}
	}

	// Output function

	function widget( $args, $instance ) {

		// And here do whatever you want
		$out = $args[ 'before_title' ];
		$out .= $instance[ 'title' ];
		$out .= $args[ 'after_title' ];

		// here you would get the most recent posts based on the selected amount: $instance['amount'] 
		// Then return those posts on the $out variable ready for the output

		$out .= '<p>Hey There! </p>';

		echo apply_filters( 'widget_text', $out );
	}

}

// Register widget
if ( !function_exists( 'my_register_widget' ) ) {

	function my_register_widget() {
		register_widget( 'My_Recent_Posts_Widget' );
	}

	add_action( 'widgets_init', 'my_register_widget', 1 );
}
