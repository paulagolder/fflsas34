<?php
// src/Controller/AdminPersonController.php
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

use App\Forms\PersonForm;
use App\Entity\person;
use App\Entity\Imageref;
use App\Entity\Linkref;
use App\Entity\event;
use App\Entity\Participant;
use App\Service\MyLibrary;
use App\MyClasses\eventTree;
use App\MyClasses\eventTreeNode;


class AdminPersonController extends Controller
{
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    
    
    
    public function index()
    {
        return $this->render('person/index.html.twig', [
        'controller_name' => 'AdminPersonController',
        ]);
    }
    
    
    
    
    public function Editone($pid)
    {
        $lib =  $this->mylib ;
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $person = $this->getDoctrine()->getRepository("App:Person")->findOne($pid);
        
        if (!$person) 
        {
            return $this->render('person/showone.html.twig', [ 'lang'=>$this->lang,  'message' =>  'Person '.$pid.' not Found',]);
        }
        $person->link = "/".$this->lang."/person/".$person->getPersonid();
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("person",$pid);
        $textcomment = $lib->selectText($text_ar,"comment",$this->lang);
        
        
        $participations = $this->getDoctrine()->getRepository("App:Participant")->findParticipations($pid);
        
        
        $i=0;
        $incidents =  $this->getDoctrine()->getRepository("App:Incident")->seekByPerson($pid);
        $participation_ar = array();
        foreach($participations as $participation)
        {
            $ppid = $participation->getEventid();
            $pincidents=array();
            $pi=0;
            foreach( $incidents as $incident)
            {
                if($incident['eventid'] == $ppid)
                {
                    $pincidents[$pi]=$incident; 
                    $pi++;
                }
            }
            if($pi>0)
            {
                $participation_ar[$i]['incidents']=$pincidents;
            }
            else 
            {
                $participation_ar[$i]['incidents'] = null;
            }  
            $participation_ar[$i]['id']= $participation->getparticipationid();
            $participation_ar[$i]['eventid']= $participation->getEventid();
             $participation_ar[$i]['link']= "/admin/participant/".$participation->getparticipationid();
            $label ="";
            $pevents = $this->getDoctrine()->getRepository("App:Event")->findOne($ppid);
            
            $parents= $pevents->ancestors;
            if(count($parents))
            {
                $l = count($parents);
                for($ip=0; $ip<$l && $ip< 1;$ip++)
                {
                    $psid = $parents[$ip]->getEventid();
                    $ptext_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$psid);
                    $label .= $lib->selectText( $ptext_ar,"title",$this->lang).":";
                }
                
            }
            $etexts_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$ppid);
            $label = $this->mylib->selectText($etexts_ar,'title',$this->lang)." : ".$label;
            $participation_ar[$i]['label'] =$label;
            $i++;
        }
        
        
        $ref_ar = $this->getDoctrine()->getRepository("App:Imageref")->findGroup("person",$pid);
        $images= array();
        $i=0;
        foreach($ref_ar as $key => $ref)
        {
            $imageid = $ref_ar[$key]['imageid'];
            $image = $this->getDoctrine()->getRepository("App:Image")->findOne($imageid);
            if($image )
            {
            $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("image",$imageid);
            $images[$i]['imageid']= $imageid;
            $images[$i]['fullpath']= $image->getFullpath();
            $images[$i]['title'] = $lib->selectText($text_ar,'title',$this->lang);
            $images[$i]['link'] = "/admin/image/".$imageid;
            $i++;
            }
        }
        
        $mess = '';
        
        $refs = $this->getDoctrine()->getRepository("App:Linkref")->findGroup("person",$pid);
        #$session = $this->requestStack->getCurrentRequest()->getSession();
       # $imagelist = $session->get('imageList');
        
        
        return $this->render('person/editone.html.twig', 
        [ 'lang' => $this->lang,
        'message' =>  $mess,
        'person'=> $person, 
        'text'=> $textcomment,
        'images'=> $images,
        'participants'=>$participation_ar,
        'refs'=>$refs,
        'returnlink'=>"/".$this->lang."/person/".$pid,
        'source'=>"/admin/person/".$pid,
        ]);
    }
    
    
    public function register(Request $request)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        
        return $this->render(
            'person/register.html.twig',
            array('form' => $form->createView() , 
            'lang'=>$this->lang,
            'returnlink'=>'person/all',
            )
            );
    }
    
    
    public function edit($pid)
    {
        
        $request = $this->requestStack->getCurrentRequest();
        if($pid>0)
        {
            $person = $this->getDoctrine()->getRepository('App:Person')->findOne($pid);
        }
        if(! isset($person))
        {
            $person = new Person();
        }
        $form = $this->createForm(PersonForm::class, $person);
        
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($person);
                $entityManager->flush();
                return $this->redirect("/admin/person/".$pid);
            }
        }
        
        return $this->render('person/edit.html.twig', array(
            'form' => $form->createView(),
            'objid'=>$pid,
            'returnlink'=>'/admin/person/'.$pid,
            ));
    }
    
    public function addbookmark($pid)
    {
        $person =  $this->getDoctrine()->getRepository("App:Person")->findOne($pid);
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
        return $this->redirect('/admin/person/'.$pid);
    }
    
    public function addimage($pid,$iid)
    {
        $imageref = new Imageref();
        $imageref->setImageid($iid);
        $imageref->setObjecttype("person");
        $imageref->setObjid($pid);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($imageref);
        $entityManager->flush();
        return $this->redirect("/admin/person/".$pid);
    }
    
    
    public function addContent($pid,$cid)
    {
        $linkref = new Linkref();
        $linkref->setLabel("content:".$cid);
        $linkref->setPath("content/".$cid);
        $linkref->setObjecttype("person");
        $linkref->setObjid($pid);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($linkref);
        $entityManager->flush();
        return $this->redirect("/admin/person/".$pid);
    }
    
    
    public function removeimage($pid,$iid)
    {
        $this->getDoctrine()->getRepository("App:Imageref")->delete('person',$pid,$iid);
        return $this->redirect("/admin/person/".$pid);
    }
    
    
    
    
    
    public function addevent($pid,$eid)
    {
        $participations =  $this->getDoctrine()->getRepository("App:Participant")->findParticipationsbyEntityPerson($eid, $pid);
        if(count($participations)<1)
        {
        $part = new Participants();
        $part->setEventid((int)$eid);
        $part->setPersonid((int)$pid);
        $part->setNameRecorded(" new name");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($part);
        $entityManager->flush();
        }
        return $this->redirect("/admin/person/".$pid);
    }
    
    
    public function deleteAction($pid,$partid)
    {
        
        $this->getDoctrine()->getRepository("App:Participant")->deleteOne($partid);
        return $this->redirect("/admin/person/".$pid);
    }
}




