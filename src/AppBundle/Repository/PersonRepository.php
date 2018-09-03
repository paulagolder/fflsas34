<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\person;



class PersonRepository extends EntityRepository
{
   

    
    public function findAll()
    {
      
       $qb = $this->createQueryBuilder("p");
       $qb->orderBy("p.surname", "ASC");
       $people =  $qb->getQuery()->getResult();
       foreach( $people as $person)
       {
          $person->fixperson();
       }
     
       return $people;
    }
    
    
    
    public function findOne($personid)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.personid = :pid');
       $qb->setParameter('pid', $personid);
       $person =  $qb->getQuery()->getOneOrNullResult();
       if($person)
           $person->fixperson();
     
       return $person;
    }
    
     public function findSearch($sfield)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.surname LIKE :pid or p.forename LIKE :pid   or p.alias LIKE :pid   ');
       $qb->setParameter('pid', $sfield);
       $qb->orderBy("p.surname", "ASC");
       $people =  $qb->getQuery()->getResult();
       foreach( $people as $person)
       {
          $person->fixperson();
       }
       return $people;
    }
    
    
    public function getLabel($personid)
    {
    
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.personid = :pid');
       $qb->setParameter('pid', $personid);
       $person =  $qb->getQuery()->getOneOrNullResult();
       if($person)
           $person->fixperson();
     
       return $person->getLabel();
       }
}
