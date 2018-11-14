<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;


use AppBundle\Entity\Content;
use AppBundle\Entity\Text;
use AppBundle\Service\MyLibrary;
use AppBundle\Form\ContentForm;

class ContentController extends Controller
{
    
    
    private $lang="fr";
    private $mylib;
    private $requestStack ;
    
    public function __construct( MyLibrary $mylib ,RequestStack $request_stack)
    {
        $this->mylib = $mylib;
        $this->requestStack = $request_stack;
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
    }
    
    public function index()
    {
        return $this->render('content/index.html.twig', [
        'controller_name' => 'ContentController',
        ]);
    }
    
    
   
    
    public function Showsubject($sid)
    {
        $content=null;
        $content_ar = $this->getDoctrine()->getRepository("AppBundle:Content")->findSubject($sid);
        if(!$content_ar )
       {
          return $this->render('content/showone.html.twig', 
        [
        'message' =>  'contenu non trouver',
        'lang'=>$this->lang,
        'content'=> null,
        'refs'=> null,
        ]);
        }
        if(array_key_exists ($this->lang,$content_ar )) 
        {
            $content = $content_ar[$this->lang] ;
        }
        elseif(array_key_exists ("fr",$content_ar ))
        {
            $content = $content_ar['fr'] ;
        }
        elseif(array_key_exists ("en",$content_ar ))
        {
            $content = $content_ar['en'] ;
        }
        else
        {
        #dump($content_ar);
          # $content = $content_ar['*'] ;
        }
              $text = $content->getText();
        $text = $this->insertImages($text);
        $content->setText(  $this->cleanText($text));
         $content->setText( $this->cleanText($content->getText()));
        # $content['title'] = $content["title"];
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('content',$sid);
        
        return $this->render('content/showone.html.twig', 
        [
        'message' =>  '',
        'lang'=>$this->lang,
        'content'=> $content,
        'refs'=>$refs,
        ]);
    }
    
    
    
    public function Showcontent($cid,Request $request)
    {
        $content=null;
        $content= $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
       #   $content->setText(  $this->cleanText($content->getText()));
       
         $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$cid);
         $title = $this->mylib->selectText($text_ar,'title',$this->lang);
         $comment =  $this->mylib->selectText($text_ar,'comment',$this->lang);
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('content',$content->getSubjectid());
        
