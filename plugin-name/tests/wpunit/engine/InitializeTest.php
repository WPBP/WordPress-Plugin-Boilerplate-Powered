<?php

namespace Plugin_Name\Tests\WPUnit;

class InitializeTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

	wp_set_current_user(0);
	wp_logout();
	wp_safe_redirect(wp_login_url());
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be front
	 */
	public function it_should_be_front() {
		$classes   = array();
		$classes[] = 'Plugin_Name\Internals\PostTypes';
		$classes[] = 'Plugin_Name\Internals\Shortcode';
		$classes[] = 'Plugin_Name\Internals\Transient';
		$classes[] = 'Plugin_Name\Integrations\CMB';
		$classes[] = 'Plugin_Name\Integrations\Cron';
		$classes[] = 'Plugin_Name\Integrations\FakePage';
		$classes[] = 'Plugin_Name\Integrations\Template';
		$classes[] = 'Plugin_Name\Integrations\Widgets';
		$classes[] = 'Plugin_Name\Ajax\Ajax';
		$classes[] = 'Plugin_Name\Ajax\Ajax_Admin';
		$classes[] = 'Plugin_Name\Frontend\Enqueue';
		$classes[] = 'Plugin_Name\Frontend\extras\Body_Class';

		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
