<?php

class AjaxTest extends \Codeception\TestCase\WPAjaxTestCase {

	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );
		apply_filters( 'wp_doing_ajax', defined( 'DOING_AJAX' ) && DOING_AJAX );
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be instantiatable
	 */
	public function it_should_return_default_output() {
		wp_logout();

		try {
			$this->_handleAjax( 'nopriv_your_method' );
		} catch ( WPAjaxDieContinueException $e ) {
			unset( $e );
		}

		$response = json_decode( $this->_last_response, true );
		$return = array( 'success' => true, 'data' => array(
			'message' => 'Saved',
			'ID'      => 1,
		));

		$this->expectException( 'WPAjaxDieContinueException', 'WP Ajax Continue exception' );
		$this->assertEquals( $return, $response );
	}

}
