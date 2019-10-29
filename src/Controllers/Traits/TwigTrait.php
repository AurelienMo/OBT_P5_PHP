<?php

namespace App\Controllers\Traits;


use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

trait TwigTrait
{
    public function render(string $template, array $paramsTemplate =[], array $form =[])
    {
        $twig = $this->getTwig();
        return $twig->render($template, $paramsTemplate, $form);
    }
    protected function getTwig()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../../templates');
        $twig = new Environment(
            $loader
        );
        $twig->addExtension(new DebugExtension());
//        $twig->addGlobal('session', $_SESSION);
        return $twig;
    }
}

