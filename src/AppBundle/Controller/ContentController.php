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
    
    
    public function Showall()
    {
        # $this->lang = $this->requestStack->getCurrentRequest()->getLocale();
        $contents = $this->getDoctrine()->getRepository("AppBundle:Content")->findAll();
        
        if (!$contents) {
            return $this->render('content/showall.html.twig', [ 'message' =>  'Content not Found',]);
        }
        
        
        return $this->render('content/contentsearch.html.twig', 
        [
        'lang' => $this->lang,
        'message' =>  '' ,
        'heading' =>  'Content',
        'contents'=> $contents,]);
    }
    
    public function Showone($sid, Request $request)
    {
        $content=null;
        $content_ar = $this->getDoctrine()->getRepository("AppBundle:Content")->findSubject($sid);
  
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
          dump( $content_ar);
        }

        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('content',$sid);
        
        return $this->render('content/showone.html.twig', 
        [
        'message' =>  '',
        'content'=> $content,
        'title'=>$content['title'],
        'refs'=>$refs,
        ]);
    }
    
    
    
    public function Showcontent($cid,Request $request)
    {
        $content=null;
        $content= $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
        
       
         $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$cid);
         $title = $this->mylib->selectText($text_ar,'title',$this->lang);
         $comment =  $this->mylib->selectText($text_ar,'comment',$this->lang);
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('content',$content->getSubjectid());
        
        return $this->render('content/showone.html.twig', 
        [
        'message' =>  '',
        'content'=> $content,
        'title'=>$title,
        'refs'=>$refs,
        ]);
    }
    
    public function Editone($cid)
    {
        $content = $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
        
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
        $text_ar =  $this->getDoctrine()->getRepository("AppBundle:Text")->findGroup('content',$content['contentid']);
        $title = $this->mylib->selectText($text_ar,'title',$this->lang);
      #  $comment =  $this->mylib->selectText($text_ar,'comment',$this->lang);
        $content['label'] = $title;
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
    
    
    
    public function edit($cid)
    {   
        
        $contentid=$cid;
        $content= $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
        $label = $content->getTitle();
        
        $request = $this->requestStack->getCurrentRequest();
        $content = $this->getDoctrine()->getRepository('AppBundle:Content')->findOne($contentid);
        if($content==null)
        {
            $content = new Content();
            $content->setLanguage($this->lang);
        }
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
                return $this->redirect("/admin/content/edit/".$cid);
                
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
                $content->link = "/admin/content/addBookmark/".$content->getContentid();
            }
            
        }
        
        
        return $this->render('content/contentsearch.html.twig', 
        [ 
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
           var_dump($uri);
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
        
         return $this->redirect($uri);
        
       # return $this->redirect("/admin/content/search?searchfield=".$gfield);
        
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
    
}
