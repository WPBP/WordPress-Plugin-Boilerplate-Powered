<?php

namespace Plugin_Name\Tests\WPUnit;

class AjaxTest extends \Codeception\TestCase\WPAjaxTestCase {

	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUpBeforeClass(): void {
		parent::setUpBeforeClass();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		define('DOING_AJAX', true);
		do_action('plugins_loaded');
	}

	public function tearDownAfterClass(): void {
		parent::tearDownAfterClass();
		define('DOING_AJAX', false);
	}

	/**
	 * @test
	 * it should return default output
	 */
	public function it_should_return_default_output() {
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
		$this->assertIsArray( $response['data'] );
	}

}
