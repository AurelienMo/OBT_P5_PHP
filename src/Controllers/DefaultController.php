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


//        $data = require '../config/app/mailer.php';
//
//        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
//            ->setAuthMode('login')
//            ->setUsername($data['mail'])
//            ->setPassword($data['password']);
//        dump ($data['mail'],' ** ', $data['password']);
//        $mailer = new Swift_Mailer($transport);
//        $message = (new Swift_Message())
//            ->setSubject('Registration account')
//            ->setFrom($data['mail'])
//            ->setTo('boutet.13010@gmail.com')
//            ->setBody(
//                $this->getTwig()->render('mailer/confirmation.html.twig', ['username' => 'John Doe']),'text/html');
//
//        $result = $mailer->send($message);
//        dump($result);

        return $this->renderResponse('core/home.html.twig');
    }


}
