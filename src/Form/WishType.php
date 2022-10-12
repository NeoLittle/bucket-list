<?php

namespace App\Form;

use App\Entity\Wish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title'
            ])
            ->add('description', TextareaType::class, [
                'required'=>false
            ])
            ->add('author')
            ->add('isPublished', ChoiceType::class, [
                'choices'=>[
                    'True'=>'True',
                    'False'=>'False'
                ],
                'multiple'=>false
            ])
            ->add('dateCreated', DateType::class,[
                'html5'=>true,
                'widget'=>'single_text'
            ])
            ->add('category', ChoiceType::class, [
                    'choices'=>[
                        'Travel & Adventure'=>'Travel & Adventure',
                        'Sport'=>'Sport',
                        'Entertainment'=>'Entertainment',
                        'Human Relations'=>'Human Relations',
                        'Others'=>'Others',
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
