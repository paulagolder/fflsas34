<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Message;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class MessageRepository extends EntityRepository
{
    
    public function findbyemail($email)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->andWhere('c.email= :val');
        $qb->setParameter('val', $email);
        
         return $qb->getQuery()->getResult();
    }
    
    public function findAdmin()
    {
        $admin = "FFLSAS-admin";
        $qb = $this->createQueryBuilder('c');
        $qb->andWhere('c.sentto= :val');
        $qb->setParameter('val', $admin);
        
         return $qb->getQuery()->getResult();
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
