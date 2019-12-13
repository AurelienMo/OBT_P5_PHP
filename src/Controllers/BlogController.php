<?php


namespace App\Controllers;

use App\Helpers\Pagination;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
class BlogController extends AbstractController
{
    /**@var ArticleRepository */
    protected $articleRepository;
    /**@var Pagination */
    protected $pagination;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->pagination = new Pagination();
    }

    public function blog(Request $request)
    {

        $articleByPage = 6;
        $totalPage = $this->pagination->totalPage($articleByPage);
        dump($_SESSION);
        $currentPage = $this->pagination->currentPage($request, $totalPage);
        $start = ($currentPage-1)*$articleByPage;
        $articles = $this->articleRepository->listArticles($start, $articleByPage);
        $line = (count($articles));
        $pass = intval($line-1);

        return $this->renderResponse('core/blog.html.twig',[
            'session'=> $_SESSION,
            'articles' => $articles,
            'pass' => $pass,
            'totalPage'=>$totalPage,
            'currentPage'=>$currentPage
    ]);
    }
}