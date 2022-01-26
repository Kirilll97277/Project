<?php

namespace App\Form;

use App\Entity\AttributeType;
use App\Entity\CollectionAttribute;
use App\Entity\ItemAttribute;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ItemCollectionAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, static function (FormEvent $event) {
                $entity = $event->getData();
                if (!$entity instanceof ItemAttribute) {
                    exit;
                }
                $form = $event->getForm();

                /** @var CollectionAttribute $collectionAttribute */
                $collectionAttribute = $entity->getCollectionAttribute();
                switch ($collectionAttribute->getAttributeType()->getName()) {
                    case AttributeType::DATE_TYPE:
                        $form->add('value', DateType::class, [
                            'html5' => true,
                            'data' => new \DateTimeImmutable($event->getData()->getValue()),
                            'label' => $collectionAttribute->getName(),
                            'required' => true,
                            'widget' => 'single_text',
                        ]);
                        break;
                    case AttributeType::INTEGER_TYPE:
                        $form->add('value', IntegerType::class, [
                            'data' => (int) $event->getData()->getValue(),
                            'label' => $collectionAttribute->getName(),
                            'required' => true,
                        ]);
                        break;
                    case AttributeType::BOOLEAN_TYPE:
                        $form->add('value', BooleanType::class, [
                            'data' => (int) $event->getData()->getValue(),
                            'label' => $collectionAttribute->getName(),
                            'required' => true,
                        ]);
                        break;
                    case AttributeType::TEXT_TYPE:
                        $form->add('value', TextType::class, [
                            'label' => $collectionAttribute->getName(),
                            'required' => true,
                            'constraints' => [new Length(['min' => 1, 'max' => 255])],
                        ]);
                        break;
                    default:
                        $form->add('value', TextType::class, [
                            'label' => $collectionAttribute->getName(),
                            'required' => true,
                            'constraints' => [new Length(['min' => 1, 'max' => 255])],
                        ]);
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemAttribute::class,
            'label' => false,
        ]);
    }
}
