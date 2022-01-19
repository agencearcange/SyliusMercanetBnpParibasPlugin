<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Payum;

use Arcange\SyliusMercanetBnpParibasPlugin\Payum\MercanetBnpParibasGatewayFactory;
use Payum\Core\GatewayFactory;
use PhpSpec\ObjectBehavior;

final class MercanetBnpParibasGatewayFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MercanetBnpParibasGatewayFactory::class);
        $this->shouldHaveType(GatewayFactory::class);
    }

    function it_populateConfig_run()
    {
        $this->createConfig([]);
    }
}
