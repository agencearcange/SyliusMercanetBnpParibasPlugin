<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Payum\Action;

use Arcange\SyliusMercanetBnpParibasPlugin\Bridge\MercanetBnpParibasBridgeInterface;
use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Mercanet;
use Arcange\SyliusMercanetBnpParibasPlugin\Payum\Action\CaptureAction;
use Payum\Core\Model\Token;
use Payum\Core\Payum;
use Payum\Core\Reply\HttpResponse;
use Payum\Core\Request\Capture;
use Payum\Core\Security\GenericTokenFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Order\Model\Order;

final class CaptureActionSpec extends ObjectBehavior
{
    function let(Payum $payum, MercanetBnpParibasBridgeInterface $mercanetBnpParibasBridge)
    {
        $this->beConstructedWith($payum, $mercanetBnpParibasBridge);
        $this->setApi($mercanetBnpParibasBridge);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CaptureAction::class);
    }

    function it_executes(
        Capture $request,
        \ArrayObject $arrayObject,
        PaymentInterface $payment,
        Token $token,
        Token $notifyToken,
        Payum $payum,
        GenericTokenFactory $genericTokenFactory,
        Order $order,
        MercanetBnpParibasBridgeInterface $mercanetBnpParibasBridge,
        Mercanet $mercanet
    )
    {
        $mercanetBnpParibasBridge->getSecretKey()->willReturn('123');
        $mercanetBnpParibasBridge->getEnvironment()->willReturn(Mercanet::TEST);
        $mercanetBnpParibasBridge->getMerchantId()->willReturn('123');
        $mercanetBnpParibasBridge->getKeyVersion()->willReturn('3');
        $mercanetBnpParibasBridge->createMercanet('123')->willReturn($mercanet);
        $payment->getOrder()->willReturn($order);
        $payment->getCurrencyCode()->willReturn('EUR');
        $payment->getAmount()->willReturn(100);
        $notifyToken->getTargetUrl()->willReturn('url');
        $token->getTargetUrl()->willReturn('url');
        $token->getGatewayName()->willReturn('test');
        $token->getDetails()->willReturn([]);
        $genericTokenFactory->createNotifyToken('test', [])->willReturn($notifyToken);
        $payum->getTokenFactory()->willReturn($genericTokenFactory);
        $request->getModel()->willReturn($arrayObject);
        $request->getFirstModel()->willReturn($payment);
        $request->getToken()->willReturn($token);
        $request->setModel(Argument::any())->shouldBeCalled();

        $this
            ->shouldThrow(HttpResponse::class)
            ->during('execute', [$request])
        ;
    }
}
