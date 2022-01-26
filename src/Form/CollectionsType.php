<?php

namespace App\Form;

use App\Entity\Collection;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Collections name',
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
            ->add('image', FileType::class, array(
                'label' => 'Main image',
                'required' => false,
                'mapped' => false,
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Collections description',
                'attr' => [
                    'placeholder' => 'Select a theme'
                ]
            ))
            ->add('attributes', CollectionType::class, [
                'entry_type' => CollectionAttributeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
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
