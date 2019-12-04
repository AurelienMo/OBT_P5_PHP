<?php
namespace App\Controllers;
session_start();

use App\Controllers\AbstractController;
class DisconnectedController extends AbstractController
{
    public function disconnected()
    {
        if (session_status() == PHP_SESSION_ACTIVE){
            session_destroy();
            header("Location:/");
        }
    }
}