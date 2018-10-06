<?php

// src/Controller/RegistrationController.php
namespace AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use AppBundle\Entity\User;
use AppBundle\Entity\Message;
use AppBundle\Form\UserUserForm;
use AppBundle\Form\UserForm;
use AppBundle\Service\MyLibrary;


class UserController extends Controller
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
    
    public function Showall()
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fusers = $this->getDoctrine()->getRepository("AppBundle:User")->findAll();
        if (!$fusers) {
            return $this->render('person/showall.html.twig', [ 'message' =>  'People not Found',]);
        }        
        foreach($fusers as $fuser)
        {
            $fuser->link = "/admin/user/".$fuser->getUserid();
        }
        return $this->render('user/showall.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'users',
        'fusers'=> $fusers,
        ]);
    }
    
    
    public function editone($uid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $encoder = $this->encoderFactory->getEncoder($fuser);
        #$tpass= $fuser->getEmail();
        
        $form = $this->createForm(UserForm::class, $fuser);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $plainpassword = $fuser->getPlainPassword();
            #dump("user PP:".$plainpassword).
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $fuser->setPassword($hashpassword);
            dump(  "isvalid ?".$encoder->isPasswordValid($hashpassword, $plainpassword,null));
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/user/search");
        }
        
      
        return $this->render('user/adminedit.html.twig', array(
            'form' => $form->createView(),
            'returnlink'=>'/admin/user/search',
            ));
    }
    
     public function newuser()
    {
        
        $request = $this->requestStack->getCurrentRequest();
        $fuser = new User;
        $encoder = $this->encoderFactory->getEncoder($fuser);
     
        
        $form = $this->createForm(UserForm::class, $fuser);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $plainpassword = $fuser->getPlainPassword();
            #dump("user PP:".$plainpassword).
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $fuser->setPassword($hashpassword);
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/user/search");
        }
        
      
        return $this->render('user/adminedit.html.twig', array(
            'form' => $form->createView(),
            'returnlink'=>'/admin/user/search',
            ));
    }
    
    
    public function edituser($uid)
    {
        $user = $this->getUser();
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/person/all");
        $request = $this->requestStack->getCurrentRequest();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $encoder = $this->encoderFactory->getEncoder($fuser);
        $tpass= $fuser->getEmail();
         
        $form = $this->createForm(UserUserForm::class, $fuser);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $plainpassword = $fuser->getPlainPassword();
            #dump("user PP:".$plainpassword).
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $fuser->setPassword($hashpassword);
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/user/search");
        }
        
        $password = $fuser->getPassword();
      
        return $this->render('user/useredit.html.twig', array(
            'form' => $form->createView(),
            'password' => $fuser->getPassword(),
             'returnlink'=> "/".$this->lang."/user/".$uid,
            ));
    }
    
    
    public function showuser($uid)
    {
         $user = $this->getUser();
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/person/all");
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $email= $fuser->getEmail();
        
        $messages = $this->getDoctrine()->getRepository('AppBundle:Message')->findbyemail($fuser->getEmail());
        return $this->render('user/show.html.twig', array(
            'lang'=>$this->lang,
            'user' => $fuser,
            'messages' =>$messages,
            'returnlink'=> "/".$this->lang."/person/all",
            ));
    }
    
     public function showone($uid)
    {
        
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $email= $fuser->getEmail();
        
        $messages = $this->getDoctrine()->getRepository('AppBundle:Message')->findbyemail($fuser->getEmail());
        return $this->render('user/showone.html.twig', array(
            'lang'=>$this->lang,
            'user' => $fuser,
            'messages' =>$messages,
            'returnlink'=> "/admin/user/search",
            ));
    }
    
    
    public function deleteuser($uid)
    {
     $this->getDoctrine()->getRepository('AppBundle:User')->delete($uid);
     return $this->redirect("/admin/user/search");
    }
    
    
     public function viewMessage($uid,$mid)
    {
        $user = $this->getUser();
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/user/".$uid);
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $email= $fuser->getEmail();
        
        $message = $this->getDoctrine()->getRepository('AppBundle:Message')->find($mid);
        return $this->render('user/showmessage.html.twig', array(
            'lang'=>$this->lang,
            'user' => $fuser,
            'message' =>$message,
            'returnlink'=> "/".$this->lang."/user/".$uid,
            ));
    }
    
    public function deletemessage($uid,$mid)
    {
        $user = $this->getUser();
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/person/all");
       $this->getDoctrine()->getRepository('AppBundle:Message')->delete($mid);
      return $this->redirect("/".$this->lang."/user/".$uid);
    }
    
     public function UserSearch(Request $request)
    {
        $message="";
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $pfield = $request->query->get('searchfield');
        $gfield = $request->query->get('searchfield');
        
        if (!$pfield) 
        {
            $users = $this->getDoctrine()->getRepository("AppBundle:User")->findAll();
            $heading =  'trouver.tout';
            
        }
        else
        {
            $pfield = "%".$pfield."%";
            $users = $this->getDoctrine()->getRepository("AppBundle:User")->findSearch($pfield);
            $heading =  'trouver.avec';
        }
        
        
        if (count($users)<1) 
        {
            $message = 'rien.trouver.pour';
        }
        else
        {
            foreach($users as $user)
            {
                $user->link = "/admin/user/".$user->getUserid();
            }
            
        }
        
        
        return $this->render('user/usersearch.html.twig', 
        [ 
        'message' => $message,
        'heading' =>  $heading,
        'searchfield' =>$gfield,
        'users'=> $users,
        
        ]);
    }
}
