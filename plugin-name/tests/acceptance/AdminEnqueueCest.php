<?php
class AdminEnqueueCest {
    function _before(AcceptanceTester $I) {
        // will be executed at the beginning of each test
		$I->loginAsAdmin();
    }

    function add_action_link(AcceptanceTester $I) {
		$I->am('an administrator');
		$I->wantTo('access to the plugin settings page and check the file enqueue');
        $I->amOnPage('/wp-admin/admin.php?page=plugin-name');
        $I->seeInPageSource('plugin-name-settings-styles-css');
        $I->seeInPageSource('plugin-name-admin-styles-css');
    }

}



