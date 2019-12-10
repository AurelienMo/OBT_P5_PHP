<?php
namespace App\Model;

use App\Controllers\AbstractController;
use Symfony\Component\HttpFoundation\Request;
class CreateSession extends AbstractController
{
    protected static $db;
    protected $login;
    private $password;

    public function Connection($request)
        {
            $db=self::getdb();
            $errorConnect=null;
                $login=htmlentities($request->request->get('login'));
                $password=htmlentities($request->request->get('password'));
                $statement='SELECT * FROM member WHERE username= ?';
                $reqdb=$db->prepare($statement);
                $reqdb->execute([$login]);
                $userInfo=$reqdb->fetch();
                $hashPassword=$userInfo['password'];


                if(password_verify($password,$hashPassword)){
                    $errorConnect=0;
                    $_SESSION['id']=$userInfo['id'];
                    $_SESSION['username']=$userInfo['username'];
                    $_SESSION['email']=$userInfo['mail'];
                    $_SESSION['registrationDate']=$userInfo['registrationdate'];
                    $_SESSION['connect']=1;
                }else{
                    $errorConnect=1;
                }
            }
}