<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
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
                'required' => false,
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank(['message' => 'Le champ titre doit être rempli.']),
                    new Length(['min' => 5, 'minMessage' => 'Le titre doit contenir au minimum {{ limit }} caractères.',
                                'max' => 20, 'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'Description',
                'constraints' => [
                    new NotBlank(['message' => 'Le champ description doit être rempli.']),
                    new Length(['min' => 20, 'minMessage' => 'Le titre doit contenir au minimum {{ limit }} caractères.',
                                'max' => 500, 'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'required' => false,
                'label' => 'Ajout d\'une image',
                'constraints' => [
                    new NotBlank(['message' => 'Il faut ajouter une image']),
                    new File([
                        'maxSize' => '2M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux : {{size}} {{suffix}}.Taille maximum autorisée 2Mo',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/bmp',
                        ],
                        'mimeTypesMessage' => 'Le type de fichier est invalide ({{ type }}). Mime type autorisés {{ types }}',
                    ])
                ]
            ])
            ->add('addDate', BirthdayType::class, [
                'required' => false,
                'format' => 'd-M-y',
                'label' => 'Date d\'ajout',
                'constraints' => [
                    new NotBlank(['message' => 'Entrez une date'])
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'required' => false,
                'label' => 'Catégorie',
                'choices' => [
                    'Nutrition' => 'nutrition',
                    'Entraînement' => 'entrainement',
                    'Idées reçues' => 'stereotype'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Il faut choisir une catégorie'])
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
