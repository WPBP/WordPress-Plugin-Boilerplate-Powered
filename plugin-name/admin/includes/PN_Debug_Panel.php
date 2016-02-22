<?php

class Pn_Debug_Panel extends Debug_Bar_Panel {

	protected $history = array();

	/**
	 * Register with WordPress API on construct
	 */
	function __construct(  ) {
		$this->title( 'Plugin Name Debug' );
	}

      /**
       * @return void
       */
	function render() {
		echo "<pre>";
		foreach ( $GLOBALS['PN_Debug'] as $debug ) {
			echo $debug;
		}
		echo "</pre>";
	}

      /**
       * 
       * @return void
       */
	function prerender() {
		if ( empty( $GLOBALS['PN_Debug'] ) ) {
			$this->set_visible( false );
		}
	}

}
