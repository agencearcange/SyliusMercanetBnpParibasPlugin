<?php

namespace Tests\Arcange\SyliusMercanetBnpParibasPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Arcange\SyliusMercanetBnpParibasPlugin\Mercanet\Mercanet;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Core\Repository\PaymentMethodRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Doctrine\Persistence\ObjectManager;

final class MercanetBnpParibasContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var PaymentMethodRepositoryInterface
     */
    private $paymentMethodRepository;

    /**
     * @var ExampleFactoryInterface
     */
    private $paymentMethodExampleFactory;

    /**
     * @var FactoryInterface
     */
    private $paymentMethodTranslationFactory;

    /**
     * @var ObjectManager
     */
    private $paymentMethodManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param PaymentMethodRepositoryInterface $paymentMethodRepository
     * @param ExampleFactoryInterface $paymentMethodExampleFactory
     * @param FactoryInterface $paymentMethodTranslationFactory
     * @param ObjectManager $paymentMethodManager
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ExampleFactoryInterface $paymentMethodExampleFactory,
        FactoryInterface $paymentMethodTranslationFactory,
        ObjectManager $paymentMethodManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentMethodExampleFactory = $paymentMethodExampleFactory;
        $this->paymentMethodTranslationFactory = $paymentMethodTranslationFactory;
        $this->paymentMethodManager = $paymentMethodManager;
    }

    /**
     * @Given the store has a payment method :paymentMethodName with a code :paymentMethodCode and Mercanet Bnp Paribas Checkout gateway
     */
    public function theStoreHasAPaymentMethodWithACodeAndMercanetBnpParibasCheckoutGateway(
        $paymentMethodName,
        $paymentMethodCode
    ) {
        $paymentMethod = $this->createPaymentMethod($paymentMethodName, $paymentMethodCode, 'Mercanet Bnp Paribas');
        $paymentMethod->getGatewayConfig()->setConfig([
            'environment' => Mercanet::TEST,
            'merchant_id' => 'TEST',
            'key_version' => 'TEST',
            'secret_key' => 'TEST',
            'payum.http_client' => '@arcange.mercanet_bnp_paribas.bridge.mercanet_bnp_paribas_bridge',
        ]);

        $this->paymentMethodManager->flush();
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $description
     * @param bool $addForCurrentChannel
     * @param int|null $position
     *
     * @return PaymentMethodInterface
     */
    private function createPaymentMethod(
        $name,
        $code,
        $description = '',
        $addForCurrentChannel = true,
        $position = null
    ) {

        /** @var PaymentMethodInterface $paymentMethod */
        $paymentMethod = $this->paymentMethodExampleFactory->create([
            'name' => ucfirst($name),
            'code' => $code,
            'description' => $description,
            'gatewayName' => 'mercanet_bnp_paribas',
            'gatewayFactory' => 'mercanet_bnp_paribas',
            'enabled' => true,
            'channels' => ($addForCurrentChannel && $this->sharedStorage->has('channel')) ? [$this->sharedStorage->get('channel')] : [],
        ]);

        if (null !== $position) {
            $paymentMethod->setPosition($position);
        }

        $this->sharedStorage->set('payment_method', $paymentMethod);
        $this->paymentMethodRepository->add($paymentMethod);

        return $paymentMethod;
    }
}
