<?php

declare(strict_types=1);

namespace Arcange\SyliusMercanetBnpParibasPlugin\Form\Type;

use Arcange\SyliusMercanetBnpParibasPlugin\Legacy\Mercanet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

final class MercanetBnpParibasGatewayConfigurationType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('environment', ChoiceType::class, [
                'choices' => [
                    'arcange.mercanet_bnp_paribas.production' => Mercanet::PRODUCTION,
                    'arcange.mercanet_bnp_paribas.test' => Mercanet::TEST,
                ],
                'label' => 'arcange.mercanet_bnp_paribas.environment',
            ])
            ->add('secret_key', TextType::class, [
                'label' => 'arcange.mercanet_bnp_paribas.secure_key',
                'constraints' => [
                    new NotBlank([
                        'message' => 'arcange.mercanet_bnp_paribas.secure_key.not_blank',
                        'groups' => ['sylius'],
                    ]),
                ],
            ])
            ->add('merchant_id', TextType::class, [
                'label' => 'arcange.mercanet_bnp_paribas.merchant_id',
                'constraints' => [
                    new NotBlank([
                        'message' => 'arcange.mercanet_bnp_paribas.merchant_id.not_blank',
                        'groups' => ['sylius'],
                    ]),
                ],
            ])
            ->add('key_version', TextType::class, [
                'label' => 'arcange.mercanet_bnp_paribas.key_version',
                'constraints' => [
                    new NotBlank([
                        'message' => 'arcange.mercanet_bnp_paribas.key_version.not_blank',
                        'groups' => ['sylius'],
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
                $data = $event->getData();
                $data['payum.http_client'] = '@arcange.mercanet_bnp_paribas.bridge.mercanet_bnp_paribas_bridge';
                $event->setData($data);
            })
        ;
    }
}
