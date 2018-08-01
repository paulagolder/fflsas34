<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
   
    private $locid;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $kml;
    
     /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $zoom;
    
    
    public $link;
      public $label;
    public $ancestors = array();
    public $children = array();

    public function getId()
    {
        return $this->id;
    }

    public function getLocid(): ?int
    {
        return $this->locid;
    }

    public function setLocid(int $locid): self
    {
        $this->locid = $locid;

        return $this;
    }

    
    public function getZoom(): ?int
    {
        return $this->zoom;
    }

    public function setZoom(int $zoom): self
    {
        $this->zoom = $zoom;

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

    public function getRegion(): ?int
    {
        return $this->region;
    }

    public function setRegion(?int $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getKml(): ?string
    {
        return $this->kml;
    }

    public function setKml(?string $kml): self
    {
        $this->kml = $kml;

        return $this;
    }
    
    
    
}
