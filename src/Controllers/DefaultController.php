<?php


namespace App\Controllers;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends AbstractController
{
    public function homeAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->renderResponse('core/home.html.twig');
    }


}
