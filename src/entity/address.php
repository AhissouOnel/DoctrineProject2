<?php
namespace App\Entity;
use Doctrine\ORM\Mapping AS ORM;


/** 
 *@ORM\Entity 
 *@ORM\Table(name="addresses")
**/
class Address {
    /**
     * @ORM\id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    **/
    private $id;
    /** 
     *  @ORM\Column(type="string")
    **/
    private $street;
    /** 
     *  @ORM\Column(type="string")
    **/
    private $city;
    /** 
     *  @ORM\Column(type="string")
    **/
    private $country;
    /** 
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="address") 
    **/
    private $user; 

    public function getId(){
        return $this->id;
    }
    public function getStreet(){
        return $this->street;
    }
    public function getcity(){
        return $this->city;
    }
    public function getCountry(){
        return $this->country;
    }
    public function getUser(){
        return $this->user;
    }

   
    public function setStreet($street): self{
        $this->street = $street;
        return $this;
    }
    public function setCity($city): self{
        $this->city = $city;
        return $this;
    }
    public function setCountry($country): self{
        $this->country = $country;
        return $this;
    }
    public function setUser($user): self{
        $this->user = $user;
        return $this;
    }
}