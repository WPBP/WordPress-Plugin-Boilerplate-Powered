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
 * This class contain the Widget stuff
 */
class Pn_Cron extends Pn_Base {

	/**
	 * Initialize the class
	 */
	public function initialize() {
		//WPBPGen{{#unless libraries_wpbp__cronplus}}
		/*
		 * Load CronPlus
		 */
		$args = array(
			'recurrence'       => 'hourly',
			'schedule'         => 'schedule',
			'name'             => 'cronplusexample',
			'cb'               => array( $this, 'cronplus_example' ),
			'plugin_root_file' => 'plugin-name.php',
		);

		$cronplus = new CronPlus( $args );
        // Schedule the event
		$cronplus->schedule_event();
        // Remove the event by the schedule
        $cronplus->clear_schedule_by_hook();
        // Jump the scheduled event
        $cronplus->unschedule_specific_event();
        //{{/unless}}
	}

	/**
	 * Cron example
	 *
	 * @param integer $id The ID.
	 *
	 * @return void
	 */
	public function cronplus_example( $id ) {
		echo esc_html( $id );
	}

}

