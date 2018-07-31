<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RequestStack;

use App\Forms\EventFormType;
use App\Service\MyLibrary;
use App\Entity\event;
use App\Entity\person;
use App\Entity\Imageref;
use App\Entity\Linkref;
use App\Entity\Participant;


class AdminEventController extends Controller
{

    private $lang="fr";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;;
    }

  
    public function index()
     {
         return $this->render('events/index.html.twig', [
         'controller_name' => 'EventController',
         ]);
     }
     
    
     
     public function Showall()
     {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $Events = $this->getDoctrine()->getRepository("App:Event")->findAll();
     if (!$Events) 
     {
         return $this->render('events/showall.html.twig', [ 'message' =>  'Events not Found',]);
     }
     
     
     return $this->render('events/adminshowall.html.twig',
                         [
                            'lang' => $this->lang,
                            'message' =>  '',
                            'heading' =>  'all Events ('.count($Events).')',
                            'events'=> $Events,]);
     
     }
     
     public function Editone($eid)
     {
         $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $lib = $this->mylib;
         $event = $this->getDoctrine()->getRepository("App:Event")->findOne($eid);
         
         if (!$event) 
         {
             return $this->render('events/showone.html.twig', 
             [ 
               'lang' => $this->lang,
               'message' =>  'Event '.$eid.' not Found',
            ]);
         }
     
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$eid);
        $event->title = $lib->selectText($text_ar, "title",$this->lang);
       
        $parents= $event->ancestors;
        if(count($parents))
        {
            $l = count($parents);
            for($i=0; $i<$l;$i++)
            {
              $pid = $parents[$i]->getEventid();
              $ptext_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$pid);
              $parents[$i]->title = $lib->selectText( $ptext_ar,"title",$this->lang);
              $url = "/admin/event/".$pid;
              $parents[$i]->link =  $url ;
            }
            $event->ancestors =$parents;
        }

        $sdate = $event->getStartdate();
        if($sdate)
        {
          $sdate = $this->mylib->formatdate($sdate,$this->lang);
          $event->setStartdate( $sdate);
        }
         $edate = $event->getEnddate();
         if($edate)
        {
          $edate = $this->mylib->formatdate($edate,$this->lang);
          $event->setEnddate( $edate);
        }
        
      
        $children =  $event->children;
        if(count($children))
        {
           $l = count($children);
           for($i=0; $i<$l;$i++)
           {
          
             $pid = $children[$i]['id'];
             $child =  $this->getDoctrine()->getRepository("App:Event")->findOne($pid);
        
             $children[$i]['startdate'] = $child->getStartdate();
               $children[$i]['fstartdate'] = $lib->formatdate($child->getStartdate(),$this->lang);
                 
             $ptext_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$pid);
      
             $children[$i]['title'] =  $this->mylib->selectText($ptext_ar, "title", $this->lang );
          
             if( $children[$i]['title'] =='')  $children[$i]['title']=$child->getLabel();
             $url = "/admin/event/".$pid;
             $children[$i]['link'] =  $url ;

           }
           usort($children, function ($item1, $item2) {return $item1 <=> $item2;});
            usort($children, function ($item1, $item2) {return $item1['startdate'] <=> $item2['startdate'];});

           $event->children = $children;
        }
        
        // this is a fix because title gets changed  and I cannot find out why 
              $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$eid);
        $texttitle = $lib->selectText($text_ar, "title",$this->lang);
        $event->title = $texttitle;
         if($event->title == "")
        {
          $event->title = $event->getLabel();
        }
      
        $textcomment =  $lib->selectText($text_ar, "comment",$this->lang);
        
         $ref_ar = $this->getDoctrine()->getRepository("App:Imageref")->findGroup("event",$eid);
        $images= array();
        $i=0;
        foreach($ref_ar as $key => $ref)
        {
           $imageid = $ref_ar[$key]['imageid'];
           $images[$i]['imageid']= $imageid;
           $images[$i]['refid']= $ref_ar[$key]['id'];
           $image = $this->getDoctrine()->getRepository("App:Image")->findOne($imageid);
           $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("image",$imageid);
           $images[$i]['fullpath']= $image->fullpath;
           $images[$i]['title'] = $this->mylib ->selectText($text_ar,'title',$this->lang);
           $images[$i]['link'] = "/admin/image/".$imageid;
           $i++;
        }
        $participations = $this->getDoctrine()->getRepository("App:Participant")->findParticipants($eid);
        $participants = array();
        foreach($participations as $key=>$aparticipant)
        {
            $participants[$key]['label'] = $aparticipant['label'];;
            $participants[$key]['link'] = "/admin/person/".$aparticipant['personid'];
        }
       
       if($event->getLocid())
       {
         $location = $this->getDoctrine()->getRepository("App:Location")->findOne($event->getLocid());
         $event->location['name'] = $location->getName();
         $event->location['link'] = "/admin/location/".$location->getLocid();
       }
        
        $linkrefs =$this->getDoctrine()->getRepository("App:Linkref")->findGroup('event',$eid);
        
        return $this->render('events/editone.html.twig', [ 
             'lang' => $this->lang,
             'message' =>  '',
             'heading' =>  'Event '.$eid.' found',
             'event'=> $event,
              'title'=> $texttitle,
             'text'=> $textcomment,
             'images'=>$images,
             'refs'=>$linkrefs,
             'participants' => $participants,
              'source'=>"/admin/event/".$eid,
               'objid'=>$eid,   
               'returnlink'=> "/".$this->lang."/event/".$eid,
              ]);
        
     }
     
     
    
     
  
     public function Showtop()
     {
         $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $topevent  = $this->getDoctrine()->getRepository("App:Event")->findTop();
         return $this->Editparticipants($topevent->getEventId());
     }
    
      public function editdetail($eid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($eid>0)
        {
            $event = $this->getDoctrine()->getRepository('App:Event')->findOne($eid);
        }
        if(! isset($event))
        {
            $eid = -$eid;
            $event = new Event();
            $event-> setParent( $eid );
        }
        $form = $this->createForm(EventFormType::class, $event);
        
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($event);
                $entityManager->flush();
                return $this->redirect("/admin/event/".$eid);
            }
        }
        
        return $this->render('events/editdetail.html.twig', array(
            'form' => $form->createView(),
            'objid'=>$eid,
            'returnlink'=>'/admin/event/'.$eid,
            'source'=>'/admin/event/'.$eid,
            ));
    }
   
    public function addbookmark($eid)
    {
        $event =  $this->getDoctrine()->getRepository("App:Event")->findOne($eid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $elist = $session->get('eventList');
        if($elist == null)
        {
          $elist = array();
        }

       if( !array_key_exists ( $eid , $elist))
       {
        $newev = array();
        $newev['id'] = $eid;
        $newev["label"]= $event->getLabel();
        $elist[$eid] = $newev;
         $session->set('eventList', $elist);
       }
     
        return $this->redirect('/admin/event/'.$eid);
        
    }
     
     
     public function addimage($eid,$iid)
    {
        $imageref =  $this->getDoctrine()->getRepository("App:Imageref")->findMatch("event",$eid,$iid);
        if(!$imageref)
        {
        $em = $this->getDoctrine()->getManager();
        $newp = new Imageref();
        $newp->setObjid((int)$eid);
        $newp->setImageid((int)$iid);
        $newp->setObjecttype('event');
        $em->persist($newp);
        $em->flush();
        }
        return $this->redirect('/admin/event/'.$eid);
        
    }
    
    public function addContent($eid,$cid)
    {
   
        $em = $this->getDoctrine()->getManager();
        $newp = new Linkref();
        $newp->setObjid((int)$eid);
        $newp->setpath("/content/".$cid);
        $newp->setObjecttype('event');
          $newp->setLabel('Content:'.$cid);
        $em->persist($newp);
        $em->flush();
        return $this->redirect('/admin/event/'.$eid);
        
    }
    
    public function addparticipant($eid,$pid)
    {
        $user = $this->getUser();
        $time = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $participations =  $this->getDoctrine()->getRepository("App:Participant")->findParticipationsbyEntityPerson($eid,$pid);
       if(!count($participations)>0)
       {
        $newp = new Participants();
        $newp->setEventid((int)$eid);
        $newp->setPersonid((int)$pid);
        $newp->setContributor($user->getUsername());
        $newp->setUpdateDt($time);
        $em->persist($newp);
        $em->flush();
      
        }
        return $this->redirect('/admin/event/'.$eid);
        
    }
    
      public function setlocation($eid,$lid)
    {
       $user = $this->getUser();
        $time = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $event =  $this->getDoctrine()->getRepository("App:Event")->findOne($eid);
        $event->setLocid((int)$lid);
         $event->setContributor($user->getUsername());
         $event->setUpdateDt($time);
        $em->persist($event);
        $em->flush();

        return $this->redirect('/admin/event/'.$eid);
        
    }
    
    
      public function removeimageref($eid,$irid)
    {
     $image = $this->getDoctrine()->getRepository("App:Imageref")->findOne($irid);
     $em = $this->getDoctrine()->getManager();
      $em->remove($image);
     $em->flush();
        return $this->redirect('/admin/event/'.$eid);
        
    }
}
