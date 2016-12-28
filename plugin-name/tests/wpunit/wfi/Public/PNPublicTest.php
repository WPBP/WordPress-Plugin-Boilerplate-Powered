<?php

class PNTestPublic extends \Codeception\TestCase\WPTestCase {

  /**
   * @var string
   */
  protected $root_dir;

  public function setUp() {
    parent::setUp();

    // your set up methods here
    $this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );
  }

  public function tearDown() {
    parent::tearDown();
  }

  /**
   * @test
   * it should be instantiatable
   */
  public function it_should_be_instantiatable() {
    $this->assertInstanceOf( 'Plugin_Name', Plugin_Name::get_instance() );
  }

}
