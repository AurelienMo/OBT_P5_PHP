<?php
namespace App\Model;

use App\Controllers\AbstractController;

class CheckForm extends AbstractController
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var
     */
    protected static $db;

    public function checkUserName(){
        if (!empty($_POST['username'])){
            $username = $_POST['username'];
            $db = self ::getdb ();
            if (!empty($username)){
                $statement = 'SELECT id FROM member WHERE username = ?';
                $reqdb = $db->prepare($statement);
                $reqdb -> execute ([$username]);
                $user = $reqdb->fetch();
                if ($user) {

                    return $errorUserName =array(''=>'Ce pseudo est déjà utilisé');
                }
            }
        }

    }

    public function checkMail(){
        if (!empty($_POST['mail'])){
            $db = self ::getdb ();
            $mail = $_POST['mail'];
            if (!empty($mail)){
                $statement = 'SELECT id FROM member WHERE mail = ? ';
                $reqdb = $db->prepare ($statement);
                $reqdb->execute ([$mail]);
                $user = $reqdb->fetch ();
                if ($user){
                    return $errorMail = array('Cet Email est déjà connue , veuillez utiliser vos identifiants pour vous connecter.');
                }
            }
        }

    }

}