<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\SwiftmailerBundle\Swift_SmtpTransport;
#use AppBundle\MyClasses\EMail;

use AppBundle\Entity\Message;
use AppBundle\Service\MyLibrary;
use AppBundle\Form\MessageForm;

use Symfony\Component\HttpFoundation\RequestStack;

class MessageController extends Controller
{ 

  
    private $requestStack ;
    private $lang="fr";
    private $mylib;
    

    
    public function __construct( MyLibrary $mylib,RequestStack $request_stack )
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        
    }
    
   #public function createUserMessage(Request $request , \Swift_Mailer $mailer)
    public function createUserMessage(Request $request ,\Swift_Mailer $mailer) 
    {
         $user = $this->getUser();
      
        $message = new Message;
        if($user)
        {
         $message->setName($user->getUsername());
         $message->setEmail($user->getEmail());
         }
      
      # Add form fields
        $form = $this->createFormBuilder($message)
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
            $message->setSentto($sentto);
            $message->setName($name);
            $message->setEmail($fromemail);          
            $message->setSubject($subject);     
            $message->setMessage($messagetext);   
            $datesent =new \DateTime();
            $message->setDate_sent( $datesent);
            
       # finally add data in database
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($message);
            $sn -> flush();

           $message = (new \Swift_Message('Hello Email'));
           $message->setSubject($subject);
           $message->setFrom('admin@syfflsas3.lerot.org','fflsas-admin');
           $message->setTo($fromemail);
            $message->setBody(
            $this->renderView('message/emailbody.html.twig',array(
               'name' => $name,
               'fromemail'=> $fromemail,
               'sentto'=> $sentto,
               'subject' =>$subject,
               'body'=>$messagetext,
               'datesent' => $datesent->format('Y-m-d H:i:s'))
            ),'text/html');
   

          $mailer->send($message);

            return $this->render('message/usermessage-resp.html.twig',array(
               'name' => $name,
               'sentto'=> $sentto,
               'fromemail'=>$fromemail,
               'subject' =>$subject,
               'body'=>$messagetext,
               'datesent' => $datesent->format('Y-m-d H:i:s'))
            );                
      } ;
            
        return $this->render('message/form.html.twig', array( 'lang'=>$this->lang,
            'form' => $form->createView()  
        ));
    }
    
    public function showMessages()
    {
        $messages =  $this->getDoctrine()->getRepository("AppBundle:Message")->findAdmin();
    
        return $this->render('message/showall.html.twig', array( 'lang'=>$this->lang,
            'messages' => $messages,
            'returnlink'=> "/admin/message/all",
        ));
   }
  
  
   public function showAdminMessage($cid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
       
        
        $message = $this->getDoctrine()->getRepository('AppBundle:Message')->find($cid);
        #$user =  $this->getDoctrine()->getRepository('AppBundle:User')->findbyEmail($user->getEmail());
        
        return $this->render('message/show.html.twig', array(
            'lang'=>$this->lang,
            'message' =>$message,
            'returnlink'=> "/admin/message/all",
            ));
    }
    
     public function showUserMessage($uid,$cid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
       
        
        $message = $this->getDoctrine()->getRepository('AppBundle:Message')->find($cid);
        #$user =  $this->getDoctrine()->getRepository('AppBundle:User')->findbyEmail($user->getEmail());
        
        return $this->render('message/show.html.twig', array(
            'lang'=>$this->lang,
            'message' =>$message,
            'returnlink'=> "/admin/user/".$uid,
            ));
    }
    
    public function deleteMessage($cid)
    {
        
        $this->getDoctrine()->getRepository('AppBundle:Message')->delete($cid);
        return $this->redirect("/admin/message/all");
    
    }
    
     public function sendMessageToUser($uid,Request $request ,\Swift_Mailer $mailer) 
    {
         $fuser = $this->getDoctrine()->getRepository('AppBundle:User')->findOne($uid);
      
        $message = new Message;
        if($fuser)
        {
         $message->setName($fuser->getUsername());
         $message->setEmail($fuser->getEmail());
         }
        

      
        $form = $this->createForm(MessageForm::class, $message);
        
      # Handle form and recaptcha response
        $form->handleRequest($request);
    
      # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
            $name = $form['name']->getData();
            $fromemail = $form['email']->getData();
            $subject = $form['subject']->getData();
            $messagetext = $form['message']->getData();
            $sentto = $fuser->getEmail();  
            
      # set form data   
            $message->setSentto($sentto);
            $message->setName($name);
            $message->setEmail($fromemail);          
            $message->setSubject($subject);     
            $message->setMessage($messagetext);   
            $datesent =new \DateTime();
            $message->setDate_sent( $datesent);
            
       # finally add data in database
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($message);
            $sn -> flush();

           $message = (new \Swift_Message('Hello Email'));
           $message->setSubject($subject);
           $message->setFrom('admin@syfflsas3.lerot.org','fflsas-admin');
           $message->setTo($fromemail);
            $message->setBody(
            $this->renderView('message/emailbody.html.twig',array(
               'name' => $name,
               'fromemail'=> $fromemail,
               'sentto'=> $sentto,
               'subject' =>$subject,
               'body'=>$messagetext,
               'datesent' => $datesent->format('Y-m-d H:i:s'))
            ),'text/html');
   

          $mailer->send($message);

            return $this->render('message/usermessage-resp.html.twig',array(
               'message'=>$message,
               'returnlink'=>'/admin/user/'.$uid,
            ));          
      } ;
            
        return $this->render('message/sendto.html.twig', array( 'lang'=>$this->lang,
            'form' => $form->createView()  
        ));
    }
}
