<?php

// src/Forms/ImageForm.php

namespace AppBundle\Form;

use  AppBundle\Entity\Image;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
;

class ImageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder ->add('name', TextType::class);
        $builder ->add('path', TextType::class);
        $builder ->add('width', TextType::class);
        $builder ->add('height', TextType::class);
        $builder ->add('orientation', TextType::class);
        $builder ->add('date', TextType::class);
        $builder ->add('format', TextType::class);
       # $builder ->add('doctype', TextType::class);
        $builder ->add('access', TextType::class);
        $builder->add('imagefile', FileType::class, array('label' => 'Image file(jpg)','required'=>false,  'data_class' => null));
       # $builder->get('path')->setDisabled(true);
        $builder->get('path')->setRequired(false);
        $builder->get('height')->setRequired(false);
        $builder->get('width')->setRequired(false);
        $builder->get('orientation')->setRequired(false);
        $builder->get('date')->setRequired(false);
        $builder->get('format')->setRequired(false);
     #   $builder->get('doctype')->setRequired(false);
        $builder->get('access')->setRequired(false);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }
}
