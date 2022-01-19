<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Mocker;

use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Mercanet;
use Arcange\SyliusMercanetBnpParibasPlugin\Bridge\MercanetBnpParibasBridgeInterface;
use Sylius\Behat\Service\Mocker\Mocker;

final class MercanetBnpParibasMocker
{
    /**
     * @var Mocker
     */
    private $mocker;

    /**
     * @param Mocker $mocker
     */
    public function __construct(Mocker $mocker)
    {
        $this->mocker = $mocker;
    }

    /**
     * @param callable $action
     */
    public function completedPayment(callable $action)
    {
        $openMercanetBnpParibasWrapper = $this->mocker
            ->mockService('arcange.mercanet_bnp_paribas.bridge.mercanet_bnp_paribas_bridge', MercanetBnpParibasBridgeInterface::class);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('createMercanet')
            ->andReturn(new Mercanet('test'));

        $openMercanetBnpParibasWrapper
            ->shouldReceive('paymentVerification')
            ->andReturn(true);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('isPostMethod')
            ->andReturn(true);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('setSecretKey', 'setEnvironment', 'setMerchantId', 'setKeyVersion')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getSecretKey')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getMerchantId')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getKeyVersion')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getEnvironment')
            ->andReturn(Mercanet::TEST)
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getAuthorisationId')
            ->andReturn(1)
        ;

        $action();

        $this->mocker->unmockAll();
    }

    /**
     * @param callable $action
     */
    public function canceledPayment(callable $action)
    {
        $openMercanetBnpParibasWrapper = $this->mocker
            ->mockService('arcange.mercanet_bnp_paribas.bridge.mercanet_bnp_paribas_bridge', MercanetBnpParibasBridgeInterface::class);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('createMercanet')
            ->andReturn(new Mercanet('test'));

        $openMercanetBnpParibasWrapper
            ->shouldReceive('paymentVerification')
            ->andReturn(false);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('isPostMethod')
            ->andReturn(true);

        $openMercanetBnpParibasWrapper
            ->shouldReceive('setSecretKey', 'setEnvironment', 'setMerchantId', 'setKeyVersion')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getSecretKey')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getMerchantId')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getKeyVersion')
            ->andReturn('test')
        ;

        $openMercanetBnpParibasWrapper
            ->shouldReceive('getEnvironment')
            ->andReturn(Mercanet::TEST)
        ;

        $action();

        $this->mocker->unmockAll();
    }
}
