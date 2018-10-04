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
    
    
   
    
    public function Showone($sid, Request $request)
    {
        $content=null;
        $content_ar = $this->getDoctrine()->getRepository("AppBundle:Content")->findSubject($sid);
        if(!$content_ar )
        {
          $content_ar = $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($sid);
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
           $content = $content_ar['*'] ;
        }
       
        $content['text'] =  $this->setImageLinks($content["text"]);
        $refs = $this->getDoctrine()->getRepository("AppBundle:Linkref")->findGroup('content',$sid);
        
        return $this->render('content/showone.html.twig', 
        [
        'message' =>  '',
        'lang'=>$this->lang,
        'content'=> $content,
        'title'=>$content['title'],
        'refs'=>$refs,
        ]);
    }
    
    
    
    public function Showcontent($cid,Request $request)
    {
        $content=null;
        $content= $this->getDoctrine()->getRepository("AppBundle:Content")->findOne($cid);
       #   $content->setText(  $this->setImageLinks($content->getText()));
       
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
       # $content->setText($this->setImagelinks($content->getText()));
        $form = $this->createForm(ContentForm::class, $content);
        if ($request->getMethod() == 'POST') 
        {
            $form->handleRequest($request);
            if ($form->isValid()) {
                // perform some action, such as save the object to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($content);
                $entityManager->flush();
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
    
    
    
    
   public  function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br><img><p>')
    {
        mb_regex_encoding('UTF-8');
        //replace MS special characters first
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
        $replace = array('\'', '\'', '"', '"', '-');
        $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
        if(mb_stripos($text, '/*') !== FALSE){
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
        }
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
        $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
        $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */
        $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if($num_matches){
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
        }
        return $text;
    }
    
    public function setImagelinks($text)
    {
    # $text= $this->strip_word_html($text,'<b><i><sup><sub><em><strong><u><br><p><img>');
     $text = preg_replace('/(<p.+?)style=".+?"(>.+?)/i', "$1$2", $text);
     $text = preg_replace('/(<p.+?)class=".+?"(>.+?)/i', "$1$2", $text);
      $text = preg_replace('/(<span.+?)style=".+?"(>.+?)/i', "$1$2", $text);
     $text =  strip_tags($text,"<p><img><br>");
      $text=  str_ireplace("\"images/stories/fflsas/images/","\"http://fflsas.org/images/stories/fflsas/images/", $text);
       $text=  str_ireplace("\"images/stories/fflsas/newimages/","\"http://fflsas.org/images/stories/fflsas/newimages/", $text);
     # http://fflsas.org/images/stories/fflsas/images/jacques_de_bollardie_252.jpg


       return $text;
    }
}
