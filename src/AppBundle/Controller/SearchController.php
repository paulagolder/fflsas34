<?php
// src/Controller/SearchController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Service\MyLibrary;


class SearchController extends Controller
{
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    


    public function ShowAll(Request $request)
    {
    
       $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
    
       $pfield = $request->query->get('searchfield');
       $gfield = $request->query->get('searchfield');
   
       // $speople = array();
       // $sevents = array();
       // $simages= array();
      
        if (!$pfield) 
        {
            return $this->render('search/showall.html.twig', 
            [ 
              'lang' => $this->lang,
               'message' =>  'rien.a.chercher',
            ]);
        }
        
        $pfield = "%".$pfield."%";
        
        $i=0;
        $people = $this->getDoctrine()->getRepository("AppBundle:Person")->findSearch($pfield);
        $results = array();
        foreach($people as $key => $person)
        {
          $pid = $person->getPersonid();
          $results['people'][$pid]['label'] = $person->getFullname();
          $results['people'][$pid]['link'] ="/".$this->lang."/person/".$pid;
        }
        
        $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findSearch($pfield);
        foreach($contents as $key => $content)
        {
          $cid = $content->getContentid();
          $results['content'][$cid]['label'] = $content->getLabel();
          $results['content'][$cid]['link'] ="/".$this->lang."/subject/".$cid;
        }
        
        $locations = $this->getDoctrine()->getRepository("AppBundle:Location")->findSearch($pfield);
        foreach($locations as $key => $location)
        {
          $lid = $location->getlocid();
          $results['location'][$lid]['label'] = $location->getName();
          $results['location'][$lid]['link'] ="/".$this->lang."/location/".$lid;
        }
        
         $ref_ar = $this->getDoctrine()->getRepository("AppBundle:Text")->findTexts($pfield);
         foreach($ref_ar as $key => $oref_ar)
         {
           $obtype = $key;
          // $lib = $this->get('library_service');
           switch ($obtype) 
           {
              case "person":
                 foreach($oref_ar as $key => $ref)
                 {
                      $pid = $key;
                      $person = $this->getDoctrine()->getRepository("AppBundle:Person")->findOne($pid);
                      if($person)
                        $results['people'][$pid]['label'] = $person->getFullname();
                        else
                         $results['people'][$pid]['label'] = "  notfound ";
                      $results['people'][$pid]['link'] ="/".$this->lang."/person/".$pid;
                 }
               break;
              case "event":
                 foreach($oref_ar as $key => $ref)
                 {
                      $pid = $key;
                      $event = $this->getDoctrine()->getRepository("AppBundle:Event")->findOne($pid);
                      $results['events'][$pid]['label'] = $event->getLabel();
                      $results['events'][$pid]['link'] ="/".$this->lang."/event/".$pid;
                 }
               break;
             case "image":
                 foreach($oref_ar as $key => $ref)
                 {
                      $pid = $key;
                      $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('image',$pid);
                      $results['images'][$pid]['label'] = $this->mylib->getText($text_ar,'title',$this->lang)['comment'];
                    
                       $results['images'][$pid]['link'] ="/".$this->lang."/image/".$pid;
                 }
              break;
               case "content":
                 foreach($oref_ar as $key => $ref)
                 {
                      $pid = $key;
                      $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$pid);
                      $results['content'][$pid]['label'] = $this->mylib->getText($text_ar,'title',$this->lang);
                      $results['content'][$pid]['link'] ="/".$this->lang."/contentid/".$pid;
                 }
              break;
               case "location":
                 foreach($oref_ar as $key => $ref)
                 {
                      $pid = $key;
                      $location =   $this->getDoctrine()->getRepository("AppBundle:Location")->findOne($pid);
                      if($location != null)
                      {
                      $results['locations'][$pid]['label'] = $location->getName();
                      $results['locations'][$pid]['link'] ="/".$this->lang."/location/".$pid;
                      }
                 }
                      break;
            }
         }
    
           if (count($results)<1) 
           {
            return $this->render('search/showall.html.twig', 
            [ 
               'message' =>  'rien.trouver',
               'searchkey'=>$gfield,
            ]);
           }
           
           return $this->render('search/showall.html.twig', 
                       [ 
                         'message' => "",
                         'searchkey'=>$gfield,
                         'results'=> $results,
                       ]);
    }
    
    
  }  
    
   
