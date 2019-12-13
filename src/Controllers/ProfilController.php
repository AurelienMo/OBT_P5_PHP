<?php

namespace App\Controllers;

use App\Helpers\Pagination;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
class ProfilController extends AbstractController
{
    /** @var ArticleRepository  */
    protected $articleRepository;
    /**@var Pagination */
    protected $pagination;
    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->pagination = new Pagination();
    }
    public function profil(Request $request, $id)
    {

        $userArticles=null;
        $articleByPageUser = 3;
        $pagination = new Pagination();
        $totalPageUser = $this->pagination->totalPageUser($articleByPageUser);
        $currentPageUser = $this->pagination->currentPageUser($request, $totalPageUser);
        $start = ($currentPageUser-1)*$articleByPageUser;
        $articlesUser = $this->articleRepository->listArticlesUser($start, $articleByPageUser);
        $line = (count($articlesUser));
        $pass = intval($line-1);

       if($request->isMethod("DELETE")){
           $this->articleRepository->delArticle($id);
        }
       dump($articlesUser);
        return $this->renderResponse('connectionFolder/profil.html.twig', [
            'session'=>$_SESSION,
            'articles' => $articlesUser,
            'pass' => $pass,
            'totalPage'=>$totalPageUser,
            'currentPage'=>$currentPageUser
    ]);
    }

}