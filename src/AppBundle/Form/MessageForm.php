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
         $builder->add('fromname', TextType::class);
         $builder->add('fromemail', TextType::class);
         $builder->add('toname', TextType::class);
         $builder->add('toemail', TextType::class);
         $builder->add('subject', TextType::class);
         $builder->add('body', TextareaType::class);
         $builder->get('toname')->setDisabled(true);
         $builder->get('toemail')->setDisabled(true);
         $builder->get('fromname')->setDisabled(true);
         $builder->get('fromemail')->setDisabled(true);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Message::class,
        ));
    }
}
