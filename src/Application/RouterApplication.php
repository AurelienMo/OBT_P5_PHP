<?php
declare(strict_types=1);

namespace App\Application;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

class RouterApplication
{
    /**@var Request */
    protected $request;

    /**@var Router */
    protected $router;

    /*** @var array
     */
    protected $params;


    public function __construct(Request $request)
    {
        $this->request = $request;

    }

    public function initRouter()
    {
        $fileLocator = new FileLocator([__DIR__ . '/../../']);
        $context = new RequestContext();
        $context->fromRequest($this->request);

        $this->router = new Router(
            new YamlFileLoader($fileLocator),
            'config/app/routes.yaml',
            [],
            $context
        );
    }

    public function run()
    {
        $params = $this->router->match($this->request->getPathInfo());
        $controllerName = explode('::', $params['_controller']);
        $controller = sprintf("App\\Controllers\\%s", $controllerName[0]);
        $method = $controllerName[1];

        $controller = $this->instantiateController($controller);
        array_unshift($params, $this->request);
        $this->cleanParamsRoute($params);

        return call_user_func_array([$controller, $method], $params);
    }

    private function instantiateController(string $controller)
    {
        return new $controller();
    }

    private function cleanParamsRoute(array $params)
    {
        unset($params['_route'], $params['_controller']);

        return $params;
    }



}