<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'rounded-xl'
                ],
                'label' => 'Adresse e-mail:',
                'required' => false,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'class' => 'rounded-xl'
                    ]
                ],
                'invalid_message' => 'les mots de passe de correspondent pas',
                'required' => false,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Vérification du mot de passe'],
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'rounded-xl'
                ],
                'label' => 'Nom:',
                'required' => false,
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'rounded-xl'
                ],
                'label' => 'Prenom:',
                'required' => false,
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'propriétaire' => 'Prorietaire',
                    'utilisateur' => 'Utilisateur',
                ],
                'label' => 'Choisissez votre rôle: ',
                'expanded' => true,
                'attr' => [
                    'class' => 'rounded-xl'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'p-2 rounded-xl bg-grey'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
