<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Image;

use Doctrine\ORM\EntityRepository;
#use Doctrine\Bundle\DoctrineBundle\Repository\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Images|null find($id, $lockMode = null, $lockVersion = null)
 * @method Images|null findOneBy(array $criteria, array $orderBy = null)
 * @method Images[]    findAll()
 * @method Images[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends EntityRepository
{

   
    
    #public function __construct(RegistryInterface $registry)
    #{
    #    parent::__construct($registry, Image::class);
    #}


     public function findAll()
    {
       $qb = $this->createQueryBuilder("i");
       $qb->orderBy("i.name", "ASC");
       $images =  $qb->getQuery()->getResult();
       foreach($images as $image)
       {
         $image->makeLabel();
            $image->makeFullpath();
       }
       return $images;
    }
    
    
    public function findOne($imageid)
    {
       $qb = $this->createQueryBuilder("i");
       $qb->andWhere('i.imageid = :iid');
       $qb->setParameter('iid', $imageid);
       $image =  $qb->getQuery()->getOneOrNullResult();
       if($image)
       {
       $image->makeLabel();
 
       $image->makeFullpath();
     #   echo("===".$image->getFullpath());
        }
       return $image;
    }
    
      public function findSearch($sfield)
    {
       $qb = $this->createQueryBuilder("p");
       $qb->andWhere('p.path LIKE :pid  or p.name LIKE :pid ');
       $qb->setParameter('pid', $sfield);
       $qb->orderBy("p.name", "ASC");
       $images =  $qb->getQuery()->getResult();
       foreach($images as $image)
       {
    #     $image->makeLabel();
    #     $image->makeFullpath();
       }
       return $images;
    }
    
}
