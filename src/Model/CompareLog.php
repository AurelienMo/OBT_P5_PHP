<?php
namespace App\Model;

use App\Application\Database;
use App\Controllers\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CompareLog extends AbstractController
{
    protected static $db;
    public function provideLogs()
    {
        $errorConnect = null;
        if($_SERVER['REQUEST_METHOD']==='POST'&&!empty($_POST['login'])&&!empty($_POST['password'])){
            $resistData=$this->getGlobalPHP('POST');
            $login=htmlentities($_POST['login']);
            $password=htmlentities($_POST['password']);
            $db=self::getdb();
            $statement='SELECT * FROM member WHERE username= ?';
            $reqdb=$db->prepare($statement);
            $reqdb->execute([$resistData['login']]);
            $userInfo=$reqdb->fetch();
            $hashPassword=$userInfo['password'];

            if(password_verify($password,$hashPassword)){
                $errorConnect = 0;
                $_SESSION['id']=$userInfo['id'];
                $_SESSION['username']=$userInfo['username'];
                $_SESSION['email']=$userInfo['mail'];
                $_SESSION['registrationDate']=$userInfo['registrationdate'];
                $_SESSION['connect']=1;

            }else{ $errorConnect = 1;}
        }

        return $errorConnect;
    }
}
