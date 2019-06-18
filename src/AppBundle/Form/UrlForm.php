<?php

// src/Forms/LinkrefFormType.php
namespace AppBundle\Form;


use  AppBundle\Entity\Url;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UrlForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
            
       
        $builder->add('id', TextType::class);
        $builder->add('url', TextType::class);
        $builder->add('label', TextType::class);
        $builder->add('tags', TextType::class);

        $builder->get('tags')->setRequired(false);
       
                
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Url::class,
        ));
    }
}
