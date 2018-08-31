<?php
class InternalShortcodeCest {

	function _before(AcceptanceTester $I) {
		// will be executed at the beginning of each test
		$I->loginAsAdmin();
	}

	function test_shortcode(AcceptanceTester $I) {
		$I->am('user');
		$I->wantTo('shortcode rendered as intended');

		$shortcode_post = array(
			'post_title' => 'Test shortcode',
			'post_content' => '[foobar foo=\'fuu\' bar=\'bur\']',
			'post_type' => 'post',
			'post_status' => 'publish',
		);
		wp_insert_post( $shortcode_post );

		$post_id = $I->havePostInDatabase( [ 'post_content' => $shortcode_post[ 'post_content' ] ] );
		$I->amOnPage( '/?p=' . $post_id );
		$I->seeInPageSource('<span class="foo">foo = fuu</span>' .
			'<span class="bar">foo = bur</span>');
	}

}
