<?php

use Codeception\Util\HttpCode;

class CustomRestRouteCest {

	public function _before( FunctionalTester $I ) {
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
