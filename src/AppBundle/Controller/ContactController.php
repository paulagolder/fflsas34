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
use AppBundle\Service\MyLibrary;

use Symfony\Component\HttpFoundation\RequestStack;

class ContactController extends Controller
{ 

  
    private $requestStack ;
    private $lang="fr";
    private $mylib;
    

    
    public function __construct( MyLibrary $mylib,RequestStack $request_stack )
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        
    }
    
   public function createUserMessage(Request $request , \Swift_Mailer $mailer)
    {
         $user = $this->getUser();
      
        $contact = new Contact;
        if($user)
        {
         $contact->setName($user->getUsername());
         $contact->setEmail($user->getEmail());
         }
      
      # Add form fields
        $form = $this->createFormBuilder($contact)
        ->add('name', TextType::class, array('label'=> 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('subject', TextType::class, array('label'=> 'subject','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
        ->add('Submit', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
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
            $sentto = "fflsas-admin";  
            
      # set form data   
            $contact->setSentto($sentto);
            $contact->setName($name);
            $contact->setEmail($fromemail);          
            $contact->setSubject($subject);     
            $contact->setMessage($messagetext);   
            $datesent =new \DateTime();
            $contact->setDate_sent( $datesent);
            
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
               'sentto'=> $sentto,
               'subject' =>$subject,
               'body'=>$messagetext,
               'datesent' => $datesent->format('Y-m-d H:i:s'))
            ),'text/html');
   

          $mailer->send($message);

            return $this->render('contact/usermessage-resp.html.twig',array(
               'name' => $name,
               'sentto'=> $sentto,
               'fromemail'=>$fromemail,
               'subject' =>$subject,
               'body'=>$messagetext,
               'datesent' => $datesent->format('Y-m-d H:i:s'))
            );                
      } ;
            
        return $this->render('contact/form.html.twig', array( 'lang'=>$this->lang,
            'form' => $form->createView()  
        ));
    }
    
    public function showMessages()
    {
        $messages =  $this->getDoctrine()->getRepository("AppBundle:Contact")->findAdmin();
    
        return $this->render('contact/showall.html.twig', array( 'lang'=>$this->lang,
            'messages' => $messages,
            'returnlink'=> "/admin/contact/all",
        ));
   }
  
  
   public function showMessage($cid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
       
        
        $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->find($cid);
        return $this->render('contact/show.html.twig', array(
            'lang'=>$this->lang,
            'contact' =>$contact,
            'returnlink'=> "/admin/contact/all",
            ));
    }
    
    public function deleteMessage($cid)
    {
        
        $this->getDoctrine()->getRepository('AppBundle:Contact')->delete($cid);
        return $this->redirect("/admin/contact/all");
    
    }
}
