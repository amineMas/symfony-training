<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => false,
                'label' => 'Pseudo',
                'constraints' => [
                    new NotBlank(['message' => 'Le champ {{ value }} doit être rempli.']),
                    new Length(['min' => 5, 'minMessage' => 'Le pseudo doit contenir au minimum {{ limit }} caractères.',
                                'max' => 20, 'maxMessage' => 'Le pseudo doit contenir au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('password', PasswordType::class, [
                'required' => false,
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank(['message' => 'Il faut entrer un mot de passe.']),
                    new Regex(['pattern' => '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#',
                               'message' => 'Le mot de passe doit contenir entre 8 et 20 caractères avec au minimum un chiffre, une minuscule et une majuscule.'
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom est requis']),
                ]
            ])
            ->add('nom', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis']),
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => 'false',
                'label' => 'E-mail',
                'constraints' => [
                    new NotBlank(['message' => 'L\'email est requis']),
                    new Email(['mode' => 'loose', 'message' => 'L\'email {{ value }} n\'est pas une adresse email valide.']), 
                ]
            ])
            ->add('city', TextType::class, [
                'required' => 'false',
                'label' => 'Ville',
                'constraints' => [
                    new NotBlank(['message' => 'Le champ ville est requis.']),
                ]
            ])
            ->add('zipCode', NumberType::class, [
                'required' => 'false',
                'label' => 'Code postal',
                'constraints' => [
                    new Length(['max' => 5, 'minMessage' => 'Le code postal doit contenir au maximum {{ limit }} caractères.'])
                ]
            ])
            ->add('birthDate', BirthdayType::class, [
                'required' => 'false',
                'format' => 'ddMMyyyy',
                'label' => 'Date de naissance',
                'constraints' => [
                    new NotBlank(['message' => 'Entrez votre date de naissance'])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'enregistrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false // voir avvec yakine
        ]);
    }
}
