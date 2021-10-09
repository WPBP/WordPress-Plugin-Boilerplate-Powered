<?php
/*
* This file is part of WordPress Plugin Boilerplate Powered.
*
* WordPress Plugin Boilerplate Powered is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* WordPress Plugin Boilerplate Powered is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Foobar.  If not, see <https://www.gnu.org/licenses/>.
*/

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
		// FunctionMocker::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		// FunctionMocker::tearDown();
	}

	private function make_instance() {
		return new \Plugin_name\Frontend\Extras\Body_Class();
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
