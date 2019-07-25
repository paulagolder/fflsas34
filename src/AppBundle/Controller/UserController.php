<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Translation\TranslatorInterface;

use AppBundle\Entity\User;
use AppBundle\Entity\Message;
use AppBundle\Form\UserUserForm;
use AppBundle\Form\UserPasswordForm;
use AppBundle\Form\UserForm;
use AppBundle\Service\MyLibrary;


class UserController extends Controller
{
    
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    private $trans;
    
    private $encoderFactory;
    
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack,EncoderFactoryInterface $encoderFactory,TranslatorInterface $translator)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        $this->encoderFactory = $encoderFactory;
        $this->trans =$translator;
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
        $form = $this->createForm(UserForm::class, $fuser);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $plainpassword = $fuser->getPlainPassword();
            $hashpassword = $encoder->encodePassword($plainpassword,null);
            $fuser->setPassword($hashpassword);
            $entityManager->persist($fuser);
            $entityManager->flush();
            return $this->redirect("/admin/user/search");
        }
        
        
        return $this->render('user/adminedit.html.twig', array(
            'fuser'=> $fuser,
            'form' => $form->createView(),
            'returnlink'=>'/admin/user/search',
            ));
    }
    
    public function newuser()
    {
        
        $request = $this->requestStack->getCurrentRequest();
        $fuser = new User;
        $fuser->setRolestr('ROLE_USER;');
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
            'fuser'=> $fuser,
            'form' => $form->createView(),
            'returnlink'=>'/admin/user/search',
            ));
    }
    
    
    public function edituser($uid)
    {
        $user = $this->getUser();
        if(!$user)  return $this->redirect("/".$this->lang."/login");
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
            return $this->redirect("/".$this->lang."/user/".$uid);
        }
        
        $password = $fuser->getPassword();
        
        return $this->render('user/useredit.html.twig', array(
            'form' => $form->createView(),
            'password' => $fuser->getPassword(),
            'returnlink'=> "/".$this->lang."/user/".$uid,
            ));
    }
    
    public function editpassword($uid)
    {
        $user = $this->getUser();
        if(!$user)  return $this->redirect("/".$this->lang."/login");
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/person/all");
        $request = $this->requestStack->getCurrentRequest();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $encoder = $this->encoderFactory->getEncoder($fuser);
        $tpass= $fuser->getEmail();
        
        $form = $this->createForm(UserPasswordForm::class, $fuser);
        
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
            $body =  $this->renderView('message/template/'.$fuser->getLang().'/resetpassword_success.html.twig');
            $subject =  $this->trans->trans('changepass.success');
             $umessage = new message($fuser->getUsername(),$fuser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
             $smessage = $this->get('message_service')->sendMessageToUser($umessage,$fuser->getUserid(),$fuser->getLang());
            return $this->redirect("/".$this->lang."/user/".$uid);
        }
        
        return $this->render('user/userpassword.html.twig', array(
            'form' => $form->createView(),
            'password' => $fuser->getPassword(),
            'returnlink'=> "/".$this->lang."/user/".$uid,
            ));
    }
    
    public function userRereg($uid)
    {
        $request = $this->requestStack->getCurrentRequest();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $fuser->setRegistrationcode( mt_rand(100000, 999999));
        $fuser->setLastlogin( new \DateTime());
        $fuser->setRolestr("ROLE_REREG");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($fuser);
        $entityManager->flush();
        $baseurl = $this->container->getParameter('base-url');
        $code = $fuser->getRegistrationcode();
        $reglink = "{$baseurl}remoteregister/{$fuser->getUserid()}/{$code}";
        $body =  $this->renderView('message/template/'.$fuser->getLang().'/rereg_notice.html.twig', array('reglink'=>$reglink,'code'=>$code));
        $subject =  $this->trans->trans('reregister');
        $umessage = new message($fuser->getUsername(),$fuser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
        $smessage = $this->get('message_service')->sendConfidentialMessageToUser($umessage,$uid,$fuser->getLang());
        
        return $this->redirect("/admin/user/".$uid);
    }
    
    public function userDereg($uid)
    {
        $request = $this->requestStack->getCurrentRequest();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $fuser->setRegistrationcode( mt_rand(100000, 999999));
        $fuser->setLastlogin( new \DateTime());
        $fuser->setRolestr("ROLE_DEREG");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($fuser);
        $entityManager->flush();
        $baseurl = $this->container->getParameter('base-url');
        $code = $fuser->getRegistrationcode();
        $reglink = "{$baseurl}remotederegister/{$fuser->getUserid()}/{$code}";
        $body =  $this->renderView('message/template/'.$fuser->getLang().'/dereg_notice.html.twig', array('reglink'=>$reglink,'code'=>$code));
        $subject =  $this->trans->trans('deregister');
        $umessage = new message($fuser->getUsername(),$fuser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
        $smessage = $this->get('message_service')->sendConfidentialMessageToUser($umessage,$uid,$fuser->getLang());
        
        return $this->redirect("/".$fuser->getLang()."/user/".$uid);
    }
    
    
    public function showuser($uid)
    {
        $user = $this->getUser();
        if(!$user) return $this->redirect("/".$this->lang."/login");
        if($uid!= $user->getUserId())  return $this->redirect("/".$this->lang."/person/all");
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $email= $fuser->getEmail();
        
        $messages = $this->getDoctrine()->getRepository('AppBundle:Message')->findbyname($fuser->getUserName());
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
        
        $messages = $this->getDoctrine()->getRepository('AppBundle:Message')->findbyname($fuser->getUsername());
        return $this->render('user/showone.html.twig', array(
            'lang'=>$this->lang,
            'user' => $fuser,
            'messages' =>$messages,
            'returnlink'=> "/admin/user/search",
            'deletelink'=> "/admin/user/delete/".$uid,
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
    
      public function deleteallmessages($uid)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
        $this->getDoctrine()->getRepository('AppBundle:Message')->deleteallusermessages($user->getUsername());
        return $this->redirect("/admin/user/".$uid);
    }
    
    public function admindeletemessage($uid,$mid)
    {
        $user = $this->getUser();
        $this->getDoctrine()->getRepository('AppBundle:Message')->delete($mid);
        return $this->redirect("/admin/user/".$uid);
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
            $subheading =  'trouver.tout';
        }
        else
        {
            $pfield = "%".$pfield."%";
            $users = $this->getDoctrine()->getRepository("AppBundle:User")->findSearch($pfield);
            $subheading =  'trouver.avec';
        }
        if (count($users)<1) 
        {
            $subheading = 'rien.trouver.pour';
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
        'heading' =>  'Gestion des Utilisateurs',
        'subheading' =>  $subheading,
        'searchfield' =>$gfield,
        'users'=> $users,
        
        ]);
    }
}
