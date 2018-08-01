<?php

namespace AppBundle\Controller;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;



use AppBundle\Service\MyLibrary;
use AppBundle\Entity\Linkref;
use AppBundle\Entity\event;
use App\Forms\LinkrefForm;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;

class LinkrefController extends Controller
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
        return $this->render('linkref/index.html.twig', [
            'controller_name' => 'LinkrefController',
        ]);
    }
    
    public function Showall()
    {
        $linkrefs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findAll();
        
        if (!$linkrefs) {
            return $this->render('linkref/showall.html.twig', [ 'message' =>  'Refs not Found',]);
        }

        
        return $this->render('linkref/showall.html.twig', [ 'message' =>  '' ,'heading' =>  'Les Liens','refs'=> $linkrefs,]);
    }
    
     public function Showone($rid)
    {
        $ref = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findOne($rid);
        if (!$ref) 
        {
            return $this->render('linkref/showone.html.twig', [ 'message' =>  'Ref'.$rid.' not Found',]);
        }
        $path = $ref->getPath();
        if( substr($path, 0,7)== "content")
        {
            $pp = explode("/", $path);
            $cid =$pp[1];
            echo("conetent:".$cid);
            $content=  $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
            return $this->render('content/showone.html.twig', 
                  ['lang'=>$this->lang, 
                   'message' =>  '',
                    'content'=>$content,
                    'objid'=>$ref->getObjid(),
                    'refs'=>null,
                    ]);
        
        }
        
        else
        {
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('linkrefs',$rid);
       
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array( 'timeout' => 60,));
         $goutteClient->setClient($guzzleClient);
        $crawler = $goutteClient->request('GET', 'https://github.com/');
       #  return $this->redirect('http://stackoverflow.com');
       return $this->render('linkref/showone.html.twig', 
                  ['lang'=>$this->lang, 
                   'message' =>  '',
                    'texts'=>$text_ar,
                    'display'=>"fred",
                    'ref'=>$ref
                    ]);
                    
        }
    }
    
    
    public function EditPersonGroup($pid)
    {
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('person',$pid);
        $person = $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
        $texts_ar = array();
        foreach( $refs as $ref)
        {
        $texts_ar[$ref['linkid']] =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('linkref',$ref['linkid']);
       
        }
        

        return $this->render('linkref/editgroup.html.twig', 
                   ['lang'=>$this->lang, 
                     'message' =>  '',
                     'label' => $person->getFullname(),
                     'objecttype'=>'person',
                     'objid'=>$pid,
                     'texts'=>$texts_ar,
                     'refs'=>$refs
                     ]);
    }
    
    public function EditEventGroup($eid)
    {
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('event',$eid);
       
        $texts_ar = array();
        foreach( $refs as $ref)
        {
        $texts_ar[$ref['id']] =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('linkrefs',$ref['id']);
       
        }
        

        return $this->render('linkref/editgroup.html.twig', 
                   ['lang'=>$this->lang, 
                     'message' =>  '',
                     'heading' => "all links for event".$eid,
                     'label' => "event:".$eid,
                     'objecttype'=>'event',
                     'objid'=>$eid,
                     'xtexts'=>$texts_ar,
                     'refs'=>$refs
                     ]);
    }
    
     public function Editone($ot,$oid,$lrid)
    {
        $ref = $this->getDoctrine()->getRepository('App:Linkref')->findOne($lrid);
        $texts_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup2('linkref',$lrid);
        return $this->render('linkref/editone.html.twig', 
                   ['lang'=>$this->lang, 
                     'message' =>  '',
                     'heading' => "link id= ".$lrid. " for ".$ot." id=".$oid,
                     'objecttype'=>$ot,
                     'objid'=>$oid,
                     'texts'=>$texts_ar,
                     'ref'=>$ref,
                     'returnlink'=>"/admin/linkref/edit".$ot."/".$oid,
                     ]);
    }
    
    
    
    public function edit($ot,$oid,$lrid)
    {
        $user = $this->getUser();
        $time = new \DateTime();
        $time->setTimestamp($time->getTimestamp());
        
        $request = $this->requestStack->getCurrentRequest();
        $linkref=null;
        if($lrid>0)
        {
            $linkref = $this->getDoctrine()->getRepository('App:Linkref')->findOne($lrid);
        }
        if(! isset($linkref))
        {
            $linkref = new Linkref();
            $linkref->setObjecttype($ot);
            $linkref-> setObjid($oid);
            $linkref->setContributor($user->getUsername());
            $now = new \DateTime();
            $linkref->setUpdateDt($now);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($linkref);
            $entityManager->flush();
            $lrid = $linkref->getLinkId();
        }
        $entity = ucfirst($ot);
        $form = $this->createForm(LinkrefForm::class, $linkref);
         $object =  $this->getDoctrine()->getRepository('App:'.$entity)->findOne($oid);
         $label = $object->getlabel();
        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                // perform some action, such as save the object to the database
                $linkref->setContributor($user->getUsername());
                $now = new \DateTime();
                $linkref->setUpdateDt($now);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($linkref);
                $entityManager->flush();
                return $this->redirect('/admin/linkref/'.$ot."/".$oid. "/".$lrid );
       
            }
        }
        
        return $this->render('linkref/edit.html.twig', array(
            'form' => $form->createView(),
            'message' =>  '',
            'label' => $label,
            'objid'=>$oid,
            'ref' => $linkref,
            'returnlink'=>'/admin/linkref/'.$ot."/".$oid. "/".$lrid   ///admin/linkref/event/272/8
            ));
    }
    
    
    public function delete($ot,$oid,$lrid)
    {
        $this->getDoctrine()->getRepository("AppBundle:Linkref")->deleteOne($lrid);
        return $this->redirect("/admin/linkref/edit".$ot."/".$oid);
    }
}
