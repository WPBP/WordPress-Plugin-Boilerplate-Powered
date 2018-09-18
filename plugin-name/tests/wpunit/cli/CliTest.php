<?php

class CliTest extends \Codeception\Test\Unit {
    /**
     * @return WPCLI
     */
    private function make_instance() {
        return new WPCLI();
    }

    /**
     * It should not fail!
     *
     * @test
     */
    public function it_should_not_fail_when_default_command_is_executed() {
        $sut = $this->make_instance();
        $sut->cli('pn_commandname');
    }
}
