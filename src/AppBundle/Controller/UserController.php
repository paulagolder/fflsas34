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
use AppBundle\Entity\Contact;
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
        $tpass= $fuser->getEmail();
        
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
            return $this->redirect("/admin/users");
        }
        
      
        return $this->render('user/adminedit.html.twig', array(
            'form' => $form->createView(),
            'returnlink'=>'/admin/users',
            ));
    }
    
    
    public function edituser($uid)
    {
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
            dump(  "isvalid ?".$encoder->isPasswordValid($hashpassword, $plainpassword,null));
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/users");
        }
        
        $password = $fuser->getPassword();
      
        return $this->render('user/useredit.html.twig', array(
            'form' => $form->createView(),
            'password' => $fuser->getPassword(),
            'returnlink'=>'/admin/users',
            ));
    }
    
    
    public function showuser($uid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $email= $fuser->getEmail();
        
        $contacts = $this->getDoctrine()->getRepository('AppBundle:Contact')->findbyemail($fuser->getEmail());
        return $this->render('user/show.html.twig', array(
            'lang'=>$this->lang,
            'user' => $fuser,
            'contacts' =>$contacts,
            'returnlink'=> "/".$this->lang."/person/all",
            ));
    }
    
    public function deleteuser($uid)
    {
     $this->getDoctrine()->getRepository('AppBundle:User')->delete($uid);
     return $this->redirect("/admin/users");
    }
}
