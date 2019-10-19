<?php

// src/Forms/LocationForm.php
namespace AppBundle\Form;

use AppBundle\Entity\location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LocationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder ->add('name', TextType::class,array('label' => 'location.name'));
        $builder ->add('region', IntegerType::class);
        $builder ->add('latitude', NumberType::class);
        $builder ->add('longitude', NumberType::class);
        $builder ->add('kml', TextType::class);
        $builder ->add('zoom', IntegerType::class);
        $builder->get('zoom')->setRequired(false);
        $builder->get('kml')->setRequired(false);
        $builder->add('showchildren', CheckboxType::class, array(
    'label'    => 'Show the children?',
    'required' => false,));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Location::class,
        ));
    }
}
