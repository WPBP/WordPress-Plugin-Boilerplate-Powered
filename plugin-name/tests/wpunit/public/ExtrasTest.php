<?php

use tad\FunctionMocker\FunctionMocker;

class ExtrasTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();
		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		do_action('plugins_loaded');

		// https://github.com/lucatume/function-mocker
		// FunctionMocker::setUp();
	}

	public function tearDown(): void {
		parent::tearDown();
		// FunctionMocker::tearDown();
	}

	private function make_instance() {
		return new \Plugin_Name\Frontend\Extras\Body_Class();
	}

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_add_body_class() {
		// FunctionMocker::replace('get_option', 'another_function');
		$sut = $this->make_instance();
		$list = array('test', 'another-class');
		$this->assertEquals( array_merge($list, array(PN_TEXTDOMAIN)), $sut->add_pn_class($list) );
	}
}
