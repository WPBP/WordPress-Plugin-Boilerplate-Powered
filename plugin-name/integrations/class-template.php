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
 * This class contain the Templating stuff for the frontend
 */
class Pn_Template extends Pn_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
        parent::initialize();
		//WPBPGen{{#unless frontend_template-system}}
		// Override the template hierarchy for load /templates/content-demo.php
		add_filter( 'template_include', array( __CLASS__, 'load_content_demo' ) );
		//{{/unless}}
	}

	//WPBPGen{{#unless frontend_template-system}}
	/**
	 * Example for override the template system on the frontend
	 *
	 * @param string $original_template The original templace HTML.
	 *
	 * @since {{plugin_version}}
	 *
	 * @return string
	 */
	public static function load_content_demo( $original_template ) {
		if ( is_singular( 'demo' ) && in_the_loop() ) {
			return wpbp_get_template_part( PN_TEXTDOMAIN, 'content', 'demo', false );
		}

		return $original_template;
	}

	//{{/unless}}
}
