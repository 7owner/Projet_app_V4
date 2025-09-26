<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Maintenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maintenance', EntityType::class, [
                'class' => Maintenance::class,
                'choice_label' => 'id', // Assuming Maintenance has an 'id' property for identification
                'placeholder' => 'Sélectionner une maintenance',
                'label' => 'Maintenance associée',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'intervention',
                'required' => true,
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'required' => true,
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin (optionnel)',
                'required' => false,
            ])
            ->add('interventionPrecedente', EntityType::class, [
                'class' => Intervention::class,
                'choice_label' => 'id', // Assuming Intervention has an 'id' property for identification
                'placeholder' => 'Sélectionner une intervention précédente (optionnel)',
                'label' => 'Intervention précédente',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
