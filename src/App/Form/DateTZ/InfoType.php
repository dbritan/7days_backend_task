<?php

namespace App\Form\DateTZ;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
class InfoType extends AbstractType
{
    /**
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Date(), // Y-m-d
                ],
            ])
            ->add('timezone', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Timezone(),
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}