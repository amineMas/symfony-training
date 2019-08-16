<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image', FileType::class, [
                'data_class' => null,
            ])
            ->add('addDate', DateType::class, [
                'format' => 'ddMMyyyy'
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Nutrition' => 'nutrition',
                    'Entraînement' => 'entrainement',
                    'Idées reçues' => 'stereotype'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ajouter l'article"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
