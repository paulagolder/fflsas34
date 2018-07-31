<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RequestStack;

use App\Entity\person;
use App\Entity\Participant;
use App\Service\MyLibrary;
use App\Forms\ParticipantForm;


class ParticipantController extends Controller
{
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    
    public function index()
    {
        return $this->render('participants/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }
    
    public function Showall()
    {
        $participations = $this->getDoctrine()->getRepository("App:Participant")->findAll();
        
        if (!$participations) {
            return $this->render('participants/showall.html.twig', [ 'message' =>  'participations not Found',]);
        }
        
        return $this->render('participants/showall.html.twig',
        [ 'message' =>  '',
          'heading' =>  'all participations ('.count($participations).')',
          'participations'=> $participations,
          ]);
    }
    
    public function Showone($pid)
    {
        $participant = $this->getDoctrine()->getRepository("App:Participant")->findOne($pid);
        if (!$participant) 
        {
            return $this->render('participants/showone.html.twig', [ 'message' =>  'participant '.$pid.' not Found',]);
        }
        
        return $this->render('participants/showone.html.twig', [ 'message' =>  '','heading' =>  'one participant ('.$pid.')','participant'=> $participant, ]);
    }
    
    
     public function edit($ptid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($ptid>0)
        {
            $participation = $this->getDoctrine()->getRepository('App:Participant')->findOne($ptid);
        }
        if(! isset($participation))
        {
            $$participation = new Participants();
        }
        $form = $this->createForm(ParticipantForm::class, $participation);
        
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($participation);
                $entityManager->flush();
                $pid = $form["personid"]->getData();
                return $this->redirect("/admin/person/".$pid);
            }
        }
   
         $pid = $form["personid"]->getData();
         $eid = $form["eventid"]->getData();
         $incidents=   $this->getDoctrine()->getRepository("App:Incident")->findbyParticipation($eid,$pid);
         $person =   $this->getDoctrine()->getRepository("App:Person")->findOne($pid);
         $event =   $this->getDoctrine()->getRepository("App:Event")->findOne($eid);
             return $this->render('participants/edit.html.twig', array(
            'form' => $form->createView(),
            'eventlabel'=>$event->getLabel(),
            'personname'=> $person->getFullname(),
            'personid'=>$pid,
            'eventid'=>$eid,
            'incidents'=>$incidents,
            'returnlink'=>'/admin/person/' .$pid,
            ));
    }
    
    
   
    
    
    
    public function addParticipant($eid,$pid)
    {
     $em = $this->getDoctrine()->getManager();

        $newp = new Participants();
        $newp->setEventid($eid);
        $newp->setPersonid($pid);
        $em->persist($newp);
        $em->flush();
        return $this->redirect("/admin/event/participant/".$eid);
    }
    
}
