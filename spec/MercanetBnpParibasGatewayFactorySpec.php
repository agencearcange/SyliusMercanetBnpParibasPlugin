<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin;

use Arcange\SyliusMercanetBnpParibasPlugin\MercanetBnpParibasGatewayFactory;
use PhpSpec\ObjectBehavior;
use Payum\Core\GatewayFactory;

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
