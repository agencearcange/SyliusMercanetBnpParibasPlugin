<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Sylius\Component\Core\Test\Services\DefaultChannelFactory;

final class ChannelContext implements Context
{
    /**
     * @var DefaultChannelFactory
     */
    private $defaultChannelFactory;

    /**
     * @param DefaultChannelFactory $defaultChannelFactory
     */
    public function __construct(DefaultChannelFactory $defaultChannelFactory)
    {
        $this->defaultChannelFactory = $defaultChannelFactory;
    }

    /**
     * @Given adding a new channel in :arg1
     */
    public function addingANewChannelIn()
    {
        $this->defaultChannelFactory->create('FR', 'France', 'EUR');
    }
}
