<?php

// src/Repository/UserRepository.php
namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    
     public function findAll()
    {
       $qb = $this->createQueryBuilder("p");
       $qb->orderBy("p.username", "ASC");
       $fusers =  $qb->getQuery()->getResult();
      
       return $fusers;
    }
    
    
      public function findOne($userid)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :uid ')
            ->setParameter('uid', $userid)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function delete($userid)
    {
        $qd = $this->createQueryBuilder('u');
        $qd->delete();
        $qd->where('u.id = :uid');
        $qd>setParameter('uid',$userid);
        $query = $qd->getQuery()->getResult();
    }
}
