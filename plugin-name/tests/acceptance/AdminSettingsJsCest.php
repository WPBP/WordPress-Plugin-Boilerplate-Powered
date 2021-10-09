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
