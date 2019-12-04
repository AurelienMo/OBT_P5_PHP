<?php
namespace App\Controllers;

use App\Model\CompareLog;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
class ConnectController extends AbstractController
{
    public function Connection($connectError):Response
    {
        $errorConnect=new CompareLog();
        $errorConnect=$errorConnect->provideLogs();
        if(array_key_exists('connect',$_SESSION)){
            return new RedirectResponse('/profil?page=1');
        }
        return $this->renderResponse('connectionFolder/Connection.html.twig',['errorConnect'=>$errorConnect]);
    }
}