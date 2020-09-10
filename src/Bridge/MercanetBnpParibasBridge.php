<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Bridge;

use Arcange\SyliusMercanetBnpParibasPlugin\Legacy\Mercanet;
use Symfony\Component\HttpFoundation\RequestStack;

final class MercanetBnpParibasBridge implements MercanetBnpParibasBridgeInterface
{
    /** @var RequestStack */
    private $requestStack;

    /** @var string */
    private $secretKey;

    /** @var string */
    private $merchantId;

    /** @var string */
    private $keyVersion;

    /** @var string */
    private $environment;

    /** @var Mercanet */
    private $mercanet;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function createMercanet($secretKey)
    {
        return new Mercanet($secretKey);
    }

    /**
     * {@inheritdoc}
     */
    public function paymentVerification()
    {
        if ($this->isPostMethod()) {
            $this->mercanet = new Mercanet($this->secretKey);
            $this->mercanet->setResponse($_POST);

            return $this->mercanet->isValid();
        }

        return false;
    }

    public function getAuthorisationId()
    {
        return $this->mercanet->getAuthorisationId();
    }

    /**
     * {@inheritdoc}
     */
    public function isPostMethod()
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        return $currentRequest->isMethod('POST');
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return string
     */
    public function getKeyVersion()
    {
        return $this->keyVersion;
    }

    /**
     * @param string $keyVersion
     */
    public function setKeyVersion($keyVersion)
    {
        $this->keyVersion = $keyVersion;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }
}
