<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class EventRepository extends EntityRepository
{
   # public function __construct(RegistryInterface $registry)
    #{
   #     parent::__construct($registry, event::class);
    #}


    
    
    public function findAll()
    {
       $qb = $this->createQueryBuilder("e");
       $events =  $qb->getQuery()->getResult();
       
       foreach( $events as $event)
       {
         # $url = "/event/".$event->getEventid();
         # $event->link = $url;
       }
       return $events;
       
    }
    
    
     public function findChildren($eid)
    {
       $qb = $this->createQueryBuilder("e");
       $qb->andWhere('e.parent = :eid');
       $qb->orderBy('e.startdate');
       $qb->setParameter('eid', $eid);
       $events =  $qb->getQuery()->getResult();
       foreach( $events as $event)
       {
       #   $url = "/event/".$event->getEventid();
       #   $event->link = $url;
       }
       return $events;
    
    }
    
    public function findTop()
    {
       $qb = $this->createQueryBuilder("e");
       $qb->andWhere('e.parent = 0');
       $event =  $qb->getQuery()->getOneOrNullResult();
       return $event;
    }
    
    
    private function makefindonequery($eid)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.eventid = :eid');
       $qb->setParameter('eid', $eid);
       return $qb->getQuery();
    }
    
    public function findOne($eventid)
    {
       $qb = $this->makefindonequery($eventid);
       $event =  $qb->getOneOrNullResult();
       if($event == null) return null;
       $e = $event->getParent();
       $a=0;
       $event->title = $event->getLabel();
       while($e)
       {
          $parent = $this->makefindonequery($e)->getOneOrNullResult();
          $event->ancestors[$a] = $parent;
          $e = $parent->getParent();
          $a++;
       }
                
       $children = $this->findChildren($eventid);
       for($i=0;$i<count($children);$i++)
       {
          $child = $children[$i];
          $event->children[$i]['id']= $child->getEventid();
          $event->children[$i]['event']= $child;
       }
       return $event;
    }
    
    private function xfindTextsGroup($objecttype, $objid)
    {
        $manager = $this->getEntityManager();
        $conn = $manager->getConnection();
        $texts = $conn->query("select * from text where objecttype = 'event' and objid =".$objid)->fetchAll();
        $text_ar= array();
        foreach( $texts as $text)
       {
          $url = "/".$objecttype."/".$objid;
          $language = $text['language'];
          $attribute = $text['attribute'];
          $comment = $text['comment'];
          $text_ar['link'] = $url;
          $text_ar['objid'] = $objid;
          $text_ar['objecttype'] = $objecttype;
          $text_ar[$attribute][$language] = $comment;
          $text_ar['label'] = $objecttype.":".$objid;
       }
       return $text_ar;
    }
 
 
    static public function xgetText($text_ar,$attribute,$language)
    {
      if($text_ar[$attribute][$language] ) return $text_ar[$attribute][$language] ;
      if($text_ar[$attribute]["FR"] ) return $text_ar[$attribute]["FR"] ;
      if($text_ar[$attribute]["EN"] ) return $text_ar[$attribute]["EN"] ;
      return "No text found";
    }
    
    
    public function findLocations($locid)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.locid = :lid');
       $qb->setParameter('lid', $locid);
      
       $events =   $qb->getQuery()->getResult();
       return $events;
    }
    
    
    
}
