<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ {{ value }} doit être rempli.']),
                    new Length(['min' => 5, 'minMessage' => 'Le titre doit contenir au minimum {{ limit }} caractères.',
                                'max' => 20, 'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('description', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ {{ value }} doit être rempli.']),
                    new Length(['min' => 20, 'minMessage' => 'Le titre doit contenir au minimum {{ limit }} caractères.',
                                'max' => 500, 'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
            ])
            ->add('addDate', BirthdayType::class, [
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
