<?php

namespace App\Form;

use App\Entity\Item;
use App\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
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
            ->add('attributes', CollectionType::class, [
                'entry_type' => ItemCollectionAttributeType::class,
                'label' => false,
            ])
//            ->add('tags', CollectionType::class, [
//                'entry_type' => TagItemType::class,
//                'entry_options' => ['label' => false],
//                'allow_add' => true,
//                'by_reference' => false,
//            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Save'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
