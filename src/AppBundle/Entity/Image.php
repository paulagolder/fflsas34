<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
{
    
    private  $new_images_folder ='/symfonyimages/new/';
    private  $external_images = "http://fflsas.org/images/stories/fflsas/";
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $imageid;
    
    
      /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    
    
    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $path;
    
        /**
     ** @ORM\Column(type="smallint", nullable=true)
     */
    private $width;
        /**
     * * @ORM\Column(type="smallint", nullable=true)
     */
    private $height;
    
      /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $orientation;
    
    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    
    private $date;
      /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $format;
   
    
    private $access;
    
    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $contributor;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_dt;
    
    public $link;
    public $fullpath;
    private $label;
   public $filepath;


    public function getImageid(): ?int
    {
        return $this->imageid;
    }

    public function setImageid(int $imageid): self
    {
        $this->imageid = $imageid;

        return $this;
    }

      public function getName(): ?string
    {
        return $this->name;
    }

  
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

  
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
    
 
   
    
    
      public function getFullpath()
    {
        return $this->fullpath;
    }


    
    public function setFullpath($file)
    {
        $this->fullpath = $file;

        return $this;
    }
    
    
    
    
      public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(?string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDoctype(): ?string
    {
        return $this->doctype;
    }

    public function setDoctype(?string $doctype): self
    {
        $this->doctype = $doctype;

        return $this;
    }

    public function getAccess(): ?int
    {
        return $this->access;
    }

    public function setAccess(?int $access): self
    {
        $this->access = $access;

        return $this;
    }

    public function getContributor(): ?string
    {
        return $this->contributor;
    }

    public function setContributor(?string $contributor): self
    {
        $this->contributor = $contributor;

        return $this;
    }

    public function getUpdateDt(): ?\DateTimeInterface
    {
        return $this->update_dt;
    }

    
    
    public function setUpdateDt(?\DateTimeInterface $update_dt): self
    {
        $this->update_dt = $update_dt;

        return $this;
    }
    
    public function makeLabel()
    {
       if($this->name == null)
      {
          $k =strrpos ( $this->path, "/" );
          $j =strrpos ( $this->path, "." );
          $label = substr($this->path, $k+1,$j-$k-1);
            $this->label = $label;
       }
       else
       {  
         $this->label = $this->name;
       }
    }
    
     public function isTemp()
     {
       $startstr = substr($this->path,0,4);
       if($startstr=="2018")
       {
         return true;
       }
       else
       {
        return false;
       }
     }
       
       
       public function makeFullpath()
       {
          if ($this->isTemp())
          {
             $this->setFullpath ( $this->new_images_folder.$this->getPath());   
          }
          else
          {
             $this->setFullpath ($this->external_images.$this->getPath());   
          }
        }
}
