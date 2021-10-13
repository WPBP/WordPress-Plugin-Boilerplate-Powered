<?php
class AdminSettingsJsCest {

	function _before( AcceptanceTester $I ) {
		// will be executed at the beginning of each test
		$I->loginAsAdmin();
	}

	function jquery_tabs_loaded( AcceptanceTester $I ) {
		$I->am('administrator');
		$I->wantTo('access to the plugin settings and see the tabs working');
		$I->amOnPage('/wp-admin/admin.php?page=plugin-name');
		$I->seeElement('.ui-tabs');
		$I->click('#ui-id-2');
		$I->seeElement('#tabs-2');
	}

}
