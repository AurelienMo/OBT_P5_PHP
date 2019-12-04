<?php


namespace App\Controllers;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends AbstractController
{
    public function homeAction(): Response
    {
        return $this->renderResponse('core/home.html.twig');
    }


}
