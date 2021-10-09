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

use Codeception\Util\HttpCode;

class CustomRestRouteCest {

	public function _before(FunctionalTester $I ) {
		$I->am('user');
	}
	/**
	 * @test
	 * it should access custom endpoint
	 */
	public function it_should_access_custom_endpoint( FunctionalTester $I ) {
		$I->wantTo('access on the custom endpoint');
		$I->sendGET( 'calc' );
		$I->seeResponseCodeIs(HttpCode::OK); // 200
		$I->seeResponseContains('{"result":11}');
	}

	/**
	 * @test
	 * it should access custom endpoint with parameters
	 */
	public function it_should_access_custom_endpoint_with_parameters( FunctionalTester $I ) {
		$I->wantTo('access on the custom endpoint');
		$I->sendGET( 'calc', array( 'first' => 4, 'second' => 4 ) );
		$I->seeResponseCodeIs(HttpCode::OK); // 200
		$I->seeResponseContains('{"result":8}');
	}
}
