<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

use AppBundle\Service\MyLibrary;
use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentType;
use AppBundle\Entity\person;
use AppBundle\Entity\event;
use AppBundle\Form\IncidentFormType;

class IncidentController extends Controller
{



    private $lang="FR";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;;
    }


    public function index()
    {
        return $this->render('incident/index.html.twig', [
            'controller_name' => 'IncidentController',
        ]);
    }
    
    
     public function Showall()
     {
         $lib =  $this->mylib ;
         $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $incidents = $this->getDoctrine()->getRepository("AppBundle:Incident")->findAll();
        if (!$incidents ) 
        {
            return $this->render('incident/showall.html.twig', [ 'message' =>  'Incidents not Found',]);
        }
        foreach($incidents as $key =>$incident)
        {
            $personid = $incident['personid'];
            $person =  $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($personid);
            $personname = Person::fullname($person);;
            $eventid = $incident['eventid'];
           # $test_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("title",$eventid,$this->lang);
              $etext_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("event",$eventid);
                 $etitle= $lib->selectText( $etext_ar,"title",$this->lang);
            $incidents[$key]['label'] = $personname.":".$etitle.":".$incident['typename'];
             $incidents[$key]['link'] ="/admin/incidents/".$incident['incidentid'];
        }
     
        return $this->render('incident/showall.html.twig', 
                  [
                    'lang'=>$this->lang,
                     'message' =>  '',
                     'heading' =>  'all.incidents',
                     'incidents'=> $incidents,
                  ]);
     
     }
     
       public function Showone($inid)
     {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $incident = $this->getDoctrine()->getRepository("AppBundle:Incident")->findOne($inid);
        if (!$incident ) 
        {
            return $this->render('incident/showone.html.twig', 
            [
             'lang'=>$this->lang,
             'message' =>  'Incident '.$inid. ' not Found',
             ]);
        }
        if($incident['sdate']>0)
        {
        $incident['sdate'] = $this->mylib->formatDate($incident['sdate'],$this->lang);
        }
        else
        {
          $incident['sdate'] = "";
        }
        $person =  $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($incident['personid']);
        $event =  $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($incident['eventid']);
        $itype = $this->getDoctrine()->getRepository("AppBundle:IncidentType")->findOne($incident['itypeid']);
        $location = $this->getDoctrine()->getRepository("AppBundle:Location")->findOne($incident['locid']);
        $label = $itype->getLabel();
        return $this->render('incident/showone.html.twig', 
                [ 
                   'lang'=>$this->lang,
                   'message' =>  '',
                   'eventlabel'=>$event->getLabel(),
                   'personname' => $person->getFullname(),
                   'incident'=> $incident,
                   'location'=>$location,
                   'label'=>$label,
                   'returnlink'=>"/".$this->lang."/person/".$person->getPersonid(),
                ]);
     
     }
     
     public function edit($inid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($inid>0)
        {
            $incident_ar = $this->getDoctrine()->getRepository('App:Incident')->findOne($inid);
            $incident = $this->transformtoIncident($incident_ar);
        }
        if(! isset($incident))
        {
            $incident = new Incident();
        }
        $form = $this->createForm(IncidentFormType::class, $incident);
        
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($incident);
                $entityManager->flush();
                return $this->redirect("/admin/incident/".$inid);
            }
        }
         $pid = $form["personid"]->getData();
         $eid = $form["eventid"]->getData();
         $person =   $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
         $event =   $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($eid);
         $incidenttypes =   $this->getDoctrine()->getRepository("AppBundle:IncidentType")->findAll();
         $participations =  $this->getDoctrine()->getRepository("AppBundle:Participant")->findParticipationsbyEntityPerson($eid,$pid);
        return $this->render('incident/edit.html.twig', array(
            'form' => $form->createView(),
            'eventlabel'=>$event->getLabel(),
            'personname'=> $person->getSurname(),
            'itypes'=>$incidenttypes,
            'itypeid'=>$incident->getItypeid(),
            'returnlink'=>'/admin/participant/'.$participations[0]->getParticipationid(),
            ));
    }
    
      public function new($eid,$pid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        
            $incident = new Incident();
            $incident->setEventid($eid);
            $incident->setPersonid($pid);
      
        $form = $this->createForm(IncidentFormType::class, $incident);
        
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($incident);
                $entityManager->flush();
                $inid= $form->submit($request->request->get($form->getId()));
                return $this->redirect("/admin/incidents/".$inid);
            }
        }
         $pid = $form["personid"]->getData();
         $eid = $form["eventid"]->getData();
         $person =   $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
         $event =   $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($eid);
         $incidenttypes =   $this->getDoctrine()->getRepository("AppBundle:IncidentType")->findAll();
        return $this->render('incident/edit.html.twig', array(
            'form' => $form->createView(),
            'eventlabel'=>$event->getLabel(),
            'personname'=> $person->getFullname(),
            'itypes'=>$incidenttypes,
            'returnlink'=>'/admin/person/'.$pid,
            ));
    }
     
     
    function transformtoIncident($incident_ar)
    {
        $incident = new Incident();
        $incident->setEventid($incident_ar['eventid']);
        $incident->setPersonid($incident_ar['personid']);
        $incident->setItypeid($incident_ar['itypeid']);
        $incident->setNamerecorded($incident_ar['name_recorded']);
        $incident->setRank($incident_ar['rank']);
        $incident->setRole($incident_ar['role']);
        $incident->setsdate($incident_ar['sdate']);
        $incident->setEdate($incident_ar['edate']);
        $incident->setSequence($incident_ar['sequence']);
        return $incident;
    
    }
     
     
     
}
