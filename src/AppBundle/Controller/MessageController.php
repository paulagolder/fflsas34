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
use AppBundle\Form\VisitorMessageForm;


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
    
     public function createMessage(Request $request ,\Swift_Mailer $mailer) 
    {
        $user = $this->getUser();
        if($user)
        {
           return $this->createUserMessage($request ,$mailer)  ;
        }
        else
        { 
           return $this->createVisitorMessage($request ,$mailer)  ;
        }
    }
    
    public function createUserMessage(Request $request ,\Swift_Mailer $mailer) 
    {
        $user = $this->getUser();
        if($user)
        {
           $message = new Message($this->getParameter('admin-name'), $this->getParameter('admin-email'),$user->getUsername(),$user->getEmail() ,"", ""); 
        }
        else
        {
        $message = new Message($this->getParameter('admin-name'), $this->getParameter('admin-email'),"", "" ,"", "");
        }
        $form = $this->createForm(UserMessageForm::class, $message);
 
        $form->handleRequest($request);
        
        # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
            $this->sendMessage($message);
            return $this->render('message/usermessage-resp.html.twig',array(
                'message'=>$message,
                'returnlink' =>"/$this->lang/person/all")
                );                
        } ;
        
        return $this->render('message/userform.html.twig', array( 
        'lang'=>$this->lang,
        'form' => $form->createView(),  
        ));
    }
    
     public function createVisitorMessage(Request $request ,\Swift_Mailer $mailer) 
    {
        
        $message = new Message($this->getParameter('admin-name'), $this->getParameter('admin-email'),"", "" ,"", "");
        
        $form = $this->createForm(VisitorMessageForm::class, $message);
 
        $form->handleRequest($request);
        
        # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid()  && $this->captchaverify($request->get('g-recaptcha-response')))
        {
            $this->sendMessage($message);
            return $this->render('message/usermessage-resp.html.twig',array(
                'message'=>$message,
                'returnlink' =>"/$this->lang/person/all")
                );                
        } 
        return $this->render('message/visitorform.html.twig', array( 
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
        
        $subject ="";
        $body="";
        $message = new message($fuser->getUsername(),$fuser->getEmail(),$this->getParameter('admin-name'), $this->getParameter('admin-email'),$subject, $body);
        
        $form = $this->createForm(MessageForm::class, $message);
        $form->handleRequest($request);
        
        # check if form is submitted and Recaptcha response is success
        if($form->isSubmitted() &&  $form->isValid())
        {
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
    
   
    
    
    function makeSwiftMessage($message)
    {
        $smessage = (new \Swift_Message('FFLSAS Email'));
        $smessage->setSubject($message->getSubject());
        //$smessage->setFrom($message->getFromemail(),$message->getFromname());
        $sender = $this->getParameter('admin-email');
        $sendername = $this->getParameter('admin-name');
        $smessage->setFrom($sender,$sendername);
        $smessage->setTo($message->gettoEmail());
        $smessage->setBody(
            $this->renderView('message/emailbody.html.twig',array(
                'message'=>$message,),'text/html'));
        $smessage->setContentType("text/html");
        return $smessage;
                
    }
    
    function sendMessage($message)
    {
        $datesent =new \DateTime();
        $message->setDate_sent( $datesent);
        $sn = $this->getDoctrine()->getManager();      
        $sn -> persist($message);
        $sn -> flush();
        $smessage = $this->makeSwiftMessage($message);
        $this->get('mailer')->send($smessage);
    } 
    
    
        function captchaverify($recaptcha){
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                "secret"=>"6Lc9JZgUAAAAANOmpl0z2xPNHMQrtVfge1ve9xxM","response"=>$recaptcha));
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);     
        
       // return $data->success;   
          return true;
    }
}
