<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Action;

use Arcange\SyliusMercanetBnpParibasPlugin\Action\NotifyAction;
use Arcange\SyliusMercanetBnpParibasPlugin\Bridge\MercanetBnpParibasBridgeInterface;
use Payum\Core\Request\Notify;
use PhpSpec\ObjectBehavior;
use SM\Factory\FactoryInterface;
use SM\StateMachine\StateMachineInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Payment\PaymentTransitions;

final class NotifyActionSpec extends ObjectBehavior
{
    function let(
        MercanetBnpParibasBridgeInterface $mercanetBnpParibasBridge,
        FactoryInterface $stateMachineFactory
    ) {
        $this->beConstructedWith($stateMachineFactory);
        $this->setApi($mercanetBnpParibasBridge);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotifyAction::class);
    }

    function it_execute(
        Notify $request,
        \ArrayObject $arrayObject,
        MercanetBnpParibasBridgeInterface $mercanetBnpParibasBridge,
        PaymentInterface $payment,
        FactoryInterface $stateMachineFactory,
        StateMachineInterface $stateMachine
    ) {
        $request->getModel()->willReturn($arrayObject);
        $request->getFirstModel()->willReturn($payment);
        $mercanetBnpParibasBridge->isPostMethod()->willReturn(true);
        $mercanetBnpParibasBridge->paymentVerification()->willReturn(true);
        $mercanetBnpParibasBridge->getAuthorisationId()->willReturn('id');
        $payment->getDetails()->willReturn([]);
        $payment->setDetails(["authorisationId" => "id"])->shouldBeCalled();
        $stateMachineFactory->get($payment, PaymentTransitions::GRAPH)->willReturn($stateMachine);

        $stateMachine->apply(PaymentTransitions::TRANSITION_COMPLETE)->shouldBeCalled();

        $this->execute($request);
    }
}
