<?php
session_start();
use App\Application\RouterApplication;
use App\Controllers\NotFoundController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


require '../vendor/autoload.php';

$request = Request::createFromGlobals();

$router = new RouterApplication($request);
$router->initRouter();

try{
    $response = $router->run();
    $response->send();
} catch (ResourceNotFoundException $e)
{
    $controller= new NotFoundController();
    $response = $controller->notFound ();
    $response->send();
}