        return $this->render('content/showone.html.twig', 
        [
        'message' =>  '',
        'lang'=>$this->lang,
        'content'=> $content,
        'title'=>$title,
        'refs'=>$refs,
        ]);
    }
    
    public function Editone($cid)
    {
        $content = $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
        $text = $content->getText();
        $text = $this->insertImages($text);
        $content->setText(  $this->cleanText($text));
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$cid);
        $title = $this->mylib->selectText($text_ar,'title',$this->lang);
        $comment =  $this->mylib->selectText($text_ar,'comment',$this->lang);
        
        
        return $this->render('content/editone.html.twig', 
        ['lang'=>$this->lang, 
        'message' =>  '',
        'content'=> $content,
        'objid' => $cid,
        'title'=>$title,
        'comment' => $comment,
        'refs' => null,
        'returnlink'=>'/admin/content/search',
        ]);
    }
    
      public function Editsubject($sid)
    {
        $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findSubject($sid);
        foreach ($contents as $content)
        {
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$content->getContentid());
        $title = $this->mylib->selectText($text_ar,'title',$this->lang);
        if($title)
           $content->setLabel($title);
        else
           $content->setLabel($content->getTitle());
           
        $content->setText( $this->cleanText($content->getText()));
        }
        
        return $this->render('content/editsubject.html.twig', 
        ['lang'=>$this->lang, 
        'message' =>  '',
        'contents'=> $contents,
        'subjectid' => $sid,
        'refs' => null,
        'returnlink'=>'/admin/content/search',
        ]);
    }
    
    
    
    public function edit_alt($cid)
    {   
        $request = $this->requestStack->getCurrentRequest();
        $contentid=$cid;
        $content= $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
        $label = $content->getTitle();
        $sid = $content->getSubjectid();

        $content ->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $content ->setUpdateDt($now);
        $content->setText($this->cleanText($content->getText()));
       
        
          return $this->render('content/edit_alt.html.twig', array(
           'content' =>$content,
            'returnlink' => "/admin/content/".$content->getsubjectid(),

            ));
    }
    
    public function process_edit($cid)
    {   
        $request = $this->requestStack->getCurrentRequest();
         //  dump($request);
         //  var_dump($request);
        $contentid=$cid;
        $content= $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
      //  $label = $content->getTitle();
        $sid = $content->getSubjectid();

        $content ->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $content ->setUpdateDt($now);
        $content->setText($this->cleanText($content->getText()));
    
        if ($request->getMethod() == 'POST') 
        {
            $content->setTitle($request->request->get('_title'));
            $content->setText($request->request->get('_text'));
            
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($content);
                $entityManager->flush();
                return $this->redirect("/".$this->lang."/content/".$sid);
            
        }
        
       return $this->render('content/edit.html.twig', array(
            'form' => $form->createView(),
            'label'=> $label,
            'returnlink' => "/admin/content/".$content->getsubjectid(),
            'contentid'=>$contentid,
            ));
    }
    
    
   public function edit($cid)
    {   
        $request = $this->requestStack->getCurrentRequest();
        $contentid=$cid;
        $content= $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
        $label = $content->getTitle();
        $sid = $content->getSubjectid();

        $content ->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $content ->setUpdateDt($now);
        $content->setText($this->cleanText($content->getText()));
        $form = $this->createForm(ContentForm::class, $content);
        if ($request->getMethod() == 'POST') 
        {
            $form->handleRequest($request);
            if ($form->isValid()) {
               # $content->setText($this->cleanText($content->getText()));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($content);
                $entityManager->flush();
                return $this->redirect("/".$this->lang."/content/".$sid);
                
            }
        }
        
        #$matches = array();
        
       # $n = preg_match_all('(<img\s[A-z="]*\s*src[^"]"[^"]+[^/>]+/>)', $content->getText(),$matches);

        return $this->render('content/edit.html.twig', array(
            'form' => $form->createView(),
            'label'=> $label,
            'returnlink' => "/admin/content/".$content->getsubjectid(),
            'contentid'=>$contentid,
            ));
    }
    
    
    
    
     public function editnew()
    {   
        
        #$contentid=$cid;
        $maxsid= $this->getDoctrine()->getRepository('AppBundle:Content')->findMaxSid();
        #$label = $content->getTitle();
        $label="";
        $contentid=null;
      #  dump($maxsid[0][1]);
        $ms = intval($maxsid[0][1]);
        #dump($ms);
        $request = $this->requestStack->getCurrentRequest();
     #   $content = $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
            $content = new Content();
            $content->setLanguage($this->lang);
            $content->setSubjectid($ms+1);
        $content ->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $content ->setUpdateDt($now);
        $form = $this->createForm(ContentForm::class, $content);
        if ($request->getMethod() == 'POST') 
        {
            $form->handleRequest($request);
            if ($form->isValid()) {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($content);
                $entityManager->flush();
                 $cid = $content->getContentid();
                return $this->redirect("/".$this->lang."/content/".$cid);
                
            }
        }
        
        $matches = array();
        
        $n = preg_match_all('(<img\s[A-z="]*\s*src[^"]"[^"]+[^/>]+/>)', $content->getText(),$matches);

        return $this->render('content/edit.html.twig', array(
            'form' => $form->createView(),
            'label'=> $label,
            'returnlink' => "/admin/content/".$content->getsubjectid(),
            'contentid'=>$contentid,
            'imagelinks'=>$matches,
            ));
    }
    
    
      public function newlang($sid,$lang)
    {   
        
       
            $content = new Content();
            $content->setLanguage($lang);
            $content->setSubjectid($sid);
            $content->setTitle("?");
            $content->setText("?");
        $content ->setContributor($this->getUser()->getUsername());
        $now = new \DateTime();
        $content ->setUpdateDt($now);
       
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($content);
                $entityManager->flush();
                 $cid = $content->getContentid();
                return $this->redirect("/".$this->lang."/content/".$sid);
                
       
    }
    
     public function Showall(Request $request)
    {
       
        $message="";
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $pfield = $request->query->get('searchfield');
        $gfield = $request->query->get('searchfield');
        
        if (!$pfield) 
        {
            $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findAll();
            $heading =  'trouver.tout';
            
        }
        else
        {
            $pfield = "%".$pfield."%";
            $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findSearch($pfield);
            $heading =  'trouver.avec';
        }
        
        
        if (count($contents)<1) 
        {
            $message = 'rien.trouver.pour';
        }
        else
        {
            foreach($contents as $content)
            {
                $content->link = "/".$this->lang."/content/addbookmark/".$content->getContentid();
            }
            
        }
        
        
        return $this->render('content/showall.html.twig', 
        [ 
        'lang'=> $this->lang,
        'message' => $message,
        'heading' =>  $heading,
        'searchfield' =>$gfield,
        'contents'=> $contents,
        
        ]);
    }
    
    public function ContentSearch(Request $request)
    {
        $message="";
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        
        $pfield = $request->query->get('searchfield');
        $gfield = $request->query->get('searchfield');
        
        if (!$pfield) 
        {
            $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findAll();
            $heading =  'trouver.tout';
            
        }
        else
        {
            $pfield = "%".$pfield."%";
            $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findSearch($pfield);
            $heading =  'trouver.avec';
        }
        
        
        if (count($contents)<1) 
        {
            $message = 'rien.trouver.pour';
        }
        else
        {
            foreach($contents as $content)
            {
                $content->link = "/admin/content/addbookmark/".$content->getContentid();
            }
            
        }
        
        
        return $this->render('content/contentsearch.html.twig', 
        [ 
        'lang'=>$this->lang,
        'message' => $message,
        'heading' =>  $heading,
        'searchfield' =>$gfield,
        'contents'=> $contents,
        
        ]);
    }
    
    
    public function addBookmark($sid,Request $request)
    {
        $gfield = $request->query->get('searchfield');
           $uri = $request->getUri();
          # var_dump($uri);
        $content =  $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($sid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('contentList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newcontent = array();
        $newcontent['id'] = $sid;
        $newcontent["label"]= $content->getTitle();
        $ilist[$sid]= $newcontent;
        $session->set('contentList', $ilist);
        
         #return $this->redirect($uri);
        
        return $this->redirect("/admin/content/search?searchfield=".$gfield);
        
    }
    
      public function addUserBookmark($sid)
    {
        $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
    
        $content =  $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($sid);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $ilist = $session->get('contentList');
        if($ilist == null)
        {
            $ilist = array();
        }
        $newcontent = array();
        $newcontent['id'] = $sid;
        $newcontent["label"]= $content->getTitle();
        $ilist[$sid]= $newcontent;
        $session->set('contentList', $ilist);
        
        // return $this->redirect($uri);
        
        return $this->redirect("/".$this->lang."/content/".$sid);
        
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
    
     public function Deleteimage($cid,$isn)
    {
        $contentid=$cid;
        $content= $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
        $matches = array();
        $n = preg_match_all('(<img\s[A-z="]*\s*src[^"]"[^"]+[^/>]+/>)', $content->getText(),$matches);
    
        $text = $content->getText();
        $searchtext = $matches[0][$isn];
        $newtext = str_replace( $searchtext, "IMAGE NON TROUVEE",$text);
        $content->setText($newtext);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($content);
        $entityManager->flush();
    
        return $this->redirect("/admin/content/edit/".$cid);
    }
    
     public function Delete($cid)
    {
        $this->getDoctrine()->getRepository("AppBundle:Content")->delete($cid);
        return $this->redirect("/admin/content/search");
    }
    
    
    public function insertImages($text)
    {
      $k1 = strpos ( $text , "[[" );
      while($k1 >0 )
      {
      $k2 = strpos ( $text , "]]",$k1 );
      $tokengroup = substr($text,$k1, $k2-$k1+2);
      dump($tokengroup);
      $tokens=substr($tokengroup,2,$k2-$k1-2);
        dump($tokens);
      $token_list=json_decode("{".$tokens."}",true);
     dump($token_list);

    $imageid =  $token_list['image'];
    // $imageid=16;
      $image =  $this->getDoctrine()->getRepository("AppBundle:Image")->findOne($imageid);
      if($image)
      {
      $style="";
      if(array_key_exists ('width' , $token_list))
      {
         $style .= "width:".$token_list['width'].";";
      }
      if(strlen($style)>0 )
        $inlinestyle = " style=\"".$style."\" ";
        else
        $inlinestyle="";
           $text = str_replace ($tokengroup , "<img src='".$image->getFullPath()."'".$inlinestyle.">" , $text );
           }
       else  
            $text = str_replace ($tokengroup , "<div>NO IMAGE </div>" , $text );
      $k1 = strpos ( $text , "[[" );   
     }
       return $text;
    }
    
   
    
    public function cleanText($text)
    {
   $text = preg_replace('/(\*\*.+?)style=".+?"(\*\*.+?)/i', "freddy", $text);
     $text = preg_replace('/(<p.+?)style=".+?"(>.+?)/i', "$1$2", $text);
     $text = preg_replace('/(<p.+?)class=".+?"(>.+?)/i', "$1$2", $text);
      $text = preg_replace('/(<span.+?)style=".+?"(>.+?)/i', "$1$2", $text);
     $text =  strip_tags($text,"<p><img><br><h1><b><i><h2><strong><em><u><ol><li><ul>");
      $text=  str_ireplace("\"images/stories/fflsas/images/","\"http://fflsas.org/images/stories/fflsas/images/", $text);
       $text=  str_ireplace("\"images/stories/fflsas/newimages/","\"http://fflsas.org/images/stories/fflsas/newimages/", $text);
  
       return $text;
    }
}
