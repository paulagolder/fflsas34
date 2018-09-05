<?php

// src/Controller/RegistrationController.php
namespace AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
#use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use AppBundle\Form\UserType;
use AppBundle\Form\CompleteRegForm;

use AppBundle\Entity\User;
use AppBundle\Entity\Contact;
use AppBundle\Service\MyLibrary;


class RegistrationController extends Controller
{
  
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    private $encoderFactory;
    private $trans;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack,EncoderFactoryInterface $encoderFactory,TranslatorInterface $translator)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        $this->encoderFactory = $encoderFactory;
        $this->trans =$translator;
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
            $user->setRegistrationcode( mt_rand(100000, 999999));
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_TEMP;");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        
            $message =    $this->trans->trans('you.have.sucessfully.regisered');
            $message .=                $this->trans->trans('to.complete');
            $message .=               "<". $user->getRegistrationcode().">";
            $message .=                $this->trans->trans('when.first.signing');
            $subject = 'registration success';
            $this->sendMessage($user, $subject,$message);
        
           return $this->render('registration/done.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $plainpassword ,
                'message'=>$message,
              ));
        }

        return $this->render(
            'registration/register.html.twig',
             array('form' => $form->createView() , 'lang'=>$this->lang,)
        );
    }
    
    
      public function complete(Request $request,  $uid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $form = $this->createForm(CompleteRegForm::class, $user);
        $form->handleRequest($request);
       # $form->bind($request);
         $codeisvalid= $user->codeisvalid();
    
        if ($form->isSubmitted() && $form->isValid() && $codeisvalid ) 
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
           # return $this->redirectToRoute('index');
            $message =  $this->trans->trans('you.have.sucessfully.comlpeted');
            $subject =  $this->trans->trans('registration.complete');
            $this->sendMessage( $user,$subject,$message);
        
           $container->get('security.context')->setToken(null);
           $container->get('session')->invalidate();
           return $this->render('registration/completesuccess.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $user->getEmail()
    
              ));
        }

        return $this->render(
            'registration/complete.html.twig',
             array('form' => $form->createView() , 'lang'=>$this->lang,)
        );
    }
    
    
    
    function sendMessage($user,$subject, $message)
    {
            $contact = new contact();
            $contact->setName($user->getUsername());
            $contact->setEmail($user->getEmail());          
            $contact->setSubject($subject);     
           
            $contact->setMessage($message);   
            $datesent =new \DateTime();
            $contact->setDate_sent( $datesent);
            
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($contact);
            $sn -> flush();

           $message = (new \Swift_Message('Registration Email'));
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
      } 
}
