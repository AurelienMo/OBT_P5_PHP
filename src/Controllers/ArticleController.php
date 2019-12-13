<?php
namespace App\Controllers;
use Symfony\Component\HttpFoundation\Request;
class ArticleController extends AbstractController
{
    protected static $db;
    public function article(Request $request)
    {

        if($_SERVER['REQUEST_METHOD']==='GET'){
            $slug=($request->query->get('id'));
            $numberArticle = explode('/',$request->getPathInfo());
            $id = $numberArticle[2];


                $statement='SELECT * FROM articles WHERE id='.$id.' ';
                $db=self::getdb();
                $request=$db->prepare($statement);
                $request->execute();
                $articleInfo=$request->fetch();

                $title=$articleInfo['titre'];
                $article=$articleInfo['article'];
                $dateArticle = $articleInfo['created_date'];
                $author = $articleInfo['author'];

                $statement='SELECT username FROM member WHERE id='.$author.' ';
                $db=self::getdb();
                $request=$db->prepare($statement);
                $request->execute();
                $authorName=$request->fetch();
                $authorName = $authorName['username'];
            dump($authorName);
            return $this->renderResponse('core/article.html.twig',[
                'author'=>ucfirst($authorName),
                'title'=>$title,
                'date'=>$dateArticle,
                'article'=>$article]);
        }
    }
}