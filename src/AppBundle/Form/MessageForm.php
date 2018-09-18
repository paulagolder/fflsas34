<?php

// src/Forms/MessageForm.php
namespace AppBundle\Form;

use  AppBundle\Entity\message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MessageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('name', TextType::class);
         $builder->add('email', TextType::class);
         $builder->add('subject', TextType::class);
         $builder->add('message', TextareaType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Message::class,
        ));
    }
}
