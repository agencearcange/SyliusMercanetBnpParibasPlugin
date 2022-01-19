<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Payum\Action;

use Arcange\SyliusMercanetBnpParibasPlugin\Payum\Action\ConvertPaymentAction;
use Payum\Core\Model\PaymentInterface;
use Payum\Core\Request\Convert;
use PhpSpec\ObjectBehavior;

final class ConvertPaymentActionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ConvertPaymentAction::class);
    }

    function it_execute(
        Convert $request,
        \ArrayObject $arrayObject,
        PaymentInterface $payment
    )
    {
        $request->setResult([])->willReturn($arrayObject);
        $request->getSource()->willReturn($payment);
        $request->getTo()->willReturn('array');

        $this->execute($request);
    }
}
