<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Departement;
use App\Entity\EquipementExterieur;
use App\Entity\EquipementInterieur;
use App\Entity\Gite;
use App\Entity\Prix;
use App\Entity\Proprietaire;
use App\Entity\Region;
use App\Entity\Service;
use App\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewGiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomGite', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('surface', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('nbChambres', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('nbLits', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('acceptAnimaux', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('tarifAnimaux', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('image', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 text-sm w-[144px]'
                ],
                'label' => false
            ])
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'choice_label' => 'nom',
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 text-sm w-[144px]'
                ],
                'label' => false
            ])
            // ->add('region', EntityType::class, [
            //     'class' => Region::class,
            //     'choice_label' => 'nom',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'rounded-xl px-2 text-sm w-[144px]'
            //     ],
            //     'label' => false
            // ])
            ->add('nouvelleVilleNom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[144px]'
                ],
                'label' => false
            ])
            ->add('contact', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => 'fullname',
                'attr' => [
                    'class' => 'rounded-xl px-2 text-sm w-[144px]'
                ],
                'label' => false
            ])
            ->add('tarifLocation', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false,
            ])
            ->add('equipementInterieur', EntityType::class, [
                'class' => EquipementInterieur::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('equipementExterieur', EntityType::class, [
                'class' => EquipementExterieur::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px]'
                ],
                'label' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer le gite',
                'attr' => [
                    'class' => 'rounded-xl px-2 w-[00px] bg-white hover:bg-grey duration-200 hover:border-none hover:translate-y-0.5'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewGite::class,
        ]);
    }
}
