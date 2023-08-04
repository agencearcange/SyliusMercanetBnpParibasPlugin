<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Mercanet;

use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Concerns\MercanetRequest;
use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Concerns\MercanetResponse;

/**
 * @method string getAuthorisationId()
 * @method void setMerchantId(string $merchantId)
 * @method void setKeyVersion(string $keyVersion)
 */
class Mercanet
{
    public const TEST = "https://payment-webinit-mercanet.test.sips-services.com/rs-services/v2/paymentInit";

    public const PRODUCTION = "https://payment-webinit.mercanet.bnpparibas.net/rs-services/v2/paymentInit";

    public const INTERFACE_VERSION = 'HP_2.20';

    use MercanetRequest;

    use MercanetResponse;

    protected string $secretKey;

    protected string $pspUrl = self::TEST;

    public function __construct($secret)
    {
        $this->secretKey = $secret;
    }

    /** @return string */
    public function getUrl(): string
    {
        return $this->pspUrl;
    }

    public function setUrl($pspUrl): void
    {
        if (!Helper::isValidatedUri($pspUrl)) {
            throw new \InvalidArgumentException('Uri is not valid');
        }

        $this->pspUrl = $pspUrl;
    }
}
