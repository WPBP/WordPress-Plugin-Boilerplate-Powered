<?php

class CliCest {

	/**
	 * It should not fail!
	 *
	 * @test
	 */
	public function it_should_not_fail_when_default_command_is_executed(FunctionalTester $I) {
		$I->cli('pn_commandname 1');
		$I->seeInShellOutput('Success: 1
		Warning: 1
		Error: 1');
		$I->seeResultCodeIs(0);
	}
}
