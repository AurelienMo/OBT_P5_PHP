<?php
namespace App\Repository;

use App\Exeptions\ArticleNotFoundException;
use App\Model\Article;
use Exception;
use mysql_xdevapi\Statement;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ArticleRepository extends AbstractRepository
{
    public function listArticles()
    {
        $stmt = 'SELECT * FROM article';
        $req = self::getDb()->prepare($stmt);
        $req->execute();
        $results = $req->fetchAll();
        $articles = [];
        foreach ($results as $result) {
            /** @var Article $article */
            $article = AbstractRepository::getClass(Article::class);
            $articles[] = $article->unserialize(serialize(array_values($result)));
        }
        return $articles;
    }
    public function findById(int $id)
    {
        $stmt = 'SELECT * FROM article WHERE id = :id';
        $req = self::getDb()->prepare($stmt);
        $req->bindParam(':id', $id);
        $req->execute();
        $result = $req->fetch();
        if (!$result) {
            throw new ArticleNotFoundException((int) $id);
        }
        $article = AbstractRepository::getClass(Article::class);
        return $article->unserialize(serialize(array_values($result)));
    }

    public function save($result)
    {
        $statement = 'INSERT INTO article (title)VALUES (:title, :article)';
        $req = self::getDb()->prepare($statement);
        $req->bindParam(':title','article', $article->getArticle(), $title->getTitle());
        $req->execute();
    }
}