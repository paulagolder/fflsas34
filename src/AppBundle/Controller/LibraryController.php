<?php

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\event;
use AppBundle\Entity\person;

class LibraryController extends Controller
{
    /**
     * @Route("/library", name="library")
     */
    public function index()
     {
         return $this->render('event/index.html.twig', [
         'controller_name' => 'EventController',
         ]);
     }
     
    static public function xgetText($text_ar,$attribute,$language)
    {
     if( array_key_exists ( $language , $text_ar[$attribute] ))return $text_ar[$attribute][$language] ;
      //if($text_ar[$attribute][$language] ) return $text_ar[$attribute][$language] ;
      if( array_key_exists ( "FR" , $text_ar[$attribute] )) return $text_ar[$attribute]["FR"] ;
      if($text_ar[$attribute]["EN"] ) return $text_ar[$attribute]["EN"] ;
      return "No text found";
    }
    
    static public function xgetTexts($text_ar,$attribute)
    {
      if($text_ar[$attribute]) return $text_ar[$attribute] ;
      return "No text found";
    }
    

}
