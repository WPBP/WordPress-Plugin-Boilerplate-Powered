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
namespace Plugin_Name\Integrations;

use \Plugin_Name\Engine;

/**
 * The various Cron of this plugin
 */
class Cron extends Engine\Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		/*
		 * Load CronPlus
		 */
		$args = array(
			'recurrence'       => 'hourly',
			'schedule'         => 'schedule',
			'name'             => 'hourly_cron',
			'cb'               => array( $this, 'hourly_cron' ),
			'plugin_root_file' => 'plugin-name.php',
		);

		$cronplus = new \CronPlus( $args );
        // Schedule the event
		$cronplus->schedule_event();
        // Remove the event by the schedule
        // $cronplus->clear_schedule_by_hook();
        // Jump the scheduled event
        // $cronplus->unschedule_specific_event();
	}

	/**
	 * Cron Hourly example
	 *
	 * @since {{plugin_version}}
	 *
	 * @param integer $id The ID.
	 *
	 * @return void
	 */
	public function hourly_cron( $id ) {
		echo esc_html( $id );
	}

}

