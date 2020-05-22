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

	private function make_instance() {
		return new \Plugin_name\Engine\Initialize();
	}

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_be_instantiatable() {
		$sut = $this->make_instance();
		$this->assertInstanceOf( '\\Plugin_name\\Engine\\Initialize', $sut );
	}

	/**
	 * @test
	 * it should be front
	 */
	public function it_should_be_front() {
		$sut = $this->make_instance();

		$classes   = array();
		$classes[] = 'Pn_PostTypes';
		$classes[] = 'Pn_CMB';
		$classes[] = 'Pn_Cron';
		$classes[] = 'Pn_FakePage';
		$classes[] = 'Pn_Template';
		$classes[] = 'Pn_Widgets';
		$classes[] = 'Pn_Rest';
		$classes[] = 'Pn_Transient';
		$classes[] = 'Pn_Ajax';
		$classes[] = 'Pn_Enqueue';
		$classes[] = 'Pn_Extras';

		$this->assertEquals( $classes, $sut->classes );
	}

}
