<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;
use Symfony\Component\HttpFoundation\RedirectResponse;


use AppBundle\Entity\Biblo;
use AppBundle\Entity\Image;
use AppBundle\Entity\ImageRef;

use AppBundle\Form\BibloForm;
use AppBundle\Service\MyLibrary;


class BibloController extends Controller
{
    
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    

    
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    
    public function xShowall()
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $fbooks = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findAll();
        if (!$fbooks) {
            return $this->render('biblo/showall.html.twig', [ 'message' =>  'Books not Found',]);
        }        
        foreach($fbooks as $fuser)
        {
            $fuser->link = "/admin/biblo/".$fuser->getBookId();
        }
        return $this->render('biblo/showall.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'biblos',
        'books'=> $fbooks,
        ]);
    }
    
      public function Showall()
    { 
        $biblogroups = array();
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $biblos = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findAll();
        if (!$biblos) {
            return $this->render('biblo/showall.html.twig', [ 'message' =>  'Books not Found',]);
        }        
        foreach($biblos as $biblo)
        {
           $tag = $biblo->getTags();
           if(! array_key_exists($tag,$biblogroups))
           {
            $biblogroups[$tag] = array();
           }
           $biblogroups[$tag][$biblo->getBookId()]=$biblo;
            #$fuser->link = "/admin/url/".$fuser->getId();
        }
        return $this->render('biblo/showall.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'Browsing books',
        'groups'=> $biblogroups,
        ]);
    }
    
     public function Showone ($bid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $lib = $this->mylib;
        $book = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        $ref_ar = $this->getDoctrine()->getRepository("AppBundle:Imageref")->findGroup("biblo",$bid);
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
                $images[$i]['rotation']= $image->getRotation();
                $images[$i]['title'] = $lib->selectText($text_ar,'title',$this->lang);
                $images[$i]['link'] = "/".$this->lang."/image/".$imageid;
                $i++;
            }

        }
        
        return $this->render('biblo/showone.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'book',
        'book'=> $book,
        'images'=>$images,
        ]);
    }
    
    
      public function edit ($bkid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $lib = $this->mylib;
        $book = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bkid);
        $ref_ar = $this->getDoctrine()->getRepository("AppBundle:Imageref")->findGroup("biblo",$bkid);
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
                $images[$i]['imageid']= $imageid;
                $images[$i]['rotation']= $image->getRotation();
                $images[$i]['fullpath']= $image->fullpath;
                $images[$i]['title'] = $lib->selectText($text_ar,'title',$this->lang);
                $images[$i]['link'] = "/".$this->lang."/image/".$imageid;
                $i++;
            }

        }
        
        return $this->render('biblo/edit.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'book',
        'book'=> $book,
        'images'=>$images,
        ]);
    }
    
     public function Delete($bkid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $this->getDoctrine()->getRepository("AppBundle:Biblo")->delete($bkid);
    
       
         return $this->redirect("/admin/biblo/search");
    }
    
    
     public function visit($bkid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $furl = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bkid);
        return $this->redirect("/".$this->lang.'/url/show/'.$bkid);
    }
    
      public function editdetail($bkid)
    {
         $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $request = $this->requestStack->getCurrentRequest();
        $linkref=null;
        if($bkid>0)
        {
            $biblo= $this->getDoctrine()->getRepository('AppBundle:Biblo')->findOne($bkid);
        }
        if(! isset($biblo))
        {
            $biblo= new Biblo();
        }
       
        $form = $this->createForm(BibloForm::class, $biblo);

        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($biblo);
                $entityManager->flush();
                $bkid = $biblo->getBookId();
                return $this->redirect('/admin/biblo/edit/'.$bkid );
                
            }
        }
        
        return $this->render('biblo/editdetail.html.twig', array(
            'form' => $form->createView(),
            'message' =>  '',
            'biblo' => $biblo,
            'returnlink'=>'/'.$this->lang.'/biblo/edit/'.$bkid    ///admin/linkref/event/272/8
            ));
    }
    
    public function BibloSearch(Request $request)
    {
        $message="";
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $pfield = $request->query->get('searchfield');
        $gfield = $request->query->get('searchfield');
        
        if (!$pfield) 
        {
            $biblos = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findAll();
            $subheading =  'found.all';
        }
        else
        {
            $pfield = "%".$pfield."%";
            $biblos = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findSearch($pfield);
            $subheading =  'found.with';
        }
        
        
        if (count($biblos)<1) 
        {
             $subheading = 'nothing.found.for';
        }
        else
        {
            foreach($biblos as $biblo)
            {
                $biblo->link = "/admin/biblo/addbookmark/".$biblo->getBookId();
            }
            
        }
        
        
        return $this->render('biblo/biblosearch.html.twig', 
        [ 
        'lang'=>$this->lang,
        'message' => $message,
        'heading' =>  'Gestion des Livres',
        'subheading' =>  $subheading,
        'searchfield' =>$gfield,
        'contents'=> $biblos,
        
        ]);
    }
    
    public function addBookmark($bid)
    {
        //$gfield = $request->query->get('searchfield');
        $biblo =  $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('bibloList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newbiblo = array();
        $newbiblo['id'] = $bid;
        $newbiblo["label"]= $biblo->getTitle();
        $ilist[$bid]= $newbiblo;
        $session->set('bibloList', $ilist);
        return $this->redirect("/admin/biblo/search");
       // return $this->redirect("/admin/biblo/search?searchfield=".$gfield);
    }
    
    public function addUserBookmark($bid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $biblo =  $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('bibloList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newbiblo = array();
        $newbiblo['id'] = $bid;
        $newbiblo["label"]= $biblo->getTitle();
        $ilist[$bid]= $newbiblo;
        $session->set('bibloList', $ilist);
        
        return $this->redirect("/".$this->lang."/biblo/show/all");
    }
   
     public function addimageref($bid,$iid)
    {
       $lref = $this->getDoctrine()->getRepository('AppBundle:Imageref')->findMatch('biblo',$bid,$iid);
       if(!$lref)
       {
        $imageref = new Imageref();
        $imageref->setImageid($iid);
        $imageref->setObjecttype("biblo");
        $imageref->setObjid($bid);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($imageref);
        $entityManager->flush();
        }
        return $this->redirect("/fr/biblo/".$bid);
    }
   
    public function removeimageref($bid,$iid)
    {
     $iref = $this->getDoctrine()->getRepository('AppBundle:Imageref')->findMatch('biblo',$bid,$iid);
     $em = $this->getDoctrine()->getManager();
      $em->remove($iref);
     $em->flush();
        return $this->redirect('/fr/biblo/'.$bid);
    }
    
}
