<?php

use App\Application\RouterApplication;
use App\Controllers\NotFoundController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


require '../vendor/autoload.php';
//        $data = require "../config/app/mailer.php";
//        var_dump($data);
//
//        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
//
//            ->setAuthMode('login')
//            ->setUsername($data['mail'])
//            ->setPassword($data['password']);
//
//        $mailer = new Swift_Mailer($transport);
//        $message = (new Swift_Message())
//            ->setSubject('Registration account')
//            ->setFrom($data['mail'])
//            ->setTo('olivier.boutet@iter.org')
//            ->setBody(ht
//                $this->renderResponse('mailer/confirmation.html.twig', text/html)
//            );
//
//        $result = $mailer->send($message);
//        dump($result);
//exit();
$request = Request::createFromGlobals();

$router = new RouterApplication($request);
$router->initRouter();

try{
    $response = $router->run ();
    $response->send();
} catch (ResourceNotFoundException $e)
{
    $controller= new NotFoundController();
    $response = $controller->notFound ();
    $response->send();
}

