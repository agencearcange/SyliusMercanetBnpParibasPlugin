<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Bridge;

use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Mercanet;
use Symfony\Component\HttpFoundation\RequestStack;

final class MercanetBnpParibasBridge implements MercanetBnpParibasBridgeInterface
{
    private RequestStack $requestStack;

    private string $secretKey;

    private string $merchantId;

    private string $keyVersion;

    private string $environment;

    private ?Mercanet $mercanet;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->secretKey = '';
        $this->merchantId = '';
        $this->keyVersion = '';
        $this->environment = '';
        $this->mercanet = null;
    }

    public function createMercanet(string $secretKey): Mercanet
    {
        return new Mercanet($secretKey);
    }

    public function paymentVerification(): bool
    {
        if ($this->isPostMethod()) {
            $this->mercanet = new Mercanet($this->secretKey);
            $this->mercanet->fromResponse($_POST);

            return $this->mercanet->isValid() && $this->mercanet->isSuccessful();
        }

        return false;
    }

    public function getAuthorisationId(): string
    {
        if ($this->mercanet !== null) {
            return $this->mercanet->getParameter('authorisationId');
        }

        return '';
    }

    public function isPostMethod(): bool
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        if ($currentRequest !== null) {
            return $currentRequest->isMethod('POST');
        }

        return false;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function setSecretKey(string $secretKey): void
    {
        $this->secretKey = $secretKey;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    public function getKeyVersion(): string
    {
        return $this->keyVersion;
    }

    public function setKeyVersion(string $keyVersion): void
    {
        $this->keyVersion = $keyVersion;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function setEnvironment(string $environment): void
    {
        $this->environment = $environment;
    }
}
