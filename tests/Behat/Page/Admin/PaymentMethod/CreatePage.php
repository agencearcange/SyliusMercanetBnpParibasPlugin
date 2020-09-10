<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Page\Admin\PaymentMethod;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;

class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function setSyliusMercanetBnpParibasPluginGatewaySecretKey($secretKey)
    {
        $this->getDocument()->fillField('Secure key', $secretKey);
    }

    /**
     * {@inheritdoc}
     */
    public function setSyliusMercanetBnpParibasPluginGatewayMerchantId($merchantId)
    {
        $this->getDocument()->fillField('Merchant ID', $merchantId);
    }

    /**
     * {@inheritdoc}
     */
    public function setSyliusMercanetBnpParibasPluginGatewayKeyVersion($keyVersion)
    {
        $this->getDocument()->fillField('Key version', $keyVersion);
    }

    /**
     * {@inheritdoc}
     */
    public function setSyliusMercanetBnpParibasPluginGatewayEnvironment($environment)
    {
        $this->getDocument()->selectFieldOption('Environment', $environment);
    }

    /**
     * {@inheritdoc}
     */
    public function findValidationMessage($message)
    {
        $elements = $this->getDocument()->findAll('css', '.sylius-validation-error');

        /** @var NodeElement $element */
        foreach ($elements as $element) {
            if ($element->getText() === $message) {
                return true;
            }
        }

        return false;
    }
}
