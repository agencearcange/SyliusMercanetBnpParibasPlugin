<?php

namespace spec\Arcange\SyliusMercanetBnpParibasPlugin\Bridge;

use Arcange\SyliusMercanetBnpParibasPlugin\Bridge\MercanetBnpParibasBridge;
use Arcange\SyliusMercanetBnpParibasPlugin\Bridge\MercanetBnpParibasBridgeInterface;
use Arcange\SyliusMercanetBnpParibasPlugin\Legacy\Mercanet;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class MercanetBnpParibasBridgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MercanetBnpParibasBridge::class);
        $this->shouldHaveType(MercanetBnpParibasBridgeInterface::class);
    }

    function let(RequestStack $requestStack)
    {
        $this->beConstructedWith($requestStack);
    }

    function it_is_post_method(
        RequestStack $requestStack,
        Request $request
    )
    {
        $request->isMethod('POST')->willReturn(true);
        $requestStack->getCurrentRequest()->willReturn($request);

        $this->isPostMethod()->shouldReturn(true);
    }

    function it_is_not_post_method(
        RequestStack $requestStack,
        Request $request
    )
    {
        $request->isMethod('POST')->willReturn(false);
        $requestStack->getCurrentRequest()->willReturn($request);

        $this->isPostMethod()->shouldReturn(false);
    }

    function it_creates_mercanet()
    {
        $this->createMercanet('key')->shouldBeAnInstanceOf(Mercanet::class);
    }

    function it_payment_verification_has_been_thrown(
        RequestStack $requestStack,
        Request $request
    )
    {
        $request->isMethod('POST')->willReturn(true);
        $requestStack->getCurrentRequest()->willReturn($request);

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('paymentVerification', ['key'])
        ;
    }
}
