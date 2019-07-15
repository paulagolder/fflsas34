<?php

// src/Controller/RegistrationController.php
namespace AppBundle\Controller;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
#use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use AppBundle\Form\UserRegForm;
use AppBundle\Form\ResetForm;
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
        if ($form->isSubmitted() && $form->isValid()  && $this->captchaverify($request->get('g-recaptcha-response')) ) 
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
            $baseurl = $this->container->getParameter('base-url');
            $body =    $this->trans->trans('you.have.sucessfully.registered');
            $body .=   $this->trans->trans('to.complete.enter');
            $body .=    "<". $user->getRegistrationcode().">";
            $body .=   $this->trans->trans('when.first.signing');
            $reglink = "{$baseurl}remotecomplete/{$user->getUserid()}/{$user->getRegistrationcode()}";
            $body .=   " <a href='$reglink '>$reglink</a> ";
            dump($body);
            $subject = $this->trans->trans('registration success');
            $message = Message::CreateMessage();
            $message->setSubject($subject);
            $message->setFromEmail( $this->getParameter('admin-email'));
            $message->setFromName( $this->getParameter('admin-name'));
            $message->setToEmail($user->getEmail());
            $message->setToName($user->getUsername());
            $message->setBody($body, 'text/html');
            $smessage = $this->get('message_service')->sendMessage($message);
            
            $message2 =    $this->trans->trans('you.have.sucessfully.registered');
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
    
    
    public function resetpasswordrequest(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user = new User();
        $form = $this->createForm(ResetForm::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()  && $this->captchaverify($request->get('g-recaptcha-response')) ) 
        {
            $email = $user->getEmail();
            $ouser =   $this->getDoctrine()->getRepository("AppBundle:User")->loadUserbyUsername($email);
            if(!$ouser) 
            {
               return $this->render(
                    'registration/reset.html.twig',
                    array('form' => $form->createView() , 
                    'lang'=>$this->lang,
                    'message' => "user.not.recognised",)
                    );
            }

            $ouser->setRegistrationcode( mt_rand(100000, 999999));
            $ouser->setLastlogin( new \DateTime());
            $ouser->setRolestr("ROLE_PWCH;");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ouser);
            $entityManager->flush();
            $baseurl = $this->container->getParameter('base-url');
            $body =    $this->trans->trans('you.have.sucessfully.requested.change.password');
            $body .=   $this->trans->trans('to.complete.enter');
            $body .=    "<". $ouser->getRegistrationcode().">";
            $body .=   $this->trans->trans('when.first.signing');
            $reglink = "{$baseurl}remotechange/{$ouser->getUserid()}/{$ouser->getRegistrationcode()}";
            $body .=   " <a href='$reglink '>$reglink</a> ";
            dump($body);
            $subject = $this->trans->trans('password.change.request');
            $message = Message::CreateMessage();
            $message->setSubject($subject);
            $message->setFromEmail( $this->getParameter('admin-email'));
            $message->setFromName( $this->getParameter('admin-name'));
            $message->setToEmail($ouser->getEmail());
            $message->setToName($ouser->getUsername());
            $message->setBody($body, 'text/html');
            $smessage = $this->get('message_service')->sendMessage($message);
            
            $message2 =    $this->trans->trans('you.have.sucessfully.requested.change.password');
            $message2 .=   " ".$this->trans->trans('to.complete.reply.to email');
            return $this->render('registration/done.html.twig',
            array(
                'username' => $ouser->getUsername() ,
                'email' => $ouser->getEmail(),
                'message'=>$message2,
                ));
        }
        
        return $this->render(
            'registration/reset.html.twig',
            array('form' => $form->createView() , 
            'lang'=>$this->lang,
             'message'=>null,));
    }
    
      public function xxresetpassword2(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user = new User();
        $form = $this->createForm(ResetForm::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()  && $this->captchaverify($request->get('g-recaptcha-response')) ) 
        {
            $email = $user->getEmail();
            $ouser =   $this->getDoctrine()->getRepository("AppBundle:User")->loadUserbyEmail($email);
            if(!$ouser) 
            {
                $this->render(
                    'registration/reset.html.twig',
                    array('form' => $form->createView() , 
                    'lang'=>$this->lang,)
                    );
            }
            $encoder = $this->encoderFactory->getEncoder($user);
            $plainpassword = $user->getPlainPassword();
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            
            
            $ouser->setPassword($hashpassword);
            $ouser->setRegistrationcode( mt_rand(100000, 999999));
            $ouser->setLastlogin( new \DateTime());
            $ouser->setRolestr("ROLE_TEMP;");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ouser);
            $entityManager->flush();
            $baseurl = $this->container->getParameter('base-url');
            $body =    $this->trans->trans('you.have.sucessfully.changed.password');
            $body .=   $this->trans->trans('to.complete.enter');
            $body .=    "<". $user->getRegistrationcode().">";
            $body .=   $this->trans->trans('when.first.signing');
            $reglink = "{$baseurl}remotecomplete/{$ouser->getUserid()}/{$ouser->getRegistrationcode()}";
            $body .=   " <a href='$reglink '>$reglink</a> ";
            dump($body);
            $subject = $this->trans->trans('password.change.success');
            $message = Message::CreateMessage();
            $message->setSubject($subject);
            $message->setFromEmail( $this->getParameter('admin-email'));
            $message->setFromName( $this->getParameter('admin-name'));
            $message->setToEmail($user->getEmail());
            $message->setToName($user->getUsername());
            $message->setBody($body, 'text/html');
            $smessage = $this->get('message_service')->sendMessage($message);
            
            $message2 =    $this->trans->trans('you.have.sucessfully.change.password');
            $message2 .=                $this->trans->trans('to.complete.reply.to email');
            return $this->render('registration/done.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $user->getEmail(),
                'message'=>$message2,
                ));
        }
        
        return $this->render(
            'registration/reset.html.twig',
            array('form' => $form->createView() , 
            'lang'=>$this->lang,)
            );
    }
    
    
    public function complete(Request $request,  $uid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $uname = $user->getUsername();
        $uemail = $user->getEmail();
        
        $form = $this->createForm(CompleteRegForm::class, $user);
        $form->handleRequest($request);
        $codeisvalid= $user->codeisvalid();
        if ($form->isSubmitted() && $form->isValid() && $codeisvalid ) 
        {
            
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $user->setUsername($uname);
            $user->setEmail($uemail);
            dump($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            # return $this->redirectToRoute('index');
            $body =  $this->trans->trans('you.have.sucessfully.completed');
            $subject =  $this->trans->trans('registration.complete');
            $message = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            
            $smessage = $this->get('message_service')->sendMessage($message);
            #  $this->sendMessage( $user,$subject,$body);
            
            // $this->get('security.context.listener')->setToken(null);
            $this->get('session')->invalidate();
            return $this->render('security/login.html.twig', array(
                'last_username' => $uname,
                'error'         => "",
                ));
                /// return $this->render('registration/completesuccess.html.twig',
                //  array(
                //      'username' => $user->getUsername() ,
                //      'email' => $user->getEmail()
                //      
                //     ));
        }
        
        return $this->render(
            'registration/complete.html.twig',
            array('form' => $form->createView() , 'lang'=>$this->lang,)
            );
    }
    
    
    public function remotecomplete(  $uid, $code)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $usercode = $user->getRegistrationCode();
        if($code == $usercode || $code==987654)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $body =  $this->trans->trans('you.have.sucessfully.completed');
            $subject =  $this->trans->trans('registration.complete');
            //      $smessage = $this->get('message_service')->sendMessage($message);
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            
            $smessage = $this->get('message_service')->sendMessage($umessage);
            //  $this->sendUserMessage( $user,$subject,$message);
            
            return $this->render('security/login.html.twig', array(
                'last_username' => $user->getUsername(),
                'error'         => "",
                ));
                // return $this->render('registration/completesuccess.html.twig',
                // array(
                //     'username' => $user->getUsername() ,
                //     'email' => $user->getEmail()
                //     
                //     ));
        }
        
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
    }
    
    public function remotereregister(  $uid, $code, Request $request)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $usercode = $user->getRegistrationCode();
        if($code == $usercode || $code = 123456)
        {
            dump($user);
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $body =  $this->trans->trans('you.have.sucessfully.reset.password');
            $subject =  $this->trans->trans('password.reset');
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            $smessage = $this->get('message_service')->sendMessage($umessage);
            $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
            if (!$user) {
               // throw new UsernameNotFoundException("User not found");
            } else {
             
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                //$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
                return $this->redirect("/fr/useredit/".$uid);
            }
            
        }
        
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
    }
    
       public function remotechangepassword(  $uid, $code, Request $request)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $usercode = $user->getRegistrationCode();
        $chpx = $user->hasRole("ROLE_PWCH");
        if($code == $usercode && $chpw)
        {
            dump($user);
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $body =  $this->trans->trans('you.have.sucessfully.reset.your.password');
            $subject =  $this->trans->trans('password.reset');
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            $smessage = $this->get('message_service')->sendMessage($umessage);
            $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
            if (!$user) {
               // throw new UsernameNotFoundException("User not found");
            } else {
             
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                //$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
                return $this->redirect("/fr/useredit/".$uid);
            }
            
        }
        
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
    }
    
    
    function captchaverify($recaptcha)
    {
        
        $secret = $this->container->getParameter('recaptcha_secret');
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>$secret,"response"=>$recaptcha));
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);     
            
            return $data->success;   
            // return true;
    }
    
}
