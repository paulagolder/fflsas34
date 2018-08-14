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
   
    public $em ;
    
   public function __construct(EntityManagerInterface $entityManager)
    {
        #parent::__construct($registry, Participant::class);
        $this->em=$entityManager;
        #$repository = $this->getDoctrine()->getRepository(Participant::class);
    }

   

 
    public function findAll()
    {
       $qb = $this->createQueryBuilder("p");
       $participations =  $qb->getQuery()->getResult();
       
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
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.participationid = :pid');
       $qb->setParameter('pid', $participationid);
       $participation =  $qb->getQuery()->getOneOrNullResult();
       $manager = $this->getEntityManager();
       $conn = $manager->getConnection();
       $persons = $conn->query("select * from person where personid  =".$participation->getpersonid())->fetchAll();
       $person = $persons[0];
     //  $person->fixPerson();
       $participation->label = $person['surname'];
       
       return $participation;
    }
    
    
    public function findParticipants($eventid)
    {
      $sql = " select p.personid,pl.surname,pl.forename  from AppBundle:participant p ";
      $sql .= " join 'AppBundle\Entity\Person' pl WITH pl.personid = p.personid " ;
      $sql .= " where p.eventid = ".$eventid;
      $sql .= " order by pl.surname ASC ";
      $query = $this->em->createQuery($sql);
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
      # $qb = $this->getDoctrine()->getRepository(Participant::class)->createQueryBuilder("p");
     #  $qb = $this->em->createQueryBuilder('p');
     #  $qb ->select('personid', 'eventid' );
     #  $qb ->from('Participant','p');
     ##  $qb->where('personid = ?');
     #  $qb->setParameter(0, $personid);
      $sql = "select p from AppBundle:participant p ";
      $sql .= " where p.personid = ".$personid;
      $query = $this->em->createQuery($sql);
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
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.personid = :pid');
       $qb->setParameter('pid', $personid);
       $qb->andWhere('p.eventid = :eid');
       $qb->setParameter('eid', $eventid);
       $participations =  $qb->getQuery()->getResult();
       
       foreach( $participations as $participation )
       {
          $participation->label = $participation->getEventid();
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
