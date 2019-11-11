<?php

namespace App\Form;

use App\Entity\Training;
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

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Intitulé',
                'constraints' => [
                    new NotBlank(['message' => 'Le nom doit être renseigné.']),
                ]
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'Description',
                'constraints' => [
                    new NotBlank(['message' => 'Le champ description doit être rempli.']),
                    new Length(['min' => 100, 'minMessage' => 'La description doit contenir au minimum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('category', ChoiceType::class, [
                'required' => false,
                'label' => 'Catégorie',
                'choices' => [
                    'Prendre de la masse' => 'prise masse',
                    'Perdre du poids' => 'perdre poids',
                    'Garder la ligne' => 'garder la ligne'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Il faut choisir une catégorie'])
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

            ->add('addDate', DateType::class, [
                'required' => false,
                'format' => 'd-M-y',
                'label' => 'Date d\'ajout',
                'constraints' => [
                    new NotBlank(['message' => 'Entrez une date'])
                ]
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
