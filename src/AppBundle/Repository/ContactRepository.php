<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Contact;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ContactRepository extends EntityRepository
{
    
    
    
    
    public function findbyemail($email)
    {
        return $this->createQueryBuilder('c')
        ->andWhere('c.email= :val')
        ->setParameter('val', $email)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function findAdmin()
    {
        $admin = "FFLSAS-admin";
        return $this->createQueryBuilder('c')
        ->andWhere('c.sentto= :val')
        ->setParameter('val', $admin)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function delete($contactid)
    {
        
        $qb = $this->createQueryBuilder('c');
        $qb->delete();
        $qb->where('c.id = :cid');
        $qb->setParameter('cid', $contactid);
        $qb->getQuery()->getResult();
    }
    
}
