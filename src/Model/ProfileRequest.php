<?php
namespace App\Model;

use App\Controllers\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProfileRequest extends AbstractController
{
    protected static $db;

    public function getArticles(){
        $articles=[];
        $db = self::getdb();
            $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ';
            $reqdb = $db->query($statement);
            $titre = $reqdb->fetchAll();
            $line = (count($titre));
            for ($i = 1; $i <= $line; $i++) {
                $articles = array($titre['titre']) ;

        }return $articles;


    }

    public function newArticle()
    {
        if(!empty($_POST['title'] && $_POST['article'])){
           return 'test';
        }
    }
}