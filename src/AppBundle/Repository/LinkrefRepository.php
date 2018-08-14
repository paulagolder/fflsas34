<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Linkref;

#use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
#use Symfony\Bridge\Doctrine\RegistryInterface;
#use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;

class LinkrefRepository extends EntityRepository
{

   public $em ;
   
   public function __construct(EntityManagerInterface $entityManager)
    {
        #parent::__construct($registry, Linkref::class);
        $this->em=$entityManager;
    }

    

     public function findAll()
    {
       $qb = $this->createQueryBuilder("l");
       $qb->orderBy("l.path", "ASC");
       $linkrefs =  $qb->getQuery()->getResult();
       foreach($linkrefs as $ref)
       {
        }
       return $linkrefs;
    }
    
    
    public function findOne($refid)
    {
       $qb = $this->createQueryBuilder("r");
       $qb->andWhere('r.linkid = :rid');
       $qb->setParameter('rid', $refid);
       $ref =  $qb->getQuery()->getOneOrNullResult();
       return $ref;
    }
    
    public function deleteOne($refid)
    {
        $sql = "delete FROM  AppBundle\Entity\Linkref p where p.linkid = '".$refid."'";
        $query = $this->em->createQuery($sql);
        $numDeleted = $query->execute();
        return $numDeleted;
    }
    
    
     public function findGroup($objecttype, $objid)
    {
       # $refs =  $this->createQueryBuilder('r')
       #     ->andWhere('r.objecttype = :ot')
       #     ->andWhere('r.objid = :oid')
       #     ->setParameter('ot', $objecttype)
        #    ->setParameter('oid', $objid)
       #     ->getQuery()
       #     ->getResult();
      $sql = "select r from AppBundle:linkref  r ";
      $sql .= " where r.objecttype  = '".$objecttype."' ";
        $sql .= " and r.objid  = ".$objid." ";
 
      $query = $this->em->createQuery($sql);
        $refs = $query->getResult();
 
       $ref_ar= array();
       $i=0;
       foreach( $refs as $ref)
       {
          $reflink =   $ref->getPath();
          $ref_ar[$i]['linkid'] = $ref->getLinkid();
          $url = "/linkref/".$ref->getLinkid();
          $ref_ar[$i]['link'] = $url;
          $ref_ar[$i]['path'] =  $ref->getPath();
          $ref_ar[$i]['label'] =  $ref->getLabel();
          $ref_ar[$i]['doctype'] =  $ref->getDoctype();
          if(substr($reflink,0,4)=="http")
          {
            $ref_ar[$i]['link'] = $reflink;
          }
          $i++;
       }
       return $ref_ar;
    }
    
}
