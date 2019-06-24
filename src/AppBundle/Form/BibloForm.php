<?php

// src/Forms/LinkrefFormType.php
namespace AppBundle\Form;


use  AppBundle\Entity\Biblo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class BibloForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
            
       
        $builder->add('bookid', TextType::class);
        $builder->add('title', null, array(
           'label' => 'title', 
           'attr' => array('style' => 'width: 400px')));
        $builder->add('subtitle', TextType::class,[
          'empty_data' => '',
          'required' => false,
          'attr' => array('style' => 'width: 400px')
           ]);
        $builder->add('author', TextType::class);
        $builder->add('publisher', TextType::class);
        $builder->add('year', TextType::class);
        $builder->add('isbn', TextType::class,[
          'empty_data' => '',
          'required' => false,
           ]);
        $builder->add('tags', TextType::class,[
         'empty_data' => '',
          'required' => false,
           ]);


       $builder->get('publisher')->setRequired(false);
       $builder->get('bookid')->setDisabled(true);
     

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Biblo::class,
        ));
    }
}
