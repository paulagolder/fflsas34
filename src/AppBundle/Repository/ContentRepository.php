<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Content;

use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManagerInterface;


class ContentRepository extends EntityRepository
{

    public $em ;

     public function __construct(EntityManagerInterface $entityManager)
    {
        #parent::__construct($registry, Content::class);
        $this->em=$entityManager;
    }

    public function findAll()
    {
       $sql = "select c from AppBundle:content c ";
       $sql .= " order by c.title ASC ";
       $query = $this->em->createQuery($sql);
       $contents = $query->getResult();
       return $contents;
    }
    
    
    public function findOne($contentid)
    {
       $sql = "select c from AppBundle:content c ";
       $sql .= " where c.contentid = ".$contentid." ";
       $query = $this->em->createQuery($sql);
       $contents = $query->getResult();
       return $contents[0];
    }
    
      public function findOnebyLang($subjectid,$lang)
    {
       $qb = $this->createQueryBuilder("i");
       $qb->andWhere('i.subjectid = :sid');
       $qb->setParameter('sid', $subjectid);
       $qb->andWhere(':lang LIKE i.language ' );
       $qb->setParameter('lang', $lang);
       $content =  $qb->getQuery()->getOneOrNullResult();
       return $content;
    }
    
       public function findSubject($subjectid)
    {
       $sql = "select c from AppBundle:content c ";
       $sql .= " where c.subjectid = ".$subjectid." ";
       $query = $this->em->createQuery($sql);
       $contents = $query->getResult();
       
       
       $content_ar = array();
       foreach( $contents as $content )
       {
         $key = $content->getLanguage();
         $acontent = array();
         $acontent['title']= $content->getTitle();
         $acontent['text'] = $content->getText();
         $acontent['language'] = $content->getLanguage();
         $acontent['subjectid'] = $content->getSubjectid();
         $acontent['contentid'] = $content->getContentid();
         $content_ar[$key] = $acontent;
       }
       return $content_ar;
    }
    
    public function findSearch($sfield)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.title LIKE :pid  or p.text LIKE :pid ');
       $qb->setParameter('pid', $sfield);
       $qb->orderBy("p.title", "ASC");
       $images =  $qb->getQuery()->getResult();
      
       return $images;
    }
    
    
     public function delete($contentid)
    {
        $sql = "delete FROM  AppBundle\Entity\Content c where c.contentid = ".$contentid;
        $query = $this->em->createQuery($sql);
        $numDeleted = $query->execute();
        return $numDeleted;
    }
    
}
