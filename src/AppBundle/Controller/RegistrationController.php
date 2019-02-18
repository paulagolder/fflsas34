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

use AppBundle\Form\UserRegForm;
use AppBundle\Form\CompleteRegForm;

use AppBundle\Entity\User;
use AppBundle\Entity\Message;
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
        $form = $this->createForm(UserRegForm::class, $user);
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
            $baseurl = $this->container->get('router')->getContext()->getBaseUrl();
            $body =    $this->trans->trans('you.have.sucessfully.registered');
            $body .=   $this->trans->trans('to.complete');
            $body .=    "<". $user->getRegistrationcode().">";
            $body .=   $this->trans->trans('when.first.signing');
            $body .=   "  ".$baseurl.'/remotecomplete/'.$user->getUserid()."/".$user->getRegistrationcode();
            $subject = $this->trans->trans('registration success');
            $message = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            $smessage = $this->get('message_service')->sendMessage($message);
  
            $message2 =    $this->trans->trans('you.have.sucessfully.regisered');
            $message2 .=                $this->trans->trans('to.complete.reply.to email');
           return $this->render('registration/done.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $user->getEmail(),
                'message'=>$message2,
              ));
        }

        return $this->render(
            'registration/register.html.twig',
             array('form' => $form->createView() , 
             'lang'=>$this->lang,)
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
            $body =  $this->trans->trans('you.have.sucessfully.completed');
            $subject =  $this->trans->trans('registration.complete');
            $message = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
    
          #  $datesent =new \DateTime();
           # $message->setDate_sent( $datesent);
            
           # $sn = $this->getDoctrine()->getManager();      
           # $sn -> persist($message);
          #  $sn -> flush();
            $smessage = $this->get('message_service')->sendMessage($message);
          #  $this->sendMessage( $user,$subject,$body);
        
          # $this->get('security.context')->setToken(null);
         #  $this->get('session')->invalidate();
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
    
    
    public function remotecomplete(Request $request,  $uid, $code)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $usercode = $user->getRegistrationCode();
        if($code == $usercode)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
       
            $message =  $this->trans->trans('you.have.sucessfully.comlpeted');
            $subject =  $this->trans->trans('registration.complete');
            $this->sendUserMessage( $user,$subject,$message);
        
      
           return $this->render('registration/completesuccess.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $user->getEmail()
    
              ));
        }

        return $this->redirect("/fr/login");
    }
    
    
    
   
}
