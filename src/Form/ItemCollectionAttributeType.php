<?php

namespace App\Form;

use App\Entity\AttributeType;
use App\Entity\ItemCollectionAttribute;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemCollectionAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('attributeTypeId', EntityType::class, array(
                'label'=> 'type',
                'class'=> AttributeType::class,
                'choice_label' => 'name',
                ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemCollectionAttribute::class,
        ]);
    }
}
