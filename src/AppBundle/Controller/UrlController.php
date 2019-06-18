<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;
use Symfony\Component\HttpFoundation\RedirectResponse;


use AppBundle\Entity\Url;

use AppBundle\Form\UrlForm;
use AppBundle\Service\MyLibrary;


class UrlController extends Controller
{
    
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    

    
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    
    public function Showall()
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $furls = $this->getDoctrine()->getRepository("AppBundle:Url")->findAll();
        if (!$furls) {
            return $this->render('url/showall.html.twig', [ 'message' =>  'Urls not Found',]);
        }        
        foreach($furls as $fuser)
        {
            $fuser->link = "/admin/url/".$fuser->getId();
        }
        return $this->render('url/showall.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' => 'urls',
        'fusers'=> $furls,
        ]);
    }
    
     public function Delete($urlid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $this->getDoctrine()->getRepository("AppBundle:Url")->delete($urlid);
    
       
         return $this->redirect("/".$this->lang.'/url/show');
    }
    
    
     public function visit($urlid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $furl = $this->getDoctrine()->getRepository("AppBundle:Url")->findOne($urlid);
    
       return new RedirectResponse('http://bbc.co.uk');
       //  return $this->redirect("/".$this->lang.'/url/show');
    }
    
      public function edit($urlid)
    {
         $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $request = $this->requestStack->getCurrentRequest();
        $linkref=null;
        if($urlid>0)
        {
            $url = $this->getDoctrine()->getRepository('AppBundle:Url')->findOne($urlid);
        }
        if(! isset($url))
        {
            $url = new Url();
        }
       
        $form = $this->createForm(UrlForm::class, $url);

        if ($request->getMethod() == 'POST') 
        {
            #$form->bindRequest($request);
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($url);
                $entityManager->flush();
                $urlid = $url->getId();
                return $this->redirect('/admin/url/edit/'.$urlid );
                
            }
        }
        
        return $this->render('url/edit.html.twig', array(
            'form' => $form->createView(),
            'message' =>  '',
            'url' => $url,
            'returnlink'=>'/'.$this->lang.'/url/show'   ///admin/linkref/event/272/8
            ));
    }
    
   
}
