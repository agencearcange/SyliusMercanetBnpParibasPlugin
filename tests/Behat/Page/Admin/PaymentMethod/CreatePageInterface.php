<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Page\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;

interface CreatePageInterface extends BaseCreatePageInterface
{
    /**
     * @param string $secretKey
     */
    public function setSyliusMercanetBnpParibasPluginGatewaySecretKey($secretKey);

    /**
     * @param string $merchantId
     */
    public function setSyliusMercanetBnpParibasPluginGatewayMerchantId($merchantId);

    /**
     * @param string $keyVersion
     */
    public function setSyliusMercanetBnpParibasPluginGatewayKeyVersion($keyVersion);

    /**
     * @param string $environment
     */
    public function setSyliusMercanetBnpParibasPluginGatewayEnvironment($environment);

    /**
     * @param string $message
     *
     * @return bool
     */
    public function findValidationMessage($message);
}
