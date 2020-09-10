<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Action;

use Arcange\SyliusMercanetBnpParibasPlugin\Action\ConvertPaymentAction;
use PhpSpec\ObjectBehavior;
use Payum\Core\Request\Convert;
use Payum\Core\Model\PaymentInterface;

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
