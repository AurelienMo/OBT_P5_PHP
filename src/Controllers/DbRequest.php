<?php
namespace App\Controllers;

class DbRequest extends AbstractController
{
    public function addUserTitleArticles()
    {
        $db = self ::getdb ();
        $statement = 'SELECT * FROM articles WHERE author= '.($_SESSION['id']).' ';
        $reqdb = $db->query($statement);
        return $reqdb;
    }
}