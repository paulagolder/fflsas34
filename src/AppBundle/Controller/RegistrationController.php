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
        $message = "";
        $user = new User();
        $form = $this->createForm(UserRegForm::class, $user);
        $form->handleRequest($request);
        if($this->getDoctrine()->getRepository("AppBundle:User")->isUniqueName($user->getUsername()))
        {
        if ($form->isSubmitted() && $form->isValid()  && $this->captchaverify($request->get('g-recaptcha-response')) ) 
        {
            $encoder = $this->encoderFactory->getEncoder($user);
            $plainpassword = $user->getPlainPassword();
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $user->setPassword($hashpassword);
            $user->setRegistrationcode( mt_rand(100000, 999999));
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_TEMP;");
            $user->setLocale( $this->lang );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $baseurl = $this->container->getParameter('base-url');
            $code = $user->getRegistrationcode();
            $reglink = "{$baseurl}confirmemailaddress/{$user->getUserid()}/{$code}";
            $body =  $this->renderView('message/template/'.$user->getLang().'/cond_reg_notice.html.twig', array('reglink'=>$reglink,'code'=>$code));
            $subject = $this->trans->trans('registration.success',[],null,$user->getLang());
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            $smessage = $this->get('message_service')->sendConfidentialMessageToUser($umessage, $user->getUserid(),$user->getLang());
            $message2 = $this->trans->trans('you.have.commenced.registration');
            $message2 .= $this->trans->trans('to.continue.reply.to.email');
            return $this->render('registration/done.html.twig',
            array(
                'username' => $user->getUsername() ,
                'email' => $user->getEmail(),
                'message'=>$message2,
                'heading'=> 'registration.started',
                ));
        }
        }
        else{
        $message= "duplicate.username ";
        }
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView() , 
            'lang'=>$this->lang,
            'message'=>$message,
            ));
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->get('session')->invalidate();
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            return $this->redirect("/".$user->getLang()."/person/all");
        }
        
        return $this->render(
            'registration/complete.html.twig',
            array('form' => $form->createView() , 'lang'=>$this->lang,)
            );
    }
  
  //======================================  registation stage 2  ===============================================
  // user validates email then  admin is sent request for approval  and message to user saying to await admin approval
    
    
    
    public function confirmemailaddress(  $uid, $code)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        if($user)
        {
        $usercode = $user->getRegistrationCode();
        $temp = $user->hasRole("ROLE_TEMP");
       // $rtereg = $user->hasRole("ROLE_REREG");
        if($code == $usercode && $temp )
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_ADAP;");
            $user->setRegistrationcode(null);
            $lang = $user->getLang();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush(); 
            //message to user
            $ubody =  $this->renderView('message/template/'.$user->getLang().'/emailvalidationcomplete.html.twig');
            $usubject =  $this->trans->trans('email.confirmed',[],null,$user->getLang());
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$usubject, $ubody);
            $smessage = $this->get('message_service')->sendMessageToUser($umessage,$user->getUserid(), $user->getLang());
            // message to admin 
              $baseurl = $this->container->getParameter('base-url');
               $applink = "{$baseurl}admin/approveuser/{$user->getUserid()}";
            $abody =  $this->renderView('message/template/'.$user->getLang().'/approbationrequest.html.twig',array('applink'=> $applink));
            $asubject =  $this->trans->trans('approbation.request',[],null,$user->getLang());
            $amessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$asubject, $abody);
            $asmessage = $this->get('message_service')->sendMessageToAdmin($amessage, $user->getLang());
            //clear token
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            return $this->render('registration/stage2.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
        }
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
        }
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' =>$this->trans->trans('unknownuser') ,
            'email' => ""
            
            ));
        
    }
    
    
    public function approveuser($uid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $chpw = $user->hasRole("ROLE_ADAP");
        if($chpw)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $ubody =  $this->renderView('message/template/'.$user->getLang().'/registrationcompletion.html.twig');
            $usubject =  $this->trans->trans('registration.complete',[],null,$user->getLang());
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$usubject, $ubody);
            $smessage = $this->get('message_service')->sendMessageToUser($umessage,$user->getUserid(), $user->getLang());
            return $this->redirect("/admin/user/".$uid);
        }
         return $this->redirect("/admin/user/".$uid);
      
    }
    
    public function rejectuser($uid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $chpw = $user->hasRole("ROLE_ADAP");
        if($chpw)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_DELL;");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $ubody =  $this->renderView('message/template/'.$user->getLang().'/registrationrejected.html.twig');
            $usubject =  $this->trans->trans('registration.rejected',[],null,$user->getLang());
            $umessage = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$usubject, $ubody);
            $smessage = $this->get('message_service')->sendMessageToUser($umessage,$user->getUserid(), $user->getLang());
            return $this->redirect("/admin/user/".$uid);
        }
         return $this->redirect("/admin/user/".$uid);
      
    }
    
    
    
//======================================  reregistation forced by administrator  ===============================================
    
    public function remotereregister($uid, $code, Request $request)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $lang = $user->getLocale();
        $usercode = $user->getRegistrationCode();
        $temp = $user->hasRole("ROLE_REREG");
        if($code == $usercode && $temp)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
            if (!$user) {
               
            } else {
             
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                return $this->redirect("/".$lang."/userpassword/".$uid);
            }
            
        }
        
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
    }
    
   
   
   
   //====================================== password reset ===============================================
   
      
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
            $code = $ouser->getRegistrationcode();
            $reglink = "{$baseurl}remotechangepassword/{$ouser->getUserid()}/{$code}";
            $body =  $this->renderView('message/template/'.$ouser->getLang().'/resetpassword_notice.html.twig', array('reglink'=>$reglink,'code'=>$code));
            $subject = $this->trans->trans('request.new.password',[],null,$ouser->getLang() );
            $umessage = new message($ouser->getUsername(),$ouser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
            $smessage = $this->get('message_service')->sendConfidentialMessageToUser($umessage, $ouser->getUserid(),$ouser->getLang());

            $message2 =    $this->trans->trans('you.have.sucessfully.requested.change.password');
            $message2 .=   "<br>".$this->trans->trans('to.complete.reply.to.email');
            return $this->render('registration/done.html.twig',
            array(
                'username' => $ouser->getUsername() ,
                'email' => $ouser->getEmail(),
                'message'=> $message2,
                 'heading'=> $this->trans->trans('request.new.password'),
                ));
        }
        
        return $this->render('registration/reset.html.twig',
        array(
             'form' => $form->createView() , 
             'lang'=>$this->lang,
             'message'=>null,));
    }
    
    public function remotechangepassword($uid, $code, Request $request)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
        $usercode = $user->getRegistrationCode();
        $chpw = $user->hasRole("ROLE_PWCH");
        if($code == $usercode && $chpw)
        {
            $user->setLastlogin( new \DateTime());
            $user->setRolestr("ROLE_USER;");
            $user->setRegistrationcode(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $user =   $this->getDoctrine()->getRepository("AppBundle:User")->findOne($uid);
            if (!$user) {
               
            } else {
             
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                return $this->redirect("/".$user->getlang()."/userpassword/".$uid);
            }
            
        }
        
        return $this->render('registration/reregfail.html.twig',
        array(
            'username' => $user->getUsername() ,
            'email' => $user->getEmail()
            
            ));
    }
    
    
   
   
   //====================================== captcha verify  ===============================================   
    
    
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
