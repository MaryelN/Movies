<?php

namespace App\Form;


use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rate', ChoiceType::class, [
                'choices' => [
                    '1 star' => 1,
                    '2 stars' => 2,
                    '3 stars' => 3,
                    '4 stars' => 4,
                    '5 stars' => 5,
                ],
                'attr' => [
                    'class'=> 'rate'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Note',
            ])
            ->add('review', TextType::class, [
                'label' => 'Commentaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
