<?php
namespace App\Repository;
use App\Entity\Article;  
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository{
    public function getLength($num = 6){
        $qb = $this->_em->createQueryBuilder()
                   ->select("COUNT(a.id)")
                   ->from(Article::class, "a")
        ;
        $query = $qb->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getArticles($num = 6){
        $qb = $this->_em->createQueryBuilder()
                   ->select("a")
                   ->from(Article::class, "a")
                   ->setMaxResults($num)
        ;
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function getArticlesByPage($num = 6, $page = 1){
        $start = ($page-1)*6;
        if ($start < 0) {
            $start = 0;
        }
        $qb = $this->_em->createQueryBuilder()
                   ->select("a")
                   ->from(Article::class, "a")
                   ->setFirstResult($start)
                   ->setMaxResults($num)
        ;
        $query = $qb->getQuery();
        return $query->getResult();
    }

    
}