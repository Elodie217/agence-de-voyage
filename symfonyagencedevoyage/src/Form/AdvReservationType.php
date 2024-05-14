<?php

namespace App\Form;

use App\Entity\AdvReservation;
use App\Entity\AdvStatut;
use App\Entity\AdvVoyage;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //             ->add('message_reservation')
            //             ->add('advVoyage', EntityType::class, [
            //                 'class' => AdvVoyage::class,
            // 'choice_label' => 'id',
            //             ])
            //             ->add('user', EntityType::class, [
            //                 'class' => User::class,
            // 'choice_label' => 'id',
            //             ])
            ->add('statut', EntityType::class, [
                'class' => AdvStatut::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdvReservation::class,
        ]);
    }
}
