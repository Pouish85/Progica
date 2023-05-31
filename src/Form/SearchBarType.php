<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\EquipementInterieur;
use App\Entity\EquipementExterieur;
use App\Entity\Service;
use App\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbChambres', ChoiceType::class, [
                'label' => 'Nombre de chambres:',
                'label_attr' => [
                    'class' => 'flex flex-row justify-start '
                ],
                'attr' => [
                    'class' => 'flex flex-col align-middle justify-center text-center items-center'
                ],
                'required' => false,
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ]
            ])
            ->add('acceptAnimaux', CheckboxType::class, [
                'label' => 'Accepte les animaux',
                'label_attr' => [
                    'class' => 'flex flex-row justify-start rounded'
                ],
                'required' => false
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'label' => 'Ville:',
                'choice_label' => 'nom',
                'multiple' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'label_attr' => [
                    'class' => 'flex flex-row justify-start'
                ],
                'placeholder' => '',
                'required' => false
            ])
            ->add('equipementInterieur', EntityType::class, [
                'class' => EquipementInterieur::class,
                'label' => 'Équipement intérieur:',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'label_attr' => [
                    'class' => 'flex flex-row justify-start'
                ],
                'required' => false,

            ])
            ->add('equipementExterieur', EntityType::class, [
                'class' => EquipementExterieur::class,
                'label' => 'Équipement extérieur:',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'label_attr' => [
                    'class' => 'flex flex-row justify-start'
                ],
                'required' => false
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'label' => 'Service:',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'label_attr' => [
                    'class' => 'flex flex-row justify-start'
                ],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
        ]);
    }
}
