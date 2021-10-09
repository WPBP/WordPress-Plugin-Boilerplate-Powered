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

namespace Plugin_Name\Tests\WPUnit;

class AjaxTest extends \Codeception\TestCase\WPAjaxTestCase {

	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );
	}

	public function tearDown() {
		parent::tearDown();
	}

	private function make_instance() {
		return new \Plugin_name\Engine\Initialize();
	}


	/**
	 * @test
	 * it should return default output
	 */
	public function it_should_return_default_output() {
		$this->make_instance();

		wp_logout();

		try {
			$this->_handleAjax( 'nopriv_your_method' );
			$this->fail( 'Expected exception: WPAjaxDieContinueException' );
		} catch ( \WPAjaxDieContinueException $e ) {
			// We expected this, do nothing.
		}

		$response = json_decode( $this->_last_response, true );
		$this->assertTrue( $response[ 'success' ] );

		$return = array(
			'message' => 'Saved',
			'ID'      => 1,
		);

		$this->assertEquals( $return, $response[ 'data' ] );
		$this->assertInternalType( 'array', $response['data'] );
	}

}
