<?php

namespace App\Form;

use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Arena;
use App\Entity\Equipe;


class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Date')
            ->add('etat')
            ->add('Arena', EntityType::class, [
                'class' => Arena::class,
                'placeholder' => 'arena',
                'choice_label'=>'Nom',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('Equipe', EntityType::class, [
                'class' => Equipe::class,
                'placeholder' => 'Equipes',
                'choice_label'=>'Nom',
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
