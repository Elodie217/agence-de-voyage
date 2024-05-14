<?php

namespace App\Form;

use App\Entity\AdvCategorie;
use App\Entity\AdvPays;
use App\Entity\AdvVoyage;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvVoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination_voyage', TextType::class, [
                'label' => 'Voyage',
                'attr' => ['class' => "w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md", 'placeholder' => "Découverte de l'Amazonie"]
            ])
            ->add('duree_voyage', IntegerType::class, [
                'label' => 'Durée du voyage',
                'attr' => ['class' => "w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"]
            ])
            ->add('image_voyage', TextType::class, [
                'label' => 'Url de l\'image format paysage',
                'attr' => ['class' => "w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"]
            ])
            ->add('imagebis_voyage', TextType::class, [
                'label' => 'Url de l\'image format portrait',
                'attr' => ['class' => "w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"]
            ])
            ->add('description_voyage', TextareaType::class, [
                'label' => 'Description du voyage',
                'attr' => ['class' => "w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md"]

            ])
            ->add('categorie', EntityType::class, [
                'label' => 'Catégories',
                'class' => AdvCategorie::class,
                'choice_label' => 'nom_categorie',
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => "w-full py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md grid grid-cols-2 gap-2",
                ]
            ])
            ->add('pays', EntityType::class, [
                'class' => AdvPays::class,
                'choice_label' => 'nom_pays',
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => "w-full py-3 px-6 text-base font-medium text-black outline-none focus:border-[#FF9029] focus:shadow-md grid grid-cols-2 gap-2",
                ]

            ]);
        // ->add('user', EntityType::class, [
        //     'class' => User::class,
        //     'choice_label' => 'id',
        // ]);
        // ->add('Enregistrer', SubmitType::class, [
        //     'attr' => ['class' => "block text-white py-1.5 px-4 mr-2 h-fit rounded transition duration-200 bg-[#FF9029] hover:bg-[#FF7B00] text-lg"]
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdvVoyage::class,
        ]);
    }
}
