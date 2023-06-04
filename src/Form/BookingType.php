<?php

namespace App\Form;

use App\Entity\Prix;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Locale;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class BookingType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'debut',
                DateType::class,
                [
                    'data' => new \DateTime(), // Définit la date actuelle par défaut
                ]
            )
            ->add(
                'fin',
                DateType::class,
                [
                    'data' => new \DateTime('+1 day'), // Définit la date actuelle par défaut
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
