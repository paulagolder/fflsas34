<?php
// src/Controller/PersonController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

use App\Forms\PersonFormType;
use App\Entity\Person;
use App\Entity\Location;
use App\Entity\Event;
use App\Entity\Text;
use App\Service\MyLibrary;
use App\MyClasses\eventTree;
use App\MyClasses\eventTreeNode;


class PersonController extends Controller
{
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    private $translator ;

    
   
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack,TranslatorInterface $translator)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $this->translator  =  $translator;
        #$this->translator->setLocale($this->mylib->toLocale($this->lang));
    }
    

    
    public function index()
    {
        return $this->render('person/index.html.twig', [
        'controller_name' => 'personController',
        ]);
    }
    
    
    public function Showall()
    {
       $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $people = $this->getDoctrine()->getRepository("App:Person")->findAll();
        if (!$people) {
            return $this->render('person/showall.html.twig', [ 'message' =>  'People not Found',]);
        }        
        foreach($people as $person)
        {
           $person->link = "/".$this->lang."/person/".$person->getPersonid();
        }
        return $this->render('person/showall.html.twig', 
                              [ 
                                'lang' => $this->lang,
                                'message' =>  '' ,
                                'heading' => 'les.hommes',
                                'people'=> $people,
                                ]);
    }
    
    
    public function Showsidebar()
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $people = $this->getDoctrine()->getRepository("App:Person")->findAll();
        
        if (!$people) {
            return $this->render('person/showsidebar.html.twig', [ 'message' =>  'People not Found',]);
        }        
        foreach($people as $person)
        {
           $person->link = "/".$this->lang."/person/".$person->getPersonid();
        }
        return $this->render('person/showsidebar.html.twig', 
                              [ 
                                'lang' => $this->lang,
                                 'message' =>  '' ,
                                 'heading' =>  'les.hommes',
                                 'people'=> $people,
                                ]);
    }
    
    public function Showone($pid)
    {
        $lib =  $this->mylib ;
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $person = $this->getDoctrine()->getRepository("App:Person")->findOne($pid);
        $person->link = "/".$this->lang."/person/".$person->getPersonid();
        if (!$person) 
        {
            return $this->render('person/showone.html.twig', [ 'lang'=>$this->lang,  'message' =>  'Person '.$pid.' not Found',]);
        }
        
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("person",$pid);
        $textcomment = $lib->selectText($text_ar,"comment",$this->lang);
       
        
        $participations = $this->getDoctrine()->getRepository("App:Participant")->findParticipations($pid);
        $pevents = array();
        
        $i=0;
        foreach($participations as $participation)
        {
           $ppid = $participation->getEventid();
           $pevents[$i] = $this->getDoctrine()->getRepository("App:Event")->findOne($ppid);
            $parents= $pevents[$i]->ancestors;
            if(count($parents))
            {
               $l = count($parents);
               for($ip=0; $ip<$l;$ip++)
               {
                 $psid = $parents[$ip]->getEventid();
                 $ptext_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$psid);
                 //echo("=+=+=".$this->lang);
                 $parents[$ip]->title= $lib->selectText( $ptext_ar,"title",$this->lang);
                 $parents[$ip]->link = "/".$this->lang."/event/".$psid;
               }
            $pevents[$i]->ancestors =$parents;
          }
           $etexts_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$ppid);
           $pevents[$i]->title = $this->mylib->selectText($etexts_ar,'title',$this->lang);
          if(   $pevents[$i]->title ==null) $pevents[$i]->title = "pas trouver";
            $pevents[$i]->link = "/".$this->lang."/event/".$ppid;
           $i++;
        }
        $topevent =  $this->getDoctrine()->getRepository("App:Event")->findTop();
        $topevent->title = " TOP ".  $topevent->getLabel();
        $topevent->link = "/".$this->lang."/event/".$topevent->getEventid();
        $evt = new eventTree($topevent);
        $evt->buildTree($pevents);
        $ref_ar = $this->getDoctrine()->getRepository("App:Imageref")->findGroup("person",$pid);
        $images= array();
        $i=0;
        foreach($ref_ar as $key => $ref)
        {
           $imageid = $ref_ar[$key]['imageid'];
           $image = $this->getDoctrine()->getRepository("App:Image")->findOne($imageid);
           if($image)
           {
           $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("image",$imageid);
           $images[$i]['fullpath']= $image->fullpath;
           $images[$i]['title'] = $lib->selectText($text_ar,'title',$this->lang);
           $images[$i]['link'] = "/".$this->lang."/image/".$imageid;
           $i++;
           }
        }
        $incidents =  $this->getDoctrine()->getRepository("App:Incident")->seekByPerson($pid);
        foreach( $incidents as $key=>$incident )
        {
           $incidents[$key]['label'] = $this->formatIncident($incident);
           $incidents[$key]['link'] =  "/".$this->lang."/incidents/".$incident['incidentid'];
        }
        $mess = '';
        
        $refs = $this->getDoctrine()->getRepository("App:Linkref")->findGroup("person",$pid);
        
        return $this->render('person/showone.html.twig', 
                   [ 'lang' => $this->lang,
                      'message' =>  $mess,
                     'person'=> $person, 
                     'text'=> $textcomment,
                     'images'=> $images,
                     'eventtree'=>$evt,
                     'refs'=>$refs,
                     'incidents'=>$incidents,
                    ]);
    }
    
    public function formatIncident($incident)
    {
      $text = $incident['label'];
      if($incident['locid']>0)
      {
         $at = $this->translator->trans('at.place');
         $lid = $incident['locid'];
         $location =   $this->getDoctrine()->getRepository("App:Location")->findOne($lid);
         $text .= " $at ". $location->getName();
      }
      elseif( $incident['location']!= "")
      {
           $at = $this->translator->trans('at.place');
          $text .= " $at ". $incident['location'];
      }
      if( $incident['sdate'] >0 )
      {
          $on =  $this->translator->trans('on.date');
          $sdate= $incident['sdate'];
          $sdate = $this->mylib->formatdate($sdate,$this->lang);
          $text .= " $on ". $sdate;
      }
      return $text;
    }
}
