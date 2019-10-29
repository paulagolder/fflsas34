<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder;
use Symfony\Component\HttpFoundation\RedirectResponse;


use AppBundle\Entity\Label;

use AppBundle\Form\LabelForm;
use AppBundle\Service\MyLibrary;


class LabelController extends Controller
{
    
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    

    
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
    }
    
   
    
     public function Delete($lid)
    {
        $this->getDoctrine()->getRepository("AppBundle:Url")->delete($lid);
         return $this->redirect("/admin/label/search");
    }
    
     public function show($tag)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $labels= $this->getDoctrine()->getRepository("AppBundle:Url")->findByTags($tags);
        if(!labels)
        {
          $mess = "tags not found";
        } else
        {
          $mess = '';
        }
        return $this->render('label/show.html.twig', 
        [ 
        'lang' => $this->lang,
        'message' =>  $mess ,
        'heading' => 'tags.found',
        'tags'=> $tags,
        ]);
    }
    
    
      public function edit($lid)
    {
        $request = $this->requestStack->getCurrentRequest();
        $linkref=null;
        if($lid>0)
        {
            $label = $this->getDoctrine()->getRepository('AppBundle:Label')->findOne($lid);
            $nlab =  $request->query->get("t".$lid);
            $label->setText( $this->formatlabels($nlab));
       
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($label);
                $entityManager->flush();
                $lid = $label->getId();
                return $this->redirect('/admin/label/search');
        }    
    }
    
    
      public function newtag()
    {
             $request = $this->requestStack->getCurrentRequest();
             $entityManager = $this->getDoctrine()->getManager();
            $nlab =  $request->query->get("newtag");
            $tag = $this->formatlabels($nlab);
            if($tag =="")    return $this->redirect('/admin/label/search');
            $labelf= new Label();
            $labelf->setTag($tag);
            $labelf->setLang("fr");
            $labelf->setMode("message");
            $labelf->setText("_".$tag);
             $labele= new Label();
            $labele->setTag($tag);
            $labele->setLang("en");
            $labele->setMode("message");
            $labele->setText("_".$tag);
                $entityManager->persist($labelf);
                
                     $entityManager->persist($labele);
                $entityManager->flush();
                return $this->redirect('/admin/label/search');
    }
    
     public function LabelSearch($search, Request $request)
    {
        $message="";
        if(isset($_GET['searchfield']))
        {
            $pfield = $_GET['searchfield'];
            $this->mylib->setCookieFilter("label",$pfield);
        }
        else
        {
            if(strcmp($search, "=") == 0) 
            {
                $pfield = $this->mylib->getCookieFilter("label");
            }
            else
            {
               $pfield="*";
               $this->mylib->clearCookieFilter("label");
            }
        }
        if (is_null($pfield) || $pfield=="" || !$pfield || $pfield=="*") 
        {
            $labels = $this->getDoctrine()->getRepository("AppBundle:Label")->findAll("message");
            $subheading =  'trouver.tout';
        }
        else
        {
            $sfield = "%".$pfield."%";
            $labels = $this->getDoctrine()->getRepository("AppBundle:Label")->findSearch($sfield,"message");
            $subheading =  'trouver.avec';
        }
        
        if (count($labels)<1) 
        {
             $subheading = 'rien.trouver.pour';
        }
        else
        {
            foreach($labels as $label)
            {
               
            }
            
        }
        
        
        return $this->render('label/labelsearch.html.twig', 
        [ 
        'lang'=>$this->lang,
        'message' => $message,
        'heading' =>  'Gestion des Libelles',
        'subheading' =>  $subheading,
        'searchfield' =>$pfield,
        'labels'=> $labels,
        
        ]);
    }
    
    public function generate()
    {
    
    
        $fpfr = fopen("../translations/messages.fr.yml","w");
        $fpen = fopen("../translations/messages.en.yml","w");
        

            $labels = $this->getDoctrine()->getRepository("AppBundle:Label")->findAll("message");
       
            
            foreach($labels as $label)
            {
             $outlabel = $this->formatlabels($label->getText());
            if($label->getLang() == "en")
            {
              fwrite($fpen, $label->getTag().": ". $outlabel."\n");
            }
            elseif($label->getLang() == "fr")
            {
              fwrite($fpfr, $label->getTag().': "'. $outlabel.'"'."\n");
            }
            }
            fclose($fpen);
            fclose($fpfr);
            $mess = "translation.files.produced";;
            return $this->redirect('/accueil/message/'.$mess);
        
       
    }
   
   private function formatlabels($intext)
   {
        $text = trim($intext);
        $text =  strip_tags($text);
        $text =  preg_replace("/^'/", '', $text);
        $text =  preg_replace('/^"/', '', $text);
        $text =  rtrim($text, "'");
        $text =  rtrim($text, '"');
        return $text;
    }
    
}
