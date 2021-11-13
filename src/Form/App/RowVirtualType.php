<?php

namespace App\Form\App;

use App\Entity\App\RowVirtual;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RowVirtualType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de la ligne',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('value', IntegerType::class, [
                'label' => 'Valeur de la ligne',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('debit', CheckboxType::class, [
                'required' => false,
                'label' => 'Virement automatique',
                'attr' => [
                    'class' => 'form-check'
                ]
            ])
            ->add('frequency', null, [
                'label' => 'Fréquence de la valeur',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RowVirtual::class,
        ]);
    }
}
