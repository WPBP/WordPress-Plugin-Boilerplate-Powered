<?php
class AdminEnqueueCest {
    function _before(AcceptanceTester $I) {
        // will be executed at the beginning of each test
		$I->loginAsAdmin();
    }

    function enqueue_admin_scripts(AcceptanceTester $I) {
		$I->am('an administrator');
		$I->wantTo('access to the plugin settings page and check the scripts enqueue');
        $I->amOnPage('/wp-admin/admin.php?page=plugin-name');
        $I->seeInPageSource('plugin-name-settings-script');
		$I->seeInPageSource('plugin-name-admin-script');
	}

	function enqueue_admin_styles(AcceptanceTester $I) {
		$I->am('an administrator');
		$I->wantTo('access to the plugin settings page and check the style enqueue');
		$I->amOnPage('/wp-admin/admin.php?page=plugin-name');
		$I->seeInPageSource('plugin-name-settings-styles-css');
		$I->seeInPageSource('plugin-name-admin-styles-css');
	}


}



