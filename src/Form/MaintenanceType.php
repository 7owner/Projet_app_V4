<?php

namespace App\Form;

use App\Entity\Maintenance;
use App\Entity\Doe;
use App\Entity\Affaire;
use App\Entity\Agent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MaintenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('doe', EntityType::class, [
                'class' => Doe::class,
                'choice_label' => 'titre', // Assuming Doe has a 'titre' property
                'placeholder' => 'Sélectionner un DOE',
                'label' => 'DOE associé',
                'required' => true,
            ])
            ->add('affaire', EntityType::class, [
                'class' => Affaire::class,
                'choice_label' => 'nomAffaire', // Assuming Affaire has a 'nomAffaire' property
                'placeholder' => 'Sélectionner une affaire',
                'label' => 'Affaire associée',
                'required' => true,
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre de la maintenance',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la maintenance',
                'required' => true,
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Pas commencé' => 'Pas_commence',
                    'En cours' => 'En_cours',
                    'Terminé' => 'Termine',
                    'Bloqué' => 'Bloque', // New state
                ],
                'label' => 'État de la maintenance',
                'required' => true,
            ])
            ->add('motifBlocage', TextareaType::class, [
                'label' => 'Motif du blocage',
                'required' => false, // Will be conditionally required or displayed by JavaScript
            ])
            ->add('responsable', EntityType::class, [
                'class' => Agent::class,
                'choice_label' => 'nom', // Assuming Agent has a 'nom' property
                'placeholder' => 'Sélectionner un responsable',
                'label' => 'Responsable',
                'required' => false,
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'required' => true,
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maintenance::class,
        ]);
    }
}
