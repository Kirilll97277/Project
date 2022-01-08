<?php

namespace App\Form;

use App\Entity\Collection;
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
            ->add('image', FileType::class, array(
                'label' => 'Main image',
                'required' => false,
                'mapped' => false,
            ))
            ->add('title', TextType::class, array(
                'label' => 'Сollection name',
                'attr' => [
                    'placeholder' => 'Enter the title'
                ]
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Сollection description',
                'attr' => [
                    'placeholder' => 'Enter a description'
                ]
            ))
            ->add('Theme')
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
