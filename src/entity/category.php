<?php
namespace App\Entity;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
**/

class Category {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    **/
    private $id;
    /** 
     * @ORM\Column(type="string", length=255)
    **/
    private $name;
    /**   
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
    **/
    private $slug;
    /** 
     * @ORM\Column(type="text")
    **/
    private $description;
    /** 
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=true)
    **/
    private $image_url;
    /** 
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="categories")
    **/
    private $articles;
    /** 
     * @ORM\Column(type="datetime")
    **/
    private $created_at;


    public function __construct(){
        $this->created_at = new \DateTime();
        $this->articles = new ArrayCollection();
    }


    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getImageUrl(){
        return $this->image_url;
    }
    public function getArticles(){
        return $this->articles;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    public function getSlug(){
        return $this->slug;
    }


    public function setId($id): self{
        $this->id = $id;
        return $this;
    }
    public function setName($name): self{
        $this->name = $name;
        $slug = (new Slugify())->slugify($this->name);
        $this->setSlug($slug);
        return $this;
    }
    public function setDescription($description): self{
        $this->description = $description;
        return $this;
    }
    public function setImageUrl($image_url): self{
        $this->image_url = $image_url;
        return $this;
    }
    public function setCreatedAt($created_at): self{
        $this->created_at = $created_at;
        return $this;
    }
    public function setSlug($slug): self{
        $this->slug = $slug;
        return $this;
    }
    public function addArticle(Article $article): self{
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            if (!$article->getCategories()->contains($this)) {
                $article->addCategory($this);
            }
        }
        
        return $this;
    }
    public function removeArticle(Article $article): self{
         if ($this->articles->removeElement($article)) {
            if ($article->getCategories()->contains($this)) {
                $article->removeCategory($this); 
            }
         }
        
        return $this;
    }
     
}