<?php

namespace App\Controllers;

use App\Model\ProfileRequest;
use Symfony\Component\HttpFoundation\Request;
class ProfilController extends AbstractController
{
    protected static $db;

    public function Profil($id)
    {
        $db = self::getdb();

        $request = Request::createFromGlobals();
        dump($request->query->get('page'));
        $page = $request->query->get('page');
        dump($page);

        $articleByPage = 3;

        $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ';
        $reqdb = $db->query($statement);
        $line = $reqdb->rowCount();

        $totalPage = ceil($line/$articleByPage);

            if(!empty($page) && $page>0 && $page<=$totalPage){
                $page = intval($page);
                $currentPage = $page;
            }else{ $currentPage = 1 ;


        }
        $start = ($currentPage-1)*$articleByPage;

        dump($_GET);

        $db = self::getdb();
        $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ORDER BY id DESC LIMIT '.$start.','.$articleByPage.' ';
        $reqdb = $db->query($statement);
        $articles = $reqdb->fetchAll();
        $line = (count($articles));
        $pass = intval($line-1);

       if($_SERVER['REQUEST_METHOD']==='delete'){
           $db = self::getdb();
           $statement = ('DELETE FROM articles WHERE id='.$id.' ');
           $reqdb = $db->exec($statement);
        }



        return $this->renderResponse('connectionFolder/profil.html.twig', [
        'username'=>ucfirst($_SESSION['username']),
        'email' => ($_SESSION['email']),
        'registrationDate' =>( $_SESSION['registrationDate']),
            'articles' => $articles,
            'pass' => $pass,
            'totalPage'=>$totalPage,
            'currentPage'=>$currentPage
    ]);

    }

}