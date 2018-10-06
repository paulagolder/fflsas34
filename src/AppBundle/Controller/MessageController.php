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
use AppBundle\Form\UserMessageForm;

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
    
    public function createUserMessage(Request $request ,\Swift_Mailer $mailer) 
    {
         $user = $this->getUser();
    
        $message = new Message;
        if($user)
        {
         $message->setFromname($user->getUsername());
         $message->setFromEmail($user->getEmail());
         }
         $toname = $this->getParameter('admin-name');
         $toemail = $this->getParameter('admin-email');
         $message->setToname($toname);
         $message->setToemail($toemail);
    
         $form = $this->createForm(UserMessageForm::class, $message);
      # Handle form and recaptcha response
        $form->handleRequest($request);
    
      # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
            $fromname = $form['fromname']->getData();
            $fromemail = $form['fromemail']->getData();
            $subject = $form['subject']->getData();
            $messagetext = $form['message']->getData();
            
            
      # set form data   
            $message->setToname($toname);
            $message->setToemail($toemail);
            $message->setFromname($fromname);
            $message->setFromemail($fromemail);          
            $message->setSubject($subject);     
            $message->setMessage($messagetext); 
            $datesent =new \DateTime();
            $message->setDate_sent( $datesent);
            dump($message);
       # finally add data in database
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($message);
            $sn -> flush();

           $smessage = (new \Swift_Message('FFLSAS Email'));
           $smessage->setSubject($subject);
           $smessage->setFrom($this->getParameter('admin-email'),$this->getParameter('admin-name'));
           $smessage->setTo($toemail);
           $smessage->setBody(
            $this->renderView('message/emailbody.html.twig',array(
               'message'=>$message,
            )),'text/html');
   

           $mailer->send($smessage);

           return $this->render('message/usermessage-resp.html.twig',array(
               'message'=>$message,
               'returnlink' =>"/$this->lang/person/all")
            );                
        } ;
            
        return $this->render('message/form.html.twig', array( 
            'lang'=>$this->lang,
            'form' => $form->createView(),  
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
      
     //     $message = new message($user->getUsername(),$user->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
        //    $smessage = $this->get('message_service')->sendMessage($message);
  
       ## if($fuser)
       # {
       #  $message->setToname($fuser->getUsername());
       #  $message->setToemail($fuser->getEmail());
       #  }
       #   $message->setFromname($this->getParameter('admin-name'));
       #  $message->setFromemail($this->getParameter('admin-email'));
       $subject ="";
       $body="";
   $message = new message($fuser->getUsername(),$fuser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
          #  $smessage = $this->get('message_service')->sendMessage($message);
  
      
        $form = $this->createForm(MessageForm::class, $message);
        
      # Handle form and recaptcha response
        $form->handleRequest($request);
    
      # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
           # $fromname = $form['fromname']->getData();
           # $fromemail = $form['fromemail']->getData();
          # # $subject = $form['subject']->getData();
          #  $messagetext = $form['message']->getData();
          #  $sentto = $fuser->getEmail();  
            
      # set form data   
           # $message->setToname($toname);
          #  $message->setFromname($name);
          #  $message->setEmail($fromemail);          
         #   $message->setSubject($subject);     
         #   $message->setMessage($messagetext);   
            $datesent =new \DateTime();
            $message->setDate_sent( $datesent);
            
       # finally add data in database
        ##    $sn = $this->getDoctrine()->getManager();      
         #   $sn -> persist($message);
         #   $sn -> flush();

       #    $smessage = (new \Swift_Message('Hello Email'));
       #    $smessage->setSubject($subject);
       #    $smessage->setFrom($this->getParameter('admin-email'),$this->getParameter('admin-name'));
       #    $smessage->setTo($fromemail);
        #    $smessage->setBody(
         #   $this->renderView('message/emailbody.html.twig',array(
         #      'message'=>$message,
         #   ),'text/html'));
   

       #   $mailer->send($smessage);
       $this->sendMessage($message);

            return $this->render('message/usermessage-resp.html.twig',array(
               'message'=>$message,
               'returnlink'=>'/admin/user/'.$uid,
            ));          
      } ;
            
        return $this->render('message/sendto.html.twig', array( 'lang'=>$this->lang,
            'form' => $form->createView()  
        ));
    }
    
      function xsendMessage($user,$subject, $message)
    {
            $message = new message();
            $message->setName($user->getUsername());
            $message->setEmail($user->getEmail());          
            $message->setSubject($subject);     
           
            $message->setMessage($message);   
            $datesent =new \DateTime();
            $message->setDate_sent( $datesent);
            
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($message);
            $sn -> flush();

           $smessage = (new \Swift_Message('Registration Email'));
           $smessage->setSubject($message->getSubject());
           $smessage->setFrom('admin@syfflsas3.lerot.org','fflsas-admin');
           $smessage->setTo($message->getEmail());
           $smessage->setBody(
                $this->renderView('message/emailbody.html.twig',array(
               'name' => $message->getName(),
               'fromemail'=> 'fflsas-admin',
               'sentto'=> $message->getEmail(),
               'subject' =>$message->getSubject(),
               'body'=>$message->getBody(),
               'datesent' => $message->getDate_sent()->format('Y-m-d H:i:s'))
                         ),'text/html');
          $smessage->setContentType("text/html");
          $this->get('mailer')->send($smessage);
      } 
      
      
      function makeSwiftMessage($message)
      {
           $smessage = (new \Swift_Message('FFLSAS Email'));
           $smessage->setSubject($message->getSubject());
           $smessage->setFrom($message->getFromemail(),$message->getFromname());
           $smessage->setTo($message->gettoEmail());
           $smessage->setBody(
                $this->renderView('message/emailbody.html.twig',array(
               'message'=>$message,),'text/html'));
           $smessage->setContentType("text/html");
           return $smessage;
      
      }
      
    function sendMessage($message)
    {
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($message);
            $sn -> flush();
            $smessage = $this->makeSwiftMessage($message);
            $this->get('mailer')->send($smessage);
      } 
}
