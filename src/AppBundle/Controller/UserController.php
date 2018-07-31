<?php

// src/Controller/RegistrationController.php
namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\User;
use App\Forms\OldUserType;
use App\Service\MyLibrary;


class UserController extends Controller
{
    
    private $lang="FR";
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
        $fusers = $this->getDoctrine()->getRepository("App:User")->findAll();
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
        $fuser = $this->getDoctrine()->getRepository('App:User')->findOne($uid);
        $encoder = $this->encoderFactory->getEncoder($fuser);
        $tpass= $fuser->getEmail();
        
        dump("user:".$fuser->getUsername()." roles:".$fuser->getRolestr()." pw=".$fuser->getPassword());
        
        $form = $this->createForm(OldUserType::class, $fuser);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $plainpassword = $fuser->getPlainPassword();
            dump("user PP:".$plainpassword).
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $fuser->setPassword($hashpassword);
            dump(  "isvalid ?".$encoder->isPasswordValid($hashpassword, $plainpassword,null));
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/users");
        }
        
        
        $password = $fuser->getPassword();
        $isvalid=  $encoder->isPasswordValid($password, $tpass,null);
        if($isvalid)
        {
            $pass="ok";
        }
        else
        {
            $pass="fail";
        }
        return $this->render('user/edit.html.twig', array(
            'form' => $form->createView(),
            'password' => $fuser->getPassword(),
            'isvalid' =>$pass,
            'returnlink'=>'/admin/users',
            ));
    }
    
}
