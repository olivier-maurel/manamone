<?php

namespace App\Form\App;

use App\Entity\App\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', null, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
