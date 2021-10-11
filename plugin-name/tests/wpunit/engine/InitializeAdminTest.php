<?php

namespace Plugin_Name\Tests\WPUnit;

class InitializeAdminTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

	$user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		set_current_screen( 'edit.php' );
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be admin
	 */
	public function it_should_be_admin() {
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
		$classes[] = 'Plugin_Name\Backend\ActDeact';
		$classes[] = 'Plugin_Name\Backend\Enqueue';
		$classes[] = 'Plugin_Name\Backend\ImpExp';
		$classes[] = 'Plugin_Name\Backend\Notices';
		$classes[] = 'Plugin_Name\Backend\Pointers';
		$classes[] = 'Plugin_Name\Backend\Settings_Page';

		$this->assertTrue( is_admin() );
		foreach( $classes as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

}
