<?php

namespace AppBundle\Repository;
#namespace AppBundle\Entity;
use AppBundle\Entity\Imageref;

use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Driver\Connection;


class ImagerefRepository extends EntityRepository
{

   #public $objectnames = array();
   public $em ;
    
    
    public function __construct(EntityManagerInterface $entityManager)
    {
       # parent::__construct($registry, Imageref::class);
      # $this->objectnames["person"]="people";
      #  $this->objectnames["event"]="event";
        $this->em=$entityManager;
    }

 
    public function findOne($refid)
    {
        $ref =  $this->createQueryBuilder('t')
            ->andWhere('t.id = :refid')
            ->setParameter('refid', $refid)
            ->getQuery()
            ->getOneOrNullResult();
       return $ref;
    }
 
   public function findMatch($objecttype, $objid,$imageid)
    {
        $ref =  $this->createQueryBuilder('t')
            ->andWhere('t.imageid = :imageid')
            ->setParameter('imageid', $imageid)
            ->andWhere('t.objecttype = :ot')
            ->andWhere('t.objid = :oid')
            ->setParameter('ot', $objecttype)
            ->setParameter('oid', $objid)
            ->getQuery()
            ->getOneOrNullResult();
       return $ref;
    }

     public function findGroup($objecttype, $objid)
    {
    # $refs = $this->getDoctrine()->getRepository(Imageref::class)->createQueryBuilder("t")
       #$qb =  $this->createQueryBuilder('t');
        #->from('AppBundle::Imageref' , 't')
        #    ->andWhere('t.objecttype = ?')
        #    ->andWhere('t.objid = ?')
        #    ->setParameter(0, $objecttype)
        #    ->setParameter(1, $objid)
      $sql = "select t from AppBundle:imageref t ";
      $sql .= " where t.objecttype = '".$objecttype."' ";
      $sql .= " and t.objid = ".$objid;
      $query = $this->em->createQuery($sql);
        $refs = $query->getResult();
            
                 
       $ref_ar= array();
       $i=0;
        foreach( $refs as $ref)
       {
          $url = "/".$objecttype."/".$objid;
          $ref_ar[$i]['id'] = $ref->getId();
          $ref_ar[$i]['link'] = $url;
          $ref_ar[$i]['imageid'] = $ref->getimageid();
          $ref_ar[$i]['label'] =  $ref->getobjecttype().":".  $ref->getobjid();
          $i++;
       }
       return $ref_ar;
    }
    
     public function findAllGroups( $imgid)
     {
       # $qb=  $this->createQueryBuilder('r');
       #    $qb->andWhere('r.imageid = :iid');
        ##   $qb ->setParameter('iid', $imgid);
        #   $gqb = $qb->getQuery();
       #   $refs = $gqb->getResult();
          
              #    ->setParameter(1, $objid)
      $sql = "select t from AppBundle:imageref t ";
      $sql .= " where t.imageid= ".$imgid." ";
      $query = $this->em->createQuery($sql);
        $refs = $query->getResult();
  
       $ref_ar= array();

        foreach( $refs as $ref)
       {
          $objecttype = $ref->getobjecttype();
          $objid = $ref->getobjid();
          $ref_ar[$objecttype][$objid]['link'] = "/".$objecttype."/". $objid;
          $ref_ar[$objecttype][$objid]['imageid'] = $ref->getimageid();
       }
       return $ref_ar;
    }
    
    public function delete($objecttype, $objid, $imageid)
    {
        $sql = "delete FROM App\Entity\Imageref p where p.objecttype = '".$objecttype."'";
        $sql .= ' and p.objid = '.$objid;
        $sql .= ' and p.imageid = '.$imageid;
        $query = $this->em->createQuery($sql);
        $numDeleted = $query->execute();
        return $numDeleted;
    }
    
}
