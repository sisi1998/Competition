<?php

namespace App\Form;

use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Equipe;
use App\Entity\Arena;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date')
            ->add('etat')
            ->add('Nom')
            
            ->add('arena', EntityType::class, [
                'class' => Arena::class,
                'placeholder' => 'arena',
                'choice_label'=>'Nom',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('equipes', EntityType::class, [
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
