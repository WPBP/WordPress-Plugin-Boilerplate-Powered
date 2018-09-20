<?php

class AdminAjaxTest extends \Codeception\TestCase\WPAjaxTestCase {

	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		$this->_setRole( 'administrator' );

		// Load again the class for the AJAX mode
		new Pn_Initialize();
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should return default output
	 */
	public function it_should_return_default_output() {
		try {
			$this->_handleAjax( 'your_admin_method' );
			$this->fail( 'Expected exception: WPAjaxDieContinueException' );
		} catch ( WPAjaxDieContinueException $e ) {
			// We expected this, do nothing.
		}

		$response = json_decode( $this->_last_response, true );
		$this->assertTrue( $response[ 'success' ] );

		$return = array(
			'message' => 'Saved',
			'ID'      => 2,
		);

		$this->assertEquals( $return, $response[ 'data' ] );
		$this->assertInternalType( 'array', $response['data'] );
	}

}
