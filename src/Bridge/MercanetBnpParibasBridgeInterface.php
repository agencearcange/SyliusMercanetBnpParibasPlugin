<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Bridge;

use Arcange\SyliusMercanetBnpParibasPlugin\Legacy\Mercanet;

interface MercanetBnpParibasBridgeInterface
{
    /**
     * @param string $secretKey
     *
     * @return Mercanet
     */
    public function createMercanet($secretKey);

    /**
     * @return bool
     */
    public function paymentVerification();

    public function getAuthorisationId();

    /**
     * @return bool
     */
    public function isPostMethod();

    /**
     * @return string
     */
    public function getSecretKey();

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey);

    /**
     * @return string
     */
    public function getMerchantId();

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId);

    /**
     * @return string
     */
    public function getKeyVersion();

    /**
     * @param string $keyVersion
     */
    public function setKeyVersion($keyVersion);

    /**
     * @return string
     */
    public function getEnvironment();

    /**
     * @param string $environment
     */
    public function setEnvironment($environment);
}
