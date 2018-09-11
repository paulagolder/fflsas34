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
    
}
