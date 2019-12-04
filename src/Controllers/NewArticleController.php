<?php
namespace App\Controllers;

use App\Model\CreateSlug;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class NewArticleController extends AbstractController
{
    protected static $db;

    public function newArticle()
    {
        $request = Request::createFromGlobals();
        if($_SERVER['REQUEST_METHOD']==='GET'){
        $slug = ($request->query->get('article'));        dump($request->query->get('article'));
        if  (!empty($slug)){
            $statement="SELECT * FROM articles WHERE slug='$slug'";
            $db=self::getdb();
            $request=$db->prepare($statement);
            $request->execute();
            $articleInfo=$request->fetch();
            $title=$articleInfo['titre'];
            $article=$articleInfo['article'];
            $id=$articleInfo['id'];

            return $this->renderResponse('editor/newarticle.html.twig',[
                'username'=>ucfirst($_SESSION['username']),
                'email' => ($_SESSION['email']),
                'registrationDate' =>( $_SESSION['registrationDate']),
                'title' => $title,
                'id' => $id,
                'article' => $article]);
            };
            }


            if($_SERVER['REQUEST_METHOD']==='POST'){
                $etst= $request->request->get('cancel');
                dump($etst);

                if ($etst === null){
                    $slug = ($request->query->get('article'));
                    $statement="SELECT * FROM articles WHERE slug='$slug'";
                    $db=self::getdb();
                    $request=$db->prepare($statement);
                    $request->execute();
                    $articleInfo=$request->fetch();
                    $id=$articleInfo['id'];
dump($id);
                    $title = $_POST['title'];

                    $theString =$title;
                    $createSlug = new CreateSlug();
                    $theString=$createSlug->replace_char($theString);


                    $slug=$theString;
                    $title = $_POST['title'];
                    $article = $_POST['editor'];
                    dump($_POST);
                    dump($slug);
                    dump($id);

                    $db=self::getdb();
                    $statement=('UPDATE articles SET slug = :slug, titre = :title, article = :article  WHERE id= '.$id.' ');
                    $reqdb=$db->prepare($statement);
                    $reqdb->execute(
                        array(
                            'title'=>$title,
                            'article'=>$article,
                            'slug'=>$slug
                            ));
                    die();
                    return new RedirectResponse('/profil?page=1');
                }else{
                    return new RedirectResponse('/profil?page=1');
                }
            }



//        if($slug <> ($_SERVER['QUERY_STRING'])){
//
//            die();
        }



//
//    }

}
