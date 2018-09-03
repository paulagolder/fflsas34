<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
#use Symfony\Bundle\SwiftmailerBundle\Swift_SmtpTransport;
#use AppBundle\MyClasses\EMail;

use AppBundle\Entity\Contact;

class ContactController extends Controller
{ 

     private $lang="EN";

    
   public function create(Request $request , \Swift_Mailer $mailer)
    {
        $contact = new Contact;
      
      # Add form fields
        $form = $this->createFormBuilder($contact)
        ->add('name', TextType::class, array('label'=> 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('subject', TextType::class, array('label'=> 'subject','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
        ->add('Save', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
        ->getForm();
        
      # Handle form and recaptcha response
        $form->handleRequest($request);
    
      # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
            $name = $form['name']->getData();
            $fromemail = $form['email']->getData();
            $subject = $form['subject']->getData();
            $messagetext = $form['message']->getData();
             
            
      # set form data   
            $contact->setName($name);
            $contact->setEmail($fromemail);          
            $contact->setSubject($subject);     
            $contact->setMessage($messagetext);           
            
       # finally add data in database
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($contact);
            $sn -> flush();

           $message = (new \Swift_Message('Hello Email'));
           $message->setSubject($subject);
           $message->setFrom('admin@syfflsas3.lerot.org','fflsas-admin');
           $message->setTo($fromemail);
            $message->setBody(
            $this->renderView('contact/emailbody.html.twig',array(
               'name' => $name,
               'fromemail'=> $fromemail,
               'toemail'=> 'me@me',
               'subject' =>$subject,
               'body'=>$messagetext )
            ),'text/html');
   

          $mailer->send($message);

            return $this->render('contact/email.html.twig',array(
               'name' => $name,
               'toemail'=> 'me@me',
               'fromemail'=>$fromemail,
               'subject' =>$subject,
               'body'=>$messagetext )
            );                
      } ;
            
        return $this->render('contact/form.html.twig', array( 'lang'=>$this->lang,
            'form' => $form->createView()  
        ));
    }
    
    
    
  
}
