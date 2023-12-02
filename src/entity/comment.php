<?php
namespace App\Entity;
use Doctrine\ORM\Mapping AS ORM;


/** 
 *@ORM\Entity 
 *@ORM\Table(name="comments")
**/
class Comment {
    /**
     * @ORM\id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    **/
    private $id;
     /** 
     *  @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
    **/
    private $author;
    /** 
     *  @ORM\Column(type="text")
    **/
    private $content;
    /** 
     *  @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
    **/
    private $article;
     /** 
     *  @ORM\Column(type="datetime")
    **/
    private $created_at;

    public function __construct(){
        $this->created_at = new \DateTime();
    }

    public function getId(){
        return $this->id;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getContent(){
        return $this->content;
    }
    public function getArticle(){
        return $this->article;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    


    public function setId($id): self{
        $this->id = $id;
        return $this;
    }
    public function setAuthor($author): self{
        $this->author = $author;
        return $this;
    }
    public function setContent($content): self{
        $this->content = $content;
        return $this;
    }
    public function setCreatedAt($created_at): self{
        $this->created_at = $created_at;
        return $this;
    }
    public function addArticle(Article $article): self{
        $this->article = $article;
        return $this;
    }
    public function removeArticle(): self{
        $this->article = null;
        return $this;
    }
}