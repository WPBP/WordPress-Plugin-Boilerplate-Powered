<?php

use tad\FunctionMocker\FunctionMocker;

class ExtrasTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();
		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		// https://github.com/lucatume/function-mocker
		// FunctionMocker::init();
		// FunctionMocker::replace('get_option', []);
	}

	public function tearDown() {
		parent::tearDown();
	}

	private function make_instance() {
		return new Pn_Extras();
	}

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_add_body_class() {
		$sut = $this->make_instance();
		$list = array('test', 'another-class');
		$this->assertEquals( array_merge($list, array(PN_TEXTDOMAIN)), $sut->add_pn_class($list) );
	}
}
