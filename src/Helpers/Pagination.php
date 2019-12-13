<?php
namespace App\Helpers;

use App\Controllers\AbstractController;
use App\Model\DbRequest;
use App\Repository\ArticleRepository;
use http\Env\Request;
class Pagination extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }
    public function totalPageUser($articleByPageUser)
    {
        $numberArticles=$this->articleRepository->addNumberArticlesUser();
        $line=$numberArticles->rowCount();
        $totalPage = ceil($line/$articleByPageUser);

        return $totalPage;
    }

    public function totalPage($articleByPage)
    {
        $numberArticles=$this->articleRepository->addNumberArticles();
        $line=$numberArticles->rowCount();
        $totalPage = ceil($line/$articleByPage);

        return $totalPage;
    }

    public function currentPageUser($request, $totalPageUser)
    {

        $page=$request->query->get('page');

        if(!empty($page) && $page>0 && $page<=$totalPageUser){
            $page = intval($page);
            $currentPageUser = $page;
        }else{ $currentPageUser = 1 ;
        }

        return $currentPageUser;
    }

    public function currentPage($request, $totalPage)
    {

        $page=$request->query->get('page');

        if(!empty($page) && $page>0 && $page<=$totalPage){
            $page = intval($page);
            $currentPage = $page;
        }else{ $currentPage = 1 ;
        }

        return $currentPage;
    }

}