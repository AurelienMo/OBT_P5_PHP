<?php
namespace App\Controllers;

use App\Model\CompareLog;
use App\Model\CreateSession;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class ConnectController extends AbstractController
{
    public function connect(Request $request)
    {
        if($request->isMethod('POST')){

            $session = new CreateSession();
            $session = $session->Connection($request);

            return new RedirectResponse('/profil?page=1');
        }
        return $this->renderResponse("connectionFolder/Connection.html.twig");
    }
//    public function Connection($connectError):Response
//    {
//        $errorConnect=new CompareLog();
//        $errorConnect=$errorConnect->provideLogs();
//        if(array_key_exists('connect',$_SESSION)){
//            return new RedirectResponse('/profil?page=1');
//        }
//        return $this->renderResponse('connectionFolder/Connection.html.twig',['errorConnect'=>$errorConnect]);
//    }

}