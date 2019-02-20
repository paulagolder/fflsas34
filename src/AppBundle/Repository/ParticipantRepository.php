<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\participant;
use AppBundle\Entity\Person;

use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\DBAL\Driver\Connection;

/**
null)
 */
class ParticipantRepository extends EntityRepository
{
   
    

   

 
    public function findAll()
    {
       $sql = " select p.*  from AppBundle:participant p ";
      $query = $this->getEntityManager()->createQuery($sql);
      $participations = $query->getResult();

       foreach( $participations as $participation )
       {
          $url = "/admin/participant/detail/".$participation->getParticipationId();
          $participation->link = $url;
          $participation->label = $participation->getEventid().":".$participation->getPersonid();
       }
       return $participations;
       
    }
    
    
     
    public function findOne($participationid)
    {
    # paul to fix simplify with join
   
       
       $sql = " select p  from AppBundle:participant p  where p.participationid = ".$participationid;
      $query = $this->getEntityManager()->createQuery($sql);
      $participations = $query->getResult();
      $participation = $participations[0];
      # $manager = $this->getEntityManager();
       $conn =  $this->getEntityManager()->getConnection();
       $persons = $conn->query("select * from person where personid  =".$participation->getpersonid())->fetchAll();
       $person = $persons[0];
     //  $person->fixPerson();
       $participation->label = $person['surname'];
       
       return $participation;
    }
    
    
    public function findParticipants($eventid)
    {
      $sql = " select p.personid,pl.surname,pl.forename  from AppBundle:participant p ";
      $sql .= " join AppBundle\Entity\Person pl WITH pl.personid = p.personid " ;
      $sql .= " where p.eventid = ".$eventid;
      $sql .= " order by pl.surname ASC ";
      $query = $this->getEntityManager()->createQuery($sql);
      $participations = $query->getResult();

       $participants = array();
       $p=0;
       foreach( $participations as $participation )
       {
         $participants[$p]['link'] = "";
         $participants[$p]['eventid']= $eventid;
         $participants[$p]['personid']= $participation['personid'];
         $fname = $participation['surname'];
         if($participation['forename'] )
         {
            $fname .= ", ".$participation['forename'] ;
         }
         $participants[$p]['label'] = $fname;
         $p++;
       }
       return $participants;
       
    }
    
    
    public function findParticipations($personid)
    {
      $sql = "select p from AppBundle:participant p ";
      $sql .= " where p.personid = ".$personid;
      $query = $this->getEntityManager()->createQuery($sql);
      $participations = $query->getResult();
      # $participations =  $qb->getQuery()->getResult();
       
       foreach( $participations as $participation )
       {
          $url = "/admin/participant/detail/".$participation->getParticipationId();
          $participation->link = $url;
          $participation->label = $participation->getEventid();
       }
       return $participations;
    }
    
      public function findParticipationsbyEntityPerson($eventid, $personid)
    {
      $sql = " select p, pl from AppBundle:participant p ";
      $sql .= " join 'AppBundle\Entity\Person' pl WITH pl.personid = p.personid " ;
      $sql .= " where p.eventid = ".$eventid;
      $sql .= " and p.personid = ".$personid;
      $sql .= " order by pl.surname ASC ";
      $query = $this->getEntityManager()->createQuery($sql);
      $participations = $query->getResult();
      foreach( $participations as $participation )
      {
      
         # $participation->label = $participation->geteventid();
      }
      return $participations;
    }
    
    public function deleteOne($participationid)
    {
        $query = $this->em->createQuery('delete FROM  AppBundle\Entity\Participant p where p.participationid = '.$participationid);
        $numDeleted = $query->execute();

       return $numDeleted;
    }
}
