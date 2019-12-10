<?php

namespace App\Controllers;

use App\Model\DbRequest;
use App\Model\ProfileRequest;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
class ProfilController extends AbstractController
{
    public function profil($request, $id)
    {

        $page = $request->query->get('page');
        $userArticles=null;
        $articleByPage = 3;
        $numberArticles = new DbRequest();
        $numberArticles = $numberArticles->addNumberArticles();
        $line = $numberArticles->rowCount();
        $totalPage = ceil($line/$articleByPage);

            if(!empty($page) && $page>0 && $page<=$totalPage){
                $page = intval($page);
                $currentPage = $page;
            }else{ $currentPage = 1 ;
            }
        $start = ($currentPage-1)*$articleByPage;
        $addArticles = new DbRequest();
        $articles = $addArticles->addArticles($start, $articleByPage);
        $line = (count($articles));
        $pass = intval($line-1);
        dump($articles[0]['article']);

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