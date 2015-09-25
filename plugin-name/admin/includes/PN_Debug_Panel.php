<?php

class Pn_Debug_Panel extends Debug_Bar_Panel {

	protected $history = array();

	/**
	 * Register with WordPress API on construct
	 * @param class $parent the parent class
	 */
	function __construct(  ) {
		$this->title( 'Plugin Name Debug' );
	}

	function render() {
		echo "<pre>";
		foreach ( $GLOBALS['PN_Debug'] as $debug ) {
			echo $debug;
		}
		echo "</pre>";
	}

	function prerender() {
		if ( empty( $GLOBALS['PN_Debug'] ) ) {
			$this->set_visible( false );
		}
	}

}
