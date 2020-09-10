<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Page\Admin\PaymentMethod\CreatePageInterface;
use Webmozart\Assert\Assert;

final class ManagingPaymentMethodsContext implements Context
{
    /**
     * @var CreatePageInterface
     */
    private $createPage;

    /**
     * @param CreatePageInterface $createPage
     */
    public function __construct(CreatePageInterface $createPage)
    {
        $this->createPage = $createPage;
    }

    /**
     * @Given I want to create a new payment method with Mercanet BNP Paribas gateway factory
     */
    public function iWantToCreateANewPaymentMethodWithMercanetBnpParibasGatewayFactory()
    {
        $this->createPage->open(['factory' => 'mercanet_bnp_paribas']);
    }

    /**
     * @When I configure it with test Mercanet BNP Paribas credentials
     */
    public function iConfigureItWithTestMercanetBnpParibasCredentials()
    {
        $this->createPage->setSyliusMercanetBnpParibasPluginGatewaySecretKey('test');
        $this->createPage->setSyliusMercanetBnpParibasPluginGatewayMerchantId('test');
        $this->createPage->setSyliusMercanetBnpParibasPluginGatewayKeyVersion('test');
        $this->createPage->setSyliusMercanetBnpParibasPluginGatewayEnvironment('Test');
    }

    /**
     * @Then I should be notified that the secure key is invalid
     */
    public function iShouldBeNotifiedThatTheSecureKeyIsInvalid()
    {
        Assert::true($this->createPage->findValidationMessage('Please enter the Security Code.'));
    }

    /**
     * @Then I should be notified that the merchant ID is invalid
     */
    public function iShouldBeNotifiedThatTheMerchantIdIsInvalid()
    {
        Assert::true($this->createPage->findValidationMessage('Please enter the Merchant ID.'));
    }

    /**
     * @Then I should be notified that the Key version is invalid
     */
    public function iShouldBeNotifiedThatTheKeyVersionIsInvalid()
    {
        Assert::true($this->createPage->findValidationMessage('Please enter the Key version.'));
    }
}
