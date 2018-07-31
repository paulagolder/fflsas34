<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;


use App\Forms\LocationForm;

use App\Service\MyLibrary;
use App\Entity\Location;

class LocationController extends Controller
{


    private $lang="FR";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;;
    }


    /**
     *
     */
    public function index()
    {
        return $this->render('Location/index.html.twig', [
            'controller_name' => 'LocationController',
        ]);
    }
    
    /**
     * 
     */    
   public function Showall()
   {
      $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
      $Locations = $this->getDoctrine()->getRepository("App:Location")->findAll();
      if (!$Locations) {
         return $this->render('Location/showall.html.twig', 
         [ 
           'lang'=>$this->lang,
           'message' =>  'Locations not Found',
         ]);
      }
   
      return $this->render('Location/showall.html.twig', 
          [ 
          'lang'=>$this->lang,
          'message' =>  '',
          'heading' =>  'all locations('.count($Locations).')',
          'locations'=> $Locations,
          ]);

   }

   public function Showtop()
     {
         $world  = $this->getDoctrine()->getRepository("App:Location")->findTop();
         return $this->Showone($world->getLocid());
     }
   
    public function Edittop()
     {
         $world  = $this->getDoctrine()->getRepository("App:Location")->findTop();
         return $this->Editone($world->getLocid());
     }
   
   
   
    public function Showone($lid)
     {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $location = $this->getDoctrine()->getRepository("App:Location")->findOne($lid);
         if (!$location) 
         {
             return $this->render('location/showone.html.twig', [ 'message' =>  'location '+$lid+' not Found',]);
         }
     
     
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("location",$lid);
        
        $parents= $location->ancestors;
        if(count($parents))
        {
            $l = count($parents);
            $z=5;
            for($i=0; $i<$l;$i++)
            {
              $pid = $parents[$i]['id'];
              $url = "/".$this->lang."/location/".$pid;
              $parents[$i]['link'] =  $url ;
              $z++;
            }
            $location->ancestors =$parents;
              if($location->getZoom() <1)
            {
               $location->setZoom($z);
            }
           
        }
        
        $children =  $location->children;
        if(count($children))
        {
           $l = count($children);
           for($i=0; $i<$l;$i++)
           {
             $pid = $children[$i]['id'];
             $url = "/".$this->lang."/location/".$pid;
             $children[$i]['link'] =  $url ;
           }
           $location->children = $children;
        }
        
        if(isset($text_ar["comment"]) ) $textcomment = $text_ar["comment"];
        else  $textcomment = null;
        
        $map = null;
        $eventlocs=$this->getDoctrine()->getRepository("App:Event")->findLocations($lid);
        foreach( $eventlocs as $key =>$event )
        {
         $event->link = "/".$this->lang."/event/".$event->getEventid();
        }
        $incidentlocs=$this->getDoctrine()->getRepository("App:Incident")->findLocations($lid);
        foreach( $incidentlocs as $key =>$incident )
        {
         $incident->link = "/".$this->lang."/person/".$incident->getPersonid();
         $incident->label= $this->getDoctrine()->getRepository("App:Person")->getLabel($incident->getPersonid());
        }
        return $this->render('location/showone.html.twig', 
             [ 
             'lang'=>$this->lang,
             'message' =>  '',
             'heading' =>  'location '.$lid.' found',
             'location'=> $location,
             'texts'=> $textcomment,
             'personlocs'=>$incidentlocs,
             'eventlocs'=>$eventlocs,
              'map'=>$map,              
              ]);
        
     }
     
     public function Editone($lid)
     {
  
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
         $location = $this->getDoctrine()->getRepository("App:Location")->findOne($lid);
         if (!$location) 
         {
             return $this->render('location/editone.html.twig', [ 'message' =>  'location '+$lid+' not Found',]);
         }
     
     
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("location",$lid);
        
        $parents= $location->ancestors;
        if(count($parents))
        {
            $l = count($parents);
            $z = 15;
            for($i=0; $i<$l;$i++)
            {
              $pid = $parents[$i]['id'];
              $url = "/admin/location/".$pid;
              $parents[$i]['link'] =  $url ;
              $z--;
            }
            $location->ancestors =$parents;
            if($location->getZoom() <1)
            {
               $location->setZoom( $z);
            }
            //echo("ZOOM".$location->zoom );
        }
        
        $children =  $location->children;
        if(count($children))
        {
           $l = count($children);
           for($i=0; $i<$l;$i++)
           {
             $pid = $children[$i]['id'];
             $url = "/admin/location/".$pid;
             $children[$i]['link'] =  $url ;
           }
           $location->children = $children;
        }
        
        if(isset($text_ar["comment"]) ) $textcomment = $text_ar["comment"];
        else  $textcomment = null;
        
        $map = null;
        
        
        return $this->render('location/editone.html.twig', 
             [ 
             'lang'=>$this->lang,
             'message' =>  '',
             'heading' =>  'location '.$lid.' found',
             'location'=> $location,
             'source'=>'/admin/location/'.$lid,
             'texts'=> $textcomment,
              'map'=>$map,              
              ]);
        
     }
     
      public function edit($lid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($lid>0)
        {
            $location = $this->getDoctrine()->getRepository('App:Location')->findOne($lid);
            $region = $this->getDoctrine()->getRepository('App:Location')->findOne($location->getRegion());
        }
        if(! isset($location))
        {
            $location = new Location();
        }
        $form = $this->createForm(LocationForm::class, $location);
        
        if ($request->getMethod() == 'POST') 
        {
          
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirect("/admin/location/".$lid);
            }
        }
        
        return $this->render('location/edit.html.twig', array(
            'form' => $form->createView(),
            'regionname'=>$region->getName(),
            'location'=>$location,
            'objid'=>$lid,
            'returnlink'=>'/admin/location/'.$lid,
            ));
    }
    
    
      public function new($rid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($rid>0)
        {
            $region = $this->getDoctrine()->getRepository('App:Location')->findOne($rid);
        }
     
            $location = new Location();
            $location->setRegion($rid);
            $location->setLatitude( 46.63874 );
             $location->setLongitude(4.86918);
        $form = $this->createForm(LocationForm::class, $location);
        
        if ($request->getMethod() == 'POST') 
        {
          
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirect("/admin/location/".$rid);
            }
        }
        
        return $this->render('Location/edit.html.twig', array(
            'form' => $form->createView(),
            'regionname'=>$region->getName(),
            'location'=>$location,
            'returnlink'=>'/admin/location/'.$rid,
            ));
    }
    
      public function addbookmark($lid)
    {
        $location =  $this->getDoctrine()->getRepository("App:Location")->findOne($lid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $llist = $session->get('locationList');
        if($llist == null)
        {
          $llist = array();
        }
        $newloc = array();
        $newloc['id'] = $lid;
        $newloc["label"]= $location->getName();
        array_push($llist, $newloc);
        $session->set('locationList', $llist);
        
        return $this->redirect('/admin/location/'.$lid);
        
    }
}
