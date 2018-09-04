<?php

// src/Controller/RegistrationController.php
namespace AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
#use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\Contact;
use AppBundle\Service\MyLibrary;


class RegistrationController extends Controller
{
  
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    private $encoderFactory;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack,EncoderFactoryInterface $encoderFactory)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        $this->encoderFactory = $encoderFactory;
    }

  

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
       $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
       # $form->bind($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $encoder = $this->encoderFactory->getEncoder($user);
            $plainpassword = $user->getPlainPassword();
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $user->setPassword($hashpassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
           # return $this->redirectToRoute('index');
            $isvalid=  $encoder->isPasswordValid($hashpassword, $plainpassword,null);
        if($isvalid)
        {
            $pass="ok";
        }
        else
        {
            $pass="fail";
        }
        $this->sendacknowledgement( $user);
        
           return $this->render('registration/done.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $plainpassword 
                
              ));
        }

        return $this->render(
            'registration/register.html.twig',
             array('form' => $form->createView() , 'lang'=>$this->lang,)
        );
    }
    
    
    function sendacknowledgement($user)
    {
            $contact = new contact();
            $contact->setName($user->getUsername());
            $contact->setEmail($user->getEmail());          
            $contact->setSubject('registration success');     
            $contact->setMessage('you have sucessfully regisered ');   
            $datesent =new \DateTime();
            $contact->setDate_sent( $datesent);
            
       # finally add data in database
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($contact);
            $sn -> flush();

           $message = (new \Swift_Message('Hello Email'));
           $message->setSubject($contact->getSubject());
           $message->setFrom('admin@syfflsas3.lerot.org','fflsas-admin');
           $message->setTo($contact->getEmail());
            $message->setBody(
            $this->renderView('contact/emailbody.html.twig',array(
               'name' => $contact->getName(),
               'fromemail'=> 'fflsas-admin',
               'toemail'=> $contact->getEmail(),
               'subject' =>$contact->getSubject(),
               'body'=>$contact->getMessage(),
               'datesent' => $contact->getDate_sent()->format('Y-m-d H:i:s'))
            ),'text/html');
   
  $this->get('mailer')->send($message);
          #$mailer->send($message);

                        
      } 
}
