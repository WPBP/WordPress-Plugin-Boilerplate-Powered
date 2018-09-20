<?php

class InitializeAdminTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp() {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

        $user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		$user = wp_set_current_user( $user_id );
		set_current_screen( 'edit.php' );
	}

	public function tearDown() {
		parent::tearDown();
	}

	private function make_instance() {
		return new Pn_Initialize();
	}

	/**
	 * @test
	 * it should be admin
	 */
	public function it_should_be_admin() {
		$sut = $this->make_instance();

		$classes   = array();
		$classes[] = 'Pn_PostTypes';
		$classes[] = 'Pn_CMB';
		$classes[] = 'Pn_Cron';
		$classes[] = 'Pn_FakePage';
		$classes[] = 'Pn_Template';
		$classes[] = 'Pn_Widgets';
		$classes[] = 'Pn_Rest';
		$classes[] = 'Pn_Transient';
 		$classes[] = 'Pn_Ajax';
 		$classes[] = 'Pn_Ajax_Admin';
		$classes[] = 'Pn_Pointers';
		$classes[] = 'Pn_ContextualHelp';
		$classes[] = 'Pn_Admin_ActDeact';
		$classes[] = 'Pn_Admin_Notices';
		$classes[] = 'Pn_Admin_Settings_Page';
		$classes[] = 'Pn_Admin_Enqueue';
		$classes[] = 'Pn_Admin_ImpExp';
		$classes[] = 'Pn_Enqueue';
		$classes[] = 'Pn_Extras';

		$this->assertTrue( is_admin() );
		$this->assertEquals( $classes, $sut->classes );
	}

}
