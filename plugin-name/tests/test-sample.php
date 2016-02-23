<?php

/**
 * http://wpthemetutorial.com/2014/08/28/tools-unit-testing-trade/
 */
class SampleTest extends WP_UnitTestCase {

    function test_sample() {
        $plugin = Plugin_Name::instance();
        $data = get_plugin_data( __DIR__ . '/../plugin-name.php' );
        $this->assertEquals( $plugin::version, $data[ 'Version' ] );
    }

}
