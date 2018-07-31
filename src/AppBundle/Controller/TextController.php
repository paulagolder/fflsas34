<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;

use App\Entity\event;
use App\Entity\Text;
use App\Entity\person;
use App\Service\MyLibrary;
use App\Forms\TextForm;

class TextController extends Controller
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
        return $this->render('text/index.html.twig', [
        'controller_name' => 'TextController',
        ]);
    }
    
    
    
    public function Showall()
    {
        $Texts = $this->getDoctrine()->getRepository("App:Text")->findAll();
        if (!$Texts) {
            return $this->render('text/showall.html.twig', [ 'message' =>  'Texts not Found',]);
        }
        
        return $this->render('text/showall.html.twig', [ 'message' =>  '','heading' =>  'all Texts ('.count($Texts).')','texts'=> $Texts,]);
        
    }
    
    
    public function Showgroup()
    {
        $Texts = $this->getDoctrine()->getRepository("App:Text")->findGroup("person",674);
        if (!$Texts) {
            return $this->render('text/showall.html.twig', [ 'message' =>  'Texts not Found',]);
        }
        return $this->render('text/showall.html.twig', [ 'message' =>  '','heading' =>  'all Texts ('.count($Texts).')','texts'=> $Texts,]);
        
    }
    
    public function editperson($pid)
    {
        $person = $this->getDoctrine()->getRepository("App:Person")->findOne($pid);
        $personname = $person->getFullname();
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("person",$pid);
        

        return $this->render('text/editdetail.html.twig', [ 
        'message' =>  '',
        'heading' =>  'edit.texts',
        'label' => $personname,
        'texts'=> $text_ar,
        'attributes'=> ['comment'],
        'objecttype'=>'person',
        'objid'=>$pid,
        'returnlink'=>"/admin/person/".$pid,
        ]);
        
    }
    
    public function editevent($eid)
    {
        $event = $this->getDoctrine()->getRepository("App:Event")->findOne($eid);
        $label = $event->getLabel();
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("event",$eid);
        
        return $this->render('text/editdetail.html.twig', [ 
        'message' =>  '',
        'heading' =>  'edit.texts',
        'label' => $label,
        'texts'=> $text_ar,
        'attributes'=> ['title','comment'],
        'objecttype'=>'event',
        'objid'=>$eid,
        'returnlink'=>"/admin/event/".$eid,
        ]);
        
    }
    
    
    public function editimage($iid)
    {
        $image = $this->getDoctrine()->getRepository("App:Image")->findOne($iid);
        $imagename = $image->getName();
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("image",$iid);
        
        return $this->render('text/editdetail.html.twig', [ 
        'message' =>  '',
        'heading' =>  'edit.texts',
        'label' => $imagename,
        'texts'=> $text_ar,
        'attributes'=> ['title','comment'],
        'objecttype'=>'image',
        'objid'=>$iid,
        'returnlink'=>"/admin/image/".$iid,
        ]);
        
    }
    
    
    public function editreflink($rfid)
    {
        $ref = $this->getDoctrine()->getRepository("App:reflink")->findOne($rfid);
        $refname = $ref->getName();
        $text_ar = $this->getDoctrine()->getRepository("App:Text")->findGroup("reflink",$rfid);
        
        return $this->render('text/editdetail.html.twig', [ 
        'message' =>  '','heading' =>  'edit.texts',
        'label' => $refname,
        'texts'=> $text_ar,
        'attributes'=> ['title','comment'],
        'objecttype'=>'image',
        'objid'=>$rfid,
        'returnlink'=>"/admin/reflink/".$rfid,
        ]);
        
    }
    
    
    
    public function editone($objecttype,$objid,$attribute, $language)
    {   
        
        $language = strtoupper($language);
        switch ($objecttype) 
        {
            case "person":
                $person = $this->getDoctrine()->getRepository('App:Person')->findOne($objid);
                $label = $person->getFullname();
                break;
            case "event":
                $event = $this->getDoctrine()->getRepository('App:Event')->findOne($objid);
                $label = $event->getLabel();
                break;
            case "image":
                  $image = $this->getDoctrine()->getRepository('App:Image')->findOne($objid);
                $label = $image->getName();
                break;
            case "linkref":
                $ref = $this->getDoctrine()->getRepository('App:Linkref')->findOne($objid);
                $label = $ref->getLabel();
                break;
            default:
                return $this->redirect("/admin/text/".$objecttype."/".$objid);
        }
     
        
        $request = $this->requestStack->getCurrentRequest();
        $text = $this->getDoctrine()->getRepository('App:Text')->findOne($objecttype, $objid,$attribute,$language);
        if($text==null)
        {
            $text = new Texts();
            $text->setObjecttype($objecttype);
            $text->setObjid($objid);
            $text->setAttribute($attribute);
            $text->setLanguage($language);
        }
        $text->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $text->setUpdateDt($now);
      
        $form = $this->createForm(TextForm::class, $text);
        
        if ($request->getMethod() == 'POST') {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($text);
                $entityManager->flush();
                return $this->redirect("/admin/text/".$objecttype."/".$objid);
               
            }
        }
        
        return $this->render('text/update.html.twig', array(
            
            'form' => $form->createView(),
            'label'=> $label,
            'attribute'=> $attribute,
            'language' => $language,
            'objecttype'=>$objecttype,
            'objid'=> $objid,
            'returnlink' => "/admin/text/".$objecttype."/".$objid,
            ));
    }
    
    
}
