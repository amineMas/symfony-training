<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Prendre de la masse' => 'prise masse',
                    'Perdre du poids' => 'perdre poids',
                    'Garder la ligne' => 'garder la ligne'
                ]
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
            ])

            ->add('addDate', DateType::class, [
                'format' => 'ddMMyyyy'
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Ajouter ce programme d'entraînement"
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
