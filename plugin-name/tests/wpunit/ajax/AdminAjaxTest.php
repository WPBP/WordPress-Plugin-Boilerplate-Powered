<?php

namespace Plugin_Name\Tests\WPUnit;

class AdminAjaxTest extends \Codeception\TestCase\WPAjaxTestCase {

	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );
		$user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		define('WP_ADMIN', true);
		add_filter( 'wp_doing_ajax', '__return_true' );

		$this->_setRole( 'administrator' );

		do_action('plugins_loaded');
	}

	public function tearDown(): void {
		parent::tearDown();
		add_filter( 'wp_doing_ajax', '__return_false' );
	}

	/**
	 * @test
	 * it should return default output
	 */
	public function it_should_return_default_output() {
		try {
			$this->_handleAjax( 'your_admin_method' );
			$this->fail( 'Expected exception: WPAjaxDieContinueException' );
		} catch ( \WPAjaxDieContinueException $e ) {
			// We expected this, do nothing.
		}

		$response = json_decode( $this->_last_response, true );
		$this->assertTrue( $response[ 'success' ] );

		$return = array(
			'message' => 'Saved',
			'ID'      => 2,
		);

		$this->assertEquals( $return, $response[ 'data' ] );
		$this->assertIsArray( $response['data'] );
	}

}
