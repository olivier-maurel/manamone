<?php

namespace App\Form\App;

use App\Entity\App\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('icon', HiddenType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'role' => 'iconpicker'
                ]
            ])
            ->add('color', ColorType::class, [
                'attr' => [
                    'class' => 'form-control form-control-color iconpicker d-block',
                    'style' => 'padding: 0;',
                    'id' => 'colorpicker'
                ]
            ])
            ->add('startDate')
            ->add('endStart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
