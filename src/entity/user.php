<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
**/

class User {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    **/
    private $id;
    /** 
     * @ORM\Column(type="string")
    **/
    private $full_name;
    /** 
     * @ORM\Column(type="string")
    **/
    private $email;
    /** 
     * @ORM\Column(type="string")
    **/
    private $role;
    
    private $password;
    /**
     *@ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"}, inversedBy="user")  
     *@ORM\JoinColumn(name="address", nullable=false)
    **/
    private $address;
    /** 
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="author")
    **/
    private $articles;
     /** 
     *  @ORM\OneToMany(targetEntity=Comment::class, mappedBy="author")
    **/
    private $comments;
    /** 
     * @ORM\Column(type="datetime")
    **/
    private $created_at;


    public function __construct(){
        $this->role = "ROLE_USER"; 
        $this->created_at = new \DateTime();
        $this->articles = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


    public function getId(){
        return $this->id;
    }
    public function getFullName(){
        return $this->full_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getRole(){
        return $this->role;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getArticles(){
        return $this->articles;
    }
    public function getComments(){
        return $this->comments;
    }


    public function setId($id): self{
        $this->id = $id;
        return $this;
    }
    public function setFullName($full_name): self{
        $this->full_name = $full_name;
        return $this;
    }
    public function setEmail($email): self{
        $this->email = $email;
        return $this;
    }
    public function setRole($role): self{
        $this->role = $role;
        return $this;
    }
    public function setPassword($password): self{
        $this->password = $password;
        return $this;
    }
    public function setAddress($address): self{
        $this->address = $address;
        return $this;
    }
    public function addArticle(Article $article): self{
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setAuthor($this);
        }
        
        return $this;
    }
    public function removeArticle(Article $article): self{
        if (!$this->articles->removeElement($article)) {
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null); 
            }
        }
        
        return $this;
    }
    public function addComment(Comment $comments): self{
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setAuthor($this);
        }
        
        return $this;
    }
    public function removeComment(Comment $comment): self{
        if (!$this->comments->removeElement($comment)) {
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null); 
            }
        }
        
        return $this;
    }
}

