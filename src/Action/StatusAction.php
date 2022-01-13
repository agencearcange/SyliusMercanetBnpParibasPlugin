<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\GetStatusInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class StatusAction implements ActionInterface
{
    /** @var RequestStack */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     *
     * @param GetStatusInterface $request
     */
    public function execute($request)
    {
        RequestNotSupportedException::assertSupports($this, $request);

        $model = ArrayObject::ensureArrayObject($request->getModel());

        $requestCurrent = $this->requestStack->getCurrentRequest();

        $transactionReference = $model['transactionReference'] ?? null;

        $status = $model['status'] ?? null;

        if ((null === $transactionReference) && !$requestCurrent->isMethod('POST')) {
            $request->markNew();

            return;
        }

        if ($status === PaymentInterface::STATE_CANCELLED) {
            $request->markCanceled();

            return;
        }
        if ($status === PaymentInterface::STATE_COMPLETED) {
            $request->markCaptured();

            return;
        }

        $request->markUnknown();
    }

    /**
     * @inheritdoc
     */
    public function supports($request)
    {
        return
            $request instanceof GetStatusInterface &&
            $request->getModel() instanceof \ArrayAccess
        ;
    }
}
