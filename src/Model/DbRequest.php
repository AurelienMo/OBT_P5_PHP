<?php
namespace App\Model;

use App\Controllers\AbstractController;
use App\Repository\ArticleRepository;
class DbRequest extends AbstractController
{

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