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
        $book = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        
        
        return $this->render('biblo/showone.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'book',
        'book'=> $book,
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
    
      public function edit($bkid)
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
        
        return $this->render('biblo/edit.html.twig', array(
            'form' => $form->createView(),
            'message' =>  '',
            'biblo' => $biblo,
            'returnlink'=>'/'.$this->lang.'/biblo/show'   ///admin/linkref/event/272/8
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
            $contents = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findAll();
            $subheading =  'trouver.tout';
        }
        else
        {
            $pfield = "%".$pfield."%";
            $contents = $this->getDoctrine()->getRepository("AppBundle:Biblo")->findSearch($pfield);
            $subheading =  'trouver.avec';
        }
        
        
        if (count($contents)<1) 
        {
             $subheading = 'rien.trouver.pour';
        }
        else
        {
            foreach($contents as $content)
            {
                $content->link = "/admin/biblo/addbookmark/".$content->getBookId();
            }
            
        }
        
        
        return $this->render('biblo/biblosearch.html.twig', 
        [ 
        'lang'=>$this->lang,
        'message' => $message,
        'heading' =>  'Gestion des Livres',
        'subheading' =>  $subheading,
        'searchfield' =>$gfield,
        'contents'=> $contents,
        
        ]);
    }
    
    public function addBookmark($bid)
    {
        //$gfield = $request->query->get('searchfield');
        $content =  $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('bibloList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newcontent = array();
        $newcontent['id'] = $bid;
        $newcontent["label"]= $content->getTitle();
        $ilist[$bid]= $newcontent;
        $session->set('bibloList', $ilist);
        return $this->redirect("/admin/biblo/search");
       // return $this->redirect("/admin/biblo/search?searchfield=".$gfield);
    }
    
    public function addUserBookmark($bid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $content =  $this->getDoctrine()->getRepository("AppBundle:Biblo")->findOne($bid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('bibloList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newcontent = array();
        $newcontent['id'] = $bid;
        $newcontent["label"]= $content->getTitle();
        $ilist[$bid]= $newcontent;
        $session->set('bibloList', $ilist);
        
        return $this->redirect("/".$this->lang."/biblo/show/all");
    }
   
}
