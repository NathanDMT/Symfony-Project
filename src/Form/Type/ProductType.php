<?php

namespace App\Form\Type;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom',
                'required'=>true,
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description',
                'required'=>false,
            ])
            ->add('quantityInStock', IntegerType::class, [
                'label'=>'Quantité en stock',
                'required'=>true,
            ])
            ->add('price', TextType::class, [
                'label'=>'Prix',
                'required'=>true,

            ])
            //->add('enregister', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Product::class
            ]
        );
    }
}