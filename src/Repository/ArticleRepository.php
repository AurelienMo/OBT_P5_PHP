<?php
namespace App\Repository;

use App\Exeptions\ArticleNotFoundException;
use App\Model\Article;
use Exception;
use mysql_xdevapi\Statement;
use PDO;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ArticleRepository extends AbstractRepository
{
    protected $class = Article::class;

    public function listArticlesUser($start, $articleByPageUser)
    {
        $stmt = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ORDER BY id DESC LIMIT '.$start.','.$articleByPageUser.' ';
        $req = self::getDb()->prepare($stmt);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $articlesUser = $req->fetchAll();

        return $articlesUser;
    }

    public function listArticles($start, $articleByPage)
    {
        $stmt = 'SELECT * FROM articles ORDER BY id DESC LIMIT '.$start.','.$articleByPage.' ';
        $req = self::getDb()->prepare($stmt);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $articles = $req->fetchAll();

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

//    public function save($result)
//    {
//        $statement = 'INSERT INTO article (title)VALUES (:title, :article)';
//        $req = self::getDb()->prepare($statement);
//        $req->bindParam(':title','article', $article->getArticle(), $title->getTitle());
//        $req->execute();
//    }

    public function delArticle(int $id)
    {
        $db = self::getdb();
        $statement = ('DELETE FROM articles WHERE id='.$id.' ');
        $reqdb = $db->exec($statement);
    }

    public function addNumberArticlesUser()
    {
        $db = self ::getdb ();
        $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ';
        $reqdb = $db->query($statement);
        return $reqdb;
    }

    public function addNumberArticles()
    {
        $db = self ::getdb ();
        $statement = 'SELECT * FROM articles';
        $reqdb = $db->query($statement);
        return $reqdb;
    }

    public function addArticles($start, $articleByPage)
    {
        $db = self::getdb();
        $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ORDER BY id DESC LIMIT '.$start.','.$articleByPage.' ';
        $reqdb = $db->query($statement);
        $articles = $reqdb->fetchAll();
        return $articles;
    }
}