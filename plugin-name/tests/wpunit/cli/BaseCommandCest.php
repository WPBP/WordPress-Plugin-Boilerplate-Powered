<?php

class BaseCommandCest {
    public function _before(\Step\Cli\CodeceptionCommand $I) {
        $I->deleteSandbox();
        $I->createSandbox();
        $I->amInSandbox();
    }
    public function _after(\Step\Cli\CodeceptionCommand $I) {
        $I->deleteSandbox();
    }
}
