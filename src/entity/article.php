<?php
namespace App\Entity;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
**/

class Article {
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    **/
    private $id;
    /**   
     * @ORM\Column(type="string", length=60)
    **/
    private $title;
    /**   
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
    **/
    private $slug;
    /** 
     * @ORM\Column(type="text")
    **/
    private $content;
    /** 
     * @ORM\Column(type="string")
    **/
    private $image_url;
    /** 
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
    **/
    private $author;
    /** 
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="articles")
    **/
    private $categories;
    /** 
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="article")
    **/
    private $comments;
    /** 
     * @ORM\Column(type="datetime")
    **/
    private $created_at;


    public function __construct(){
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->created_at = new \DateTime();
    }


    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getContent(){
        return $this->content;
    }
    public function getImageUrl(){
        return $this->image_url;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getSlug(){
        return $this->slug;
    }
    public function getComments(){
        return $this->comments;
    }


    public function setId($id): self{
        $this->id = $id;
        return $this;
    }
    public function setTitle($title): self{
        $this->title = $title;
        $slug = (new Slugify())->slugify($this->title);
        $this->setSlug($slug);
        return $this;
    }
    public function setContent($content): self{
        $this->content = $content;
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
    public function setAuthor($author): self{
        $this->author = $author;
        return $this;
    }
    public function setSlug($slug): self{
        $this->slug = $slug;
        return $this;
    }
    public function addCategory(Category $category): self{
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addArticle($this);
        }
        
        return $this;
    }
    public function getCategories(){
        return $this->categories;
    }
    public function removeCategory(Category $category): self{
        if ($this->categories->removeElement($category)) {
            if ($category->getArticles()->contains($this)) {
                $category->removeArticle($this);
            }
        }
        
        return $this;
    }
    public function addComment(Comment $comment): self{
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->addArticle($this);
        }
        
        return $this;
    }
    public function removeComment(Comment $comment): self{
        if ($this->comments->removeElement($comment)) {
            if ($comment->getArticle() === $this) {
                $comment->removeArticle();
            }
        }
        
        return $this;
    }
}