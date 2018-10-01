<?php
// src/Controller/PersonController.php
namespace AppBundle\Controller;

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

use AppBundle\Form\PersonFormType;
use AppBundle\Entity\Person;
use AppBundle\Entity\location;
use AppBundle\Entity\Event;
use AppBundle\Entity\Text;
use AppBundle\Controller\LinkrefController;
use AppBundle\Service\MyLibrary;
use AppBundle\Service\FLSASImage;
use AppBundle\MyClasses\eventTree;
use AppBundle\MyClasses\eventTreeNode;


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
        $people = $this->getDoctrine()->getRepository("AppBundle:Person")->findAll();
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
        $people = $this->getDoctrine()->getRepository("AppBundle:Person")->findAll();
        
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
        $person = $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
        $person->link = "/".$this->lang."/person/".$person->getPersonid();
        if (!$person) 
        {
            return $this->render('person/showone.html.twig', [ 'lang'=>$this->lang,  'message' =>  'Person '.$pid.' not Found',]);
        }
        
        $text_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("person",$pid);
        $textcomment = $lib->selectText($text_ar,"comment",$this->lang);
       
        
        $participations = $this->getDoctrine()->getRepository("AppBundle:Participant")->findParticipations($pid);
        $pevents = array();
        
        $i=0;
        foreach($participations as $participation)
        {
           $ppid = $participation->getEventid();
           $pevents[$i] = $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($ppid);
            $parents= $pevents[$i]->ancestors;
            if(count($parents))
            {
               $l = count($parents);
               for($ip=0; $ip<$l;$ip++)
               {
                 $psid = $parents[$ip]->getEventid();
                 $ptext_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("event",$psid);
                 //echo("=+=+=".$this->lang);
                 $parents[$ip]->title= $lib->selectText( $ptext_ar,"title",$this->lang);
                 $parents[$ip]->link = "/".$this->lang."/event/".$psid;
               }
            $pevents[$i]->ancestors =$parents;
          }
           $etexts_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("event",$ppid);
           $pevents[$i]->title = $this->mylib->selectText($etexts_ar,'title',$this->lang);
          if(   $pevents[$i]->title ==null) $pevents[$i]->title = "pas trouver";
            $pevents[$i]->link = "/".$this->lang."/event/".$ppid;
           $i++;
        }
        $topevent =  $this->getDoctrine()->getRepository("AppBundle:Event")->findTop();
        $topevent->title = " TOP ".  $topevent->getLabel();
        $topevent->link = "/".$this->lang."/event/".$topevent->getEventid();
        $evt = new eventTree($topevent);
        $evt->buildTree($pevents);
        $ref_ar = $this->getDoctrine()->getRepository("AppBundle:Imageref")->findGroup("person",$pid);
        $images= array();
        $i=0;
        foreach($ref_ar as $key => $ref)
        {
           $imageid = $ref_ar[$key]['imageid'];
           $image = $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($imageid);
        
           if($image)
           {
              $this->mylib->setFullpath($image);
           $text_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup("image",$imageid);
           $images[$i]['fullpath']= $image->fullpath;
           $images[$i]['title'] = $lib->selectText($text_ar,'title',$this->lang);
           $images[$i]['link'] = "/".$this->lang."/image/".$imageid;
           $i++;
           }
        }
        $incidents =  $this->getDoctrine()->getRepository("AppBundle:Incident")->seekByPerson($pid);
        foreach( $incidents as $key=>$incident )
        {
           $incidents[$key]['label'] = $this->formatIncident($incident);
           $incidents[$key]['link'] =  "/".$this->lang."/incident/".$incident['incidentid'];
        }
        $mess = '';
        
       // $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup("person",$pid);
        
        $refs = $this->get('linkref_service')->getLinks("person",$pid);
        
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
         $location =   $this->getDoctrine()->getRepository("AppBundle:Location")->findOne($lid);
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
    
    public function addbookmark($pid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $this->bookmark($pid);
        return $this->redirect('/admin/person/'.$pid);
       
    }
    
    public function addUserbookmark($pid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $this->bookmark($pid);
        return $this->redirect("/".$this->lang.'/person/'.$pid);
    }
    
    
    private function bookmark($pid)
    {
       
        $person =  $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $plist = $session->get('personList');
        if($plist == null)
        {
            $plist = array();
        }
        if( !array_key_exists ( $pid , $plist))
        {
            $newperson = array();
            $newperson['id'] = $pid;
            $newperson["label"]= $person->getFullname();
            $plist[$pid] = $newperson;
            $session->set('personList', $plist);
        }
    }
}
