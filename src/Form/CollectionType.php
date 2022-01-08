<?php

namespace App\Form;

use App\Entity\Collection;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Collection name',
                'attr' => [
                    'placeholder' => 'Enter the title'
                ]
            ))
            ->add('theme', EntityType::class, array(
                'label'=> 'Theme name',
                'class'=> Theme::class,
                'choice_label' => 'name',
                'attr' =>[
                    'placeholder'
                ]
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Collection description',
                'attr' => [
                    'placeholder' => 'Select a theme'
                ]
            ))
            ->add('image', FileType::class, array(
                'label' => 'Main image',
                'required' => false,
                'mapped' => false,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collection::class,
        ]);
    }
}
