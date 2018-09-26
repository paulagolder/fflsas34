<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;

use AppBundle\Entity\Imageref;
use AppBundle\Entity\Image;
use AppBundle\Service\MyLibrary;
use AppBundle\Form\ImageForm;

class ImageController extends Controller
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
        return $this->render('image/index.html.twig', [
        'controller_name' => 'ImageController',
        ]);
    }
    
    
    public function Showall()
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $images = $this->getDoctrine()->getRepository("AppBundle:Image")->findAll();
        
        if (!$images) {
            return $this->render('image/showall.html.twig', [ 'message' =>  'Images not Found',]);
        }
        
        
        return $this->render('image/showall.html.twig', 
        [
        'lang' => $this->lang,
        #'message' =>  '' ,
       # 'heading' =>  'Les Images',
        'images'=> $images,]);
    }
    
    public function Showone($iid)
    {
        $image = $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($iid);
        if (!$image) 
        {
            return $this->render('image/showone.html.twig', [ 'message' =>  'Image '.$iid.' not Found',]);
        }
        
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('image',$iid);
        $title = $this->mylib->selectText($text_ar,'title',$this->lang);
        $comment =  $this->mylib->selectText($text_ar,'comment',$this->lang);
        $refs_ar =  $this->getDoctrine()->getRepository("AppBundle:Imageref")->findAllGroups($iid);
        foreach( $refs_ar as $key=> $refg_ar)
        {
            if($key=="person")
            {
                foreach($refg_ar as $pkey=> $ref_ar)
                {
                    #echo ("person ".$pkey);
                    $person =   $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pkey);
                    $refs_ar[$key][$pkey]['label'] = $person->getFullname();
                    $refs_ar[$key][$pkey]['link'] = "/".$this->lang."/person/".$person->getPersonid();
                }
            }
            else if($key="event")
            {
                foreach($refg_ar as $ekey=> $ref_ar)
                {
                    $event =   $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($ekey);
                    $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('event',$ekey);
                    $rtitle = $this->mylib->selectText($text_ar,'title',$this->lang);
                    $refs_ar[$key][$ekey]['label'] = $rtitle;
                    $refs_ar[$key][$ekey]['link'] = "/".$this->lang."/event/".$event->getEventid();
                }
            }
            else if($key="image")
            {
                foreach($refg_ar as $ikey=> $ref_ar)
                {
                    $image =   $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($ikey);
                    $refs_ar[$key][$ikey]['label'] = $image->title;
                    $refs_ar[$key][$ikey]['link'] = "/".$this->lang."/image/".$image->getImageid();
                }
            }
            else
                echo( "unknown group ");
        }
        
        return $this->render('image/showone.html.twig', 
        ['lang'=>$this->lang, 
        'message' =>  '',
        'image'=> $image,
        'objid' => $iid,
        'title'=>$title,
        'comment' => $comment,
        'refs'=>$refs_ar
        ]);
    }
    
    public function Editone($iid)
    {
        $image = $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($iid);
        if (!$image) 
        {
            return $this->render('image/editone.html.twig', [ 
            'message' =>  'Image '.$iid.' not Found',
            'objid' =>$iid,
            'image'=>null,
            ]);
        }
        
        if(@getimagesize($image->getFullpath()))
        {
            //image exists!
        }else{
            $image->setFullpath($this->getParameter('new_images_folder').$image->getPath());
        }
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('image',$iid);
        $title = $this->mylib->selectText($text_ar,'title',$this->lang);
        $refs_ar =  $this->getDoctrine()->getRepository("AppBundle:Imageref")->findAllGroups($iid);
        foreach( $refs_ar as $key=> $refg_ar)
        {
            #echo ($key);
            if($key=="person")
            {
                foreach($refg_ar as $pkey=> $ref_ar)
                {
                    #echo ("person ".$pkey);
                    $person =   $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pkey);
                    $refs_ar[$key][$pkey]['label'] = $person->getFullname();
                    $refs_ar[$key][$pkey]['link'] = "/admin/person/".$person->getPersonid();
                }
                
            }
            else if($key="event")
            {
                foreach($refg_ar as $ekey=> $ref_ar)
                {
                    # echo ("event ".$ekey);
                    $event =   $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($ekey);
                    $refs_ar[$key][$ekey]['label'] = $event->title;
                    $refs_ar[$key][$ekey]['link'] = "/admin/event/".$event->getEventid();
                }
            }
            else
                echo( "unknown group ");
        }
        
        return $this->render('image/editone.html.twig', 
        ['lang'=>$this->lang, 
        'message' =>  '',
        'objid' => $iid,
        'image'=> $image,
        'title'=>$title,
        'refs'=>$refs_ar
        ]);
    }
    
    public function AdminSearch(Request $request)
    {
        $message="";
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $pfield = $request->query->get('searchfield');
        $gfield = $request->query->get('searchfield');
        
        if (!$pfield) 
        {
            $images = $this->getDoctrine()->getRepository("AppBundle:Image")->findAll();
            $heading =  'trouver.tout';
        }
        else
        {
            $pfield = "%".$pfield."%";
            $images = $this->getDoctrine()->getRepository("AppBundle:Image")->findSearch($pfield);
            $heading =  'trouver.avec';
        }
        
        if (count($images)<1) 
        {
            $message = 'rien.trouver.pour';
        }
        else
        {
            foreach($images as $image)
            {
                $image->link = "/admin/image/addBookmark/".$image->getImageid();
                #$image->setName( "fred"); 
            }
        }
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $imagelist = $session->get('imageList');
        
        return $this->render('image/adminsearch.html.twig', 
        [ 
        'message' => $message,
        'heading' =>  $heading,
        'searchword' =>$gfield,
        'images'=> $images,
        'imagelist' => $imagelist,
        ]);
    }
    
    
    public function addBookmark($iid)
    {
        $image =  $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($iid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('imageList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newimage = array();
        $newimage['id'] = $iid;
        $newimage["label"]= $image->getName();
        $ilist[$iid]= $newimage;
        $session->set('imageList', $ilist);
        
        return $this->redirect("/admin/image/search");
        
    }
    
    public function edit($iid)
    {
        $user = $this->getUser();
        $time = new \DateTime();
        $time->setTimestamp($time->getTimestamp());
        $request = $this->requestStack->getCurrentRequest();
        if($iid>0)
        {
            $image = $this->getDoctrine()->getRepository('AppBundle:Image')->findOne($iid);
        }
        if(! isset($image))
        {
            $image= new Images();
        }
   #     if( $image->getFilepath()!="")
   #     {
   # #        $image->setPath($image->getFilepath());
   #         $image->setFilepath("");
   #         //  $oldfilename = $image->getFilepath();
   #         //  $image->setFilepath( new File("/home/paul/symphony/syfflsas/public/".$this-#>getParameter('new_images_folder').'/'.$oldfilename));
    #    }
        $form = $this->createForm(ImageForm::class, $image);
        
        if ($request->getMethod() == 'POST') 
        {
            
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $image->getFilepath();
                if($file!= null)
                {
                    $formname = $form["name"]->getData();
                    
                    $fileName = $time->format('YmdHis').'.jpeg';
                    
                    if($formname =="")
                    {
                        $image.setFormname($filename);
                    }  
                    $file->move(
                        $this->getParameter('new_images_folder'),
                        $fileName
                        );
                        $image->setPath($fileName);
                        $image->setFilepath($fileName);
                }
                else
                {
                    //     $image->setFilepath($oldfileName);
                    
                }
                
                $image->setContributor($user->getUsername());
                # $image->setUpdateDt($time);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($image);
                $entityManager->flush();
                $niid = $image->getImageid();
                return $this->redirect("/admin/image/".$niid);
            }
        }
        
        return $this->render('image/edit.html.twig', array(
            'form' => $form->createView(),
            'objid'=>$iid,
            'returnlink'=>'/admin/image/'.$iid,
            ));
    }
    
    
    public function addref($otype,$oid,$iid)
    {
        
        $imageref = new Imageref();
        $imageref->setImageid($iid);
        $imageref->setObjecttype($otype);
        $imageref->setObjid((int)$oid);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($imageref);
        $entityManager->flush();
        return $this->redirect("/admin/image/".$iid);
    }
    
}
